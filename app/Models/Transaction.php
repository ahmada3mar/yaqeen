<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =[
        'branch_id',
        'user_id',
        'type',
        'description',
        'amount',
        'account_id',
        'policy_id',
    ];
}
