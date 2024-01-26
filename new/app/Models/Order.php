<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'email',
        'card_number',
        'card_exp_month',
        'card_exp_year',
        'subscription',
        'subscription_id',
        'price',
        'price_currency',
        'txn_id',
        'payment_status',
        'receipt',
        'payment_type',
        'payment_status',
        'user_id',
    ];

    public static function orderData($data)
    {
        $orders = Order::create(
            [
                'order_id' =>  $data['order_id'],
                'name' =>  $data['name'],
                'card_number' => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                'card_exp_month' => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                'card_exp_year' => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                'subscription' =>  $data['subscription'],
                'subscription_id' => $data['subscription_id'],
                'price' => $data['price'],
                'price_currency' => isset($data['currency']) ? $data['currency'] : '',
                'txn_id' => isset($data['balance_transaction']) ? $data['balance_transaction'] : '',
                'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                'payment_type' => __('STRIPE'),
                'receipt' => isset($data['receipt_url']) ? $data['receipt_url'] : '',
                'user_id' => \Auth::user()->id,
            ]
        );
        return $orders;
    }

}
