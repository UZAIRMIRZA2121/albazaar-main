<?php

namespace App\Services;

use App\Models\Setting;
use GuzzleHttp\Client;

class PayTabsService
{
    protected $client;
    protected $serverKey;
    protected $profileId;
    protected $merchantId;
    protected $baseUrl;
    protected $callbackUrl;
    protected $returnUrl;

    public function __construct()
    {
        $this->client = new Client();

        // Fetch PayTabs setting from DB
        $setting = Setting::where('key_name', 'paytabs')->first();

        if (!$setting) {
            throw new \Exception('PayTabs settings not found.');
        }

        // Decode correct values based on mode
        $values = $setting->mode === 'live'
            ? (is_array($setting->live_values) ? $setting->live_values : json_decode($setting->live_values, true))
            : (is_array($setting->test_values) ? $setting->test_values : json_decode($setting->test_values, true));

        // Set the credentials dynamically
        $this->serverKey = $values['server_key'] ?? '';
        $this->profileId = $values['profile_id'] ?? '';
        $this->baseUrl = $values['base_url'] ?? 'https://secure.paytabs.sa'; // fallback if missing
        $this->callbackUrl = config('services.paytabs.callback_url'); // static from config
        $this->returnUrl = config('services.paytabs.return_url');   // static from config

        // Optional merchant ID if exists
        $this->merchantId = $values['merchant_id'] ?? null;
    }

    public function createPayment($order)
    {
        $response = $this->client->post("{$this->baseUrl}/payment/request", [
            'headers' => [
                'authorization' => $this->serverKey,
                'content-type' => 'application/json',
            ],
            'json' => [
                'profile_id' => $this->profileId,
                'tran_type' => 'sale',
                'tran_class' => 'ecom',
                'cart_id' => $order['cart_id'],
                'cart_description' => $order['description'],
                'cart_currency' => 'PKR',
                'cart_amount' => $order['amount'],
                'callback' => $this->callbackUrl,
                'return' => $this->returnUrl,
                'customer_details' => $order['customer_details'],
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
     
        // Return only the redirect URL
        return $result ?? null;
        
    }


    public function checkTransactionStatus($tran_ref)
    {
        $response = $this->client->post("{$this->baseUrl}/payment/query", [
            'headers' => [
                'authorization' => $this->serverKey,
                'content-type' => 'application/json',
            ],
            'json' => [
                'profile_id' => $this->profileId,
                'tran_ref' => $tran_ref,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
