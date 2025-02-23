<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'user_id',
        'last_login_at',
        'last_login_ip',
        'last_login_user_agent',

    ];
}
