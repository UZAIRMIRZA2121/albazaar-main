<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'tran_ref',
        'promotion_id',
        'product_ids',
        'start_date',
        'end_date',
        'promotion_type',
        'payment_status',
    ];

    protected $casts = [
        'product_ids' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
