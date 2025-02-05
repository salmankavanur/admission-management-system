<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    protected $fillable=[
        'institute_id',
        'questions',
    ];
    public function institute()
    {
        return $this->belongsTo(Institute::class,'institute_id');
    }
}
