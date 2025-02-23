<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferHistory extends Model
{

    protected $fillable = [
        'reference',
        'user_id',
        'type',
        'amount',
        'currency',
        'from_account',
        'details',
        'status',
        'completed_at'
    ];

    protected $casts = [
        'details' => 'array',
        'completed_at' => 'datetime',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
