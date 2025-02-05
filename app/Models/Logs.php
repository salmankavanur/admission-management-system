<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable=[
        'admin_id',
        'user_id',
        'description',
        

    ];


    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
