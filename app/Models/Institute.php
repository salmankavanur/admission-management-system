<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'city',
        'contact',
        'address',
        'logo',
        'last_date',
        'status',
    ];
    public function department()
    {
        return $this->hasMany(Department::class,'institute_id');
    }
    public function student()
    {
        return $this->hasMany(Student::class,'institute_id');
    }
    public function form()
    {
        return $this->hasMany(FormData::class,'institute_id');
    }
    public function results()
    {
        return $this->hasMany(FormDataResult::class,'institute_id');
    }
    public function brochures()
    {
        return $this->hasMany(brochure::class,'institute_id');
    }
}
