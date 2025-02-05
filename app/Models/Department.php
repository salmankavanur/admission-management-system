<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=[
        'institute_id',
        'name',
        'logo',
        'payment_type',
        'amount',
        'last_date',
        'status',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class,'institute_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class,'department_id');
    }
    public function brochures()
    {
        return $this->hasMany(brochure::class,'department_id');
    }
}
