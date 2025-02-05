<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'institute_id',
        'department_id',
        'profile_photo',
        'name',
        'email',
        'gender',
        'dob',
        'nationality',
        'religion',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'address',
        'city',
        'district',
        'state',
        'pin',
        'mobile',
        'aadhar',
        'sslc',
        'previous_certificate',
        'islamic_qualfication',
        'islamic_year',
        'secular_qualfication',
        'secular_year',
        'previous_education',
        'previous_education_details',
        'aim_1',
        'aim_2',
        'aim_3',
        'hobbies',
        'activites',
        'status',
        'attendance',
        'attendance_time',
        'attendance_taken_by',
        'free',
        'signature',
        'grade',
    ];
    public function institute()
    {
        return $this->belongsTo(Institute::class,'institute_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function results()
    {
        return $this->hasMany(FormDataResult::class,'student_id');
    }
}
