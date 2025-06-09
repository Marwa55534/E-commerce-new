<?php

namespace App\Services\Website;

use Illuminate\Support\Facades\Http;

class MyFatoorahService
{
    /**
     * Create a new class instance.
     */
    private $base_url , $headers;
    public function __construct()
    {
        $this->base_url = env('payment_base_url');
        $this->headers = [
            'Authorization' => 'Bearer ' . env('payment_token'), 
            
        ];
    }

    public function createRequest($uri, $method, $body = [])
    {
        if (empty($body)) {
            return false;
        }

        $response = Http::withHeaders($this->headers) 
            ->timeout(30)
            ->withoutVerifying()
            ->acceptJson()
            ->send($method, $this->base_url. $uri, [
                'json' => $body,
            ]);


        if(!$response->successful()){
            return false;
        }
        return $response->json();
    }

    
    
    public function checkout($data)
    {
        return $this->createRequest('v2/SendPayment', 'POST', $data);
    }

    public function getPaymentStatus($data)
    {
        return $this->createRequest('v2/getPaymentStatus', 'POST', $data);
    }
}
