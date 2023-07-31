<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    public $fillable=[
        'subject',
        'message',
        'date',
        'time',
        'assign_user',
        'send_email',
        'document_id',
        'parent_id',
    ];
}
