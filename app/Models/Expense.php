<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $timestamps = true;
    
    protected $fillable=[
        'category',
        'amount',
        'date',
        'user_id',
        'role_id',
    ];
}
