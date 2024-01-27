<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'image',
        'total_user',
        'total_property',
        'total_tenant',
        'enabled_logged_history',
        'description',

    ];

    public static $duration = [
        'Monthly' => 'Monthly',
        'Quarterly' => 'Quarterly',
        'Yearly' => 'Yearly',
        'Unlimited' => 'Unlimited',
    ];

    public function couponCheck()
    {
       $packages= Coupon::whereRaw("find_in_set($this->id,applicable_packages)")->count();
      return $packages;
    }

}
