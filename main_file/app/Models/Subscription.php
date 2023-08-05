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
        'total_document',
        'enabled_document_history',
        'enabled_logged_history',
        'description',

    ];

    public static $duration = [
        'Monthly' => 'Monthly',
        'Yearly' => 'Yearly',
        'Unlimit' => 'Unlimit',
    ];

}
