<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'user_id',
        'dept',
        'subject',
        'message',
        'reference',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
