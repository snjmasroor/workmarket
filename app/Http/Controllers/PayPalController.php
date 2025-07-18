<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ToolPurchase;
use App\Models\Tool;

class PayPalController extends Controller
{
    private $clientId;
    private $secret;
    private $baseUrl;

    public function __construct()
    {
        $this->clientId = config('paypal.client_id');
        $this->secret = config('paypal.secret');
        $this->baseUrl = config('paypal.settings.mode') === 'sandbox'
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';
    }

   private function getAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->secret)
            ->asForm()
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials'
            ]);

        if ($response->successful()) {
            return $response->json('access_token');
        }

        throw new \Exception('Failed to retrieve PayPal access token: ' . $response->body());
    }



    public function createOrder(Request $request)
    {
        $tool = Tool::findOrFail($request->tool_id);
       
    // Step 1: Get Access Token
    $auth = base64_encode(config('paypal.client_id') . ':' . config('paypal.secret'));

    $tokenResponse = Http::asForm()->withHeaders([
        'Authorization' => 'Basic ' . $auth,
    ])->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
        'grant_type' => 'client_credentials',
    ]);

    $accessToken = $tokenResponse->json()['access_token'];

    // Step 2: Create Order
    $orderResponse = Http::withToken($accessToken)->withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
        'intent' => 'CAPTURE',
        'purchase_units' => [[
            'amount' => [
                'currency_code' => 'USD',
                'value' => (string) $tool->price, // Convert price to string
            ],
            'description' => $tool->name,
        ]],
    ]);

    \Log::info('PayPal Order Created', [
                    'user_id' => auth()->id(),
                    'tool_id' => $tool->id,
                    'order_id' => $orderResponse,
                ]);

    if ($orderResponse->failed()) {
        return response()->json(['error' => 'Unable to create order.'], 500);
    }

    return response()->json($orderResponse->json());

    }

    public function orderCreate(Request $request)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->post(env('PAYPAL_API_URL') . '/v2/checkout/orders', [
                'intent' => 'AUTHORIZE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $request->amount
                    ]
                ]],
                'payment_source' => [
                    'card' => [
                        'attributes' => [
                            'verification' => [
                                'method' => 'SCA_ALWAYS'
                            ]
                        ]
                    ]
                ]
            ]);

        return response()->json($response->json());
    }

    public function captureOrder(Request $request)
    {
       $orderId = $request->order_id;
    
        $auth = base64_encode(config('paypal.client_id') . ':' . config('paypal.secret'));
        $baseUrl = 'https://api-m.sandbox.paypal.com';

        // Get access token
        $tokenResponse = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])->post("$baseUrl/v1/oauth2/token", [
            'grant_type' => 'client_credentials',
        ]);

        $accessToken = $tokenResponse->json('access_token');

        \Log::info('PayPal Order Created', [
            'user_id' => auth()->id(),
            'order_id' => $orderId,
        ]);

        // IMPORTANT: Do not pass any body to capture API
        $response = Http::withToken($accessToken)
        ->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->withBody('', 'application/json') // <--- This forces NO body
        ->post("$baseUrl/v2/checkout/orders/{$orderId}/capture");

        \Log::info('PayPal Order Capture', [
            'response' => $response->json(),
            'order_id' => $orderId,
        ]);

        if ($response->successful() && $response->json('status') === 'COMPLETED') {
            $purchase = new ToolPurchase();
            $purchase->user_id = auth()->id();
            $purchase->tool_id = $tool->id;
            $purchase->addFlag(ToolPurchase::FLAG_ACTIVE);
            $purchase->addFlag(ToolPurchase::FLAG_PURCHASED);
            $purchase->payment_data = json_encode($response->json());
            $purchase->save();
        }

        return response()->json($response->json());
    }
    public function orderCapture(Request $request)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->post(env('PAYPAL_API_URL') . "/v2/checkout/orders/{$orderId}/authorize");

        return response()->json([
            'success' => $response->successful(),
            'data' => $response->json()
        ]);
    }
}
