<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WireTransferHistory extends Model
{
    protected $fillable = [
        'user_id',
        'account',
        'amount',
        'beneficiary_name',
        'account_number',
        'bank',
        'swift_code',
        'routing_number',
        'tax_code',
        'status',
        'remarks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
