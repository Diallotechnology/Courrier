<?php
declare(strict_types=1);
namespace App\Helper;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

trait OrderAPI
{
    // genere le lien de paiement
    public function create_order(int $transaction_id, int $amount): array
    {
        if (! is_numeric($amount) || $amount <= 0) {
            throw new InvalidArgumentException("Invalid amount: $amount");
        }

        if (empty($transaction_id)) {
            throw new InvalidArgumentException('Transaction ID cannot be empty');
        }
        $payload = [
            'commande' => [
                'invoice' => [
                    'items' => [
                        [
                            'name' => '',
                            'description' => 'Description du service',
                            'quantity' => 1,
                            'unit_price' => $amount,
                            'total_price' => $amount,
                        ],
                    ],
                    'total_amount' => $amount,
                    'devise' => 'XOF',
                    'description' => '',
                    'customer' => '',
                    'customer_firstname' => '',
                    'customer_lastname' => '',
                    'customer_email' => '',
                ],
                'store' => [
                    'name' => '360appart',
                    'website_url' => 'https://couribox.com',
                ],
                'actions' => [
                    'cancel_url' => route('cancel', $transaction_id),
                    'return_url' => 'https://couribox.com',
                    'callback_url' => route('valid', $transaction_id),
                ],
                'custom_data' => [
                    'transaction_id' => $transaction_id,
                ],
            ],
        ];
        $response = Http::withHeaders([
            'Apikey' => Config::get('services.ligdicash.apikey'),
            'Authorization' => 'Bearer '.Config::get('services.ligdicash.authtoken'),
        ])->post('https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/create', $payload)->throw()->json();
        if ($response['response_code'] !== '00') {
            throw new Exception('Failed to create checkout invoice: '.$response['description']);
        }

        return $response;
    }

    public function order_etat(string $invoiceToken)
    {
        $response = Http::withHeaders([
            'Apikey' => Config::get('services.ligdicash.apikey'),
            'Authorization' => 'Bearer '.Config::get('services.ligdicash.authtoken'),
        ])->get('https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/confirm/?invoiceToken='.$invoiceToken);

        return $response->json();
    }
}
