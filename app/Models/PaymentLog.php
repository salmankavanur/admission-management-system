<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $fillable=[
        'r_payment_id',
        'method',
        'currency',
        'user_email',
        'user_id',
        'amount',
        'json_response',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
