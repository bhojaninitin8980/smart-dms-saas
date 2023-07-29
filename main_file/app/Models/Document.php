<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public $fillable=[
        'name',
        'category_id',
        'sub_category_id',
        'document',
        'description',
        'tages',
        'parent_id',
    ];
}
