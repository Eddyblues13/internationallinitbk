<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckingBalance extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
