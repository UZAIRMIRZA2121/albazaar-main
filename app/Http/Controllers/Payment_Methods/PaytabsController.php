<?php

namespace App\Http\Controllers\Payment_Methods;

use App\Models\PaymentRequest;
use App\Models\User;
use App\Traits\Processor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Services\TryotoService;
class Paytabs
{
    use Processor;

    private $config_values;

    public function __construct()
    {
        $config = $this->payment_config('paytabs', 'payment_config');
        if (!is_null($config) && $config->mode == 'live') {
            $this->config_values = json_decode($config->live_values);
        } elseif (!is_null($config) && $config->mode == 'test') {
            $this->config_values = json_decode($config->test_values);
        }
    }

    function send_api_request($request_url, $data, $request_method = null)
    {
        $data['profile_id'] = $this->config_values->profile_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config_values->base_url . '/' . $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => isset($request_method) ? $request_method : 'POST',
            CURLOPT_POSTFIELDS => json_encode($data, true),
            CURLOPT_HTTPHEADER => array(
                'authorization:' . $this->config_values->server_key,
                'Content-Type:application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $response;
    }

    function is_valid_redirect($post_values)
    {
        $serverKey = $this->config_values->server_key;
        $requestSignature = $post_values["signature"];
        unset($post_values["signature"]);
        $fields = array_filter($post_values);
        ksort($fields);
        $query = http_build_query($fields);
        $signature = hash_hmac('sha256', $query, $serverKey);
        if (hash_equals($signature, $requestSignature) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class PaytabsController extends Controller
{
    use Processor;

    private PaymentRequest $payment;
    private $user;

    public function __construct(PaymentRequest $payment, User $user)
    {
        $this->payment = $payment;
        $this->user = $user;
    }

    public function payment(Request $request)
    {

        session()->forget('payment_failed');
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid'
        ]);

        if ($validator->fails()) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)), 400);
        }

        $payment_data = $this->payment::where(['id' => $request['payment_id'], 'is_paid' => 0])->first();

        if (!$payment_data) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        $payer = json_decode($payment_data['payer_information']);

        $plugin = new Paytabs();
        $request_url = 'payment/request';

        $data = [
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => $payment_data->id,
            "cart_currency" => 'SAR',
            "cart_amount" => round($payment_data->payment_amount, 2),
            "cart_description" => "products",
            "paypage_lang" => "en",
            "callback" => route('paytabs.callback', ['payment_id' => $payment_data->id]), // Nullable - Must be HTTPS, otherwise no post data from paytabs
            "return" => route('paytabs.callback', ['payment_id' => $payment_data->id]), // Must be HTTPS, otherwise no post data from paytabs , must be relative to your site URL

            "customer_details" => [
                "name" => $payer->name ?? 'Guest User',
                "email" => $payer->email ?? 'guest@example.com',
                "phone" => $payer->phone ?? "0000000000",
                "street1" => "Riyadh",
                "city" => "Riyadh",
                "state" => "Riyadh",
                "country" => "SA",
                "zip" => "12345"
            ],
            "shipping_details" => [
                "name" => $payer->name ?? 'Guest User',
                "email" => $payer->email ?? 'guest@example.com',
                "phone" => $payer->phone ?? "0000000000",
                "street1" => "Riyadh",
                "city" => "Riyadh",
                "state" => "Riyadh",
                "country" => "SA",
                "zip" => "12345"
            ],
            "user_defined" => [
                "udf1" => "order_" . $payment_data->id,
                "udf2" => "customer_id_" . ($payer->id ?? 'guest')
            ],
            "framed" => true,
            "framed_return_top" => true,
            "framed_return_parent" => true,
            "framed_message_target" => "https://albazar.sa", // ðŸ‘ˆ YOUR frontend domain
        ];

        $page = $plugin->send_api_request($request_url, $data);

        if (!is_array($page) || !isset($page['redirect_url'])) {
            dd('Paytabs payment request failed.', ['response' => $page]);

            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        session(['redirect_url' => $page['redirect_url']]);


        return redirect()->route('checkout-payment');
    }


    public function callback(Request $request)
    {
        session()->forget('redirect_url');

        $plugin = new Paytabs();
        $response_data = $_POST;
        $transRef = filter_input(INPUT_POST, 'tranRef');
        Log::info($request->all());

        if (!$transRef) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        $is_valid = $plugin->is_valid_redirect($response_data);
        if (!$is_valid) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        $request_url = 'payment/query';
        $data = [
            "tran_ref" => $transRef
        ];
        $verify_result = $plugin->send_api_request($request_url, $data);
        $is_success = $verify_result['payment_result']['response_status'] === 'A';

        if ($is_success) {
            $this->payment::where(['id' => $request['payment_id']])->update([
                'payment_method' => 'paytabs',
                'is_paid' => 1,
                'transaction_id' => $transRef,
            ]);
            $payment_data = $this->payment::where(['id' => $request['payment_id']])->first();
            if (isset($payment_data) && function_exists($payment_data->success_hook)) {
                call_user_func($payment_data->success_hook, $payment_data);
            }
          
              // Instantiate the controller
        $tryotoController = app(\App\Http\Controllers\TryotoController::class);

        // Call the method
        $response = $tryotoController->createOrderFromData($transRef);
                     // ✅ Create order in Tryoto
            return $this->payment_response($payment_data, 'success');
        }

        // handle fail
        $payment_data = $this->payment::where(['id' => $request['payment_id']])->first();
        if (isset($payment_data) && function_exists($payment_data->failure_hook)) {
            call_user_func($payment_data->failure_hook, $payment_data);
        }
        session()->flash('payment_failed', true);
        
  
        return $this->payment_response($payment_data, 'fail');
    }


    public function response(Request $request)
    {
        dd($request->all());
        return response()->json($this->response_formatter(GATEWAYS_DEFAULT_200), 200);
    }
}
