<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_detail',
        'transaction_type',
        'transaction_amount',
        // 'transaction_number' is auto-set by trigger
    ];

    // Optional relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

