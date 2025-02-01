<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TryOttoService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.tryoto.base_url');
    }

    public function getApiAccessToken()
    {
        $data = [
            'refresh_token' => "AMf-vBxZSeMMlhGDWJTWYFbGs5CUJxnLS_0XUA2jviHNkhjFy23v9kVlNueM4FpawMKwrVfVOIaZlsx5Q_bh8X55lP6h6hwPsw_t2QQ2dgLP3SIcrD4gYeVjT9X4qQzfTCzzoTK1ZOU-WMAM2iX46fP8vcdWioU2p0wffaU6ALRPK-VXmXAKw1cbwkwAJfDxzW8rBOqn0S-TCUFLtLgLWZqlm0JzHwNRzg",
        ];
   
        $response = Http::withOptions([
            'verify' => false,
        ])->post("{$this->baseUrl}refreshToken", $data);


        if ($response->successful()) {
            return $response->json()['access_token'];
        }
        throw new \Exception('Failed to get access token: ' . $response->body());
    }

    public function createShipment($data)
    {
        $_token = $this->getApiAccessToken();
        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $_token,
        ])->post("{$this->baseUrl}createOrder", $data);

        if ($response->successful()) {
            return $response->json();
        }
        throw new \Exception('Failed to create shipment: ' . $response->body());
    }


    public function trackShipment($shipmentId)
    {
        $_token = $this->getApiAccessToken();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $_token,
        ])->get("{$this->baseUrl}/orderStatus");

        return $response->json();
    }

    public function cancelShipment($shipmentId)
    {
        $_token = $this->getApiAccessToken();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $_token,
        ])->get("{$this->baseUrl}/shipments/{$shipmentId}");

        return $response->json();
    }
}
