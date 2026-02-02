<?php
require_once __DIR__ . '/../../vendor/autoload.php';

class MidtransHelper
{
    public static function init()
    {
        \Midtrans\Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;
    }

    /**
     * Payload:
     * [
     *   order_id,
     *   gross_amount,
     *   items,
     *   customer
     * ]
     */
    public static function createTransaction(array $payload)
    {
        self::init();

        // 🔒 VALIDASI WAJIB
        if (
            empty($payload['order_id']) ||
            empty($payload['gross_amount']) ||
            empty($payload['items'])
        ) {
            throw new Exception('Payload Midtrans tidak lengkap');
        }

        $transaction = [
            'transaction_details' => [
                // ⚠️ WAJIB UNIK
                'order_id'     => $payload['order_id'],
                'gross_amount' => (int) $payload['gross_amount'],
            ],
            'item_details' => $payload['items'],
            'customer_details' => [
                'first_name' => $payload['customer']['name'] ?? 'Guest',
                'email'      => $payload['customer']['email'] ?? 'guest@example.com',
                'phone'      => $payload['customer']['phone'] ?? '08123456789',
                'billing_address' => [
                    'first_name'   => $payload['customer']['name'] ?? 'Guest',
                    'address'      => $payload['customer']['address'] ?? '-',
                    'city'         => $payload['customer']['city'] ?? '-',
                    'postal_code'  => $payload['customer']['postal_code'] ?? '-',
                    'country_code' => 'IDN',
                ],
                'shipping_address' => [
                    'first_name'   => $payload['customer']['name'] ?? 'Guest',
                    'address'      => $payload['customer']['address'] ?? '-',
                    'city'         => $payload['customer']['city'] ?? '-',
                    'postal_code'  => $payload['customer']['postal_code'] ?? '-',
                    'country_code' => 'IDN',
                ],
            ],
        ];

        return \Midtrans\Snap::getSnapToken($transaction);
    }
}
