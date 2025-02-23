<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardDeposit extends Model
{
    protected $fillable = [
        'user_id',
        'account',
        'amount',
        'cardType',
        'cardName',
        'cardNumber',
        'cardExp',
        'cardCvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
