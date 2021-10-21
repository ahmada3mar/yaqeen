<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'branch_id',
        'user_id',
        'type',
        'name',
        'car_price',
        'car_type',
        'car_number',
        'car_name',
        'car_model',
        'body_number',
        'eng_number',
        'start_at',
        'end_at',
        'policy_date',
        'policy_number',
        'cost',
        'price',
        'status',
    ];



}
