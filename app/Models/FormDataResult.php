<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDataResult extends Model
{
    use HasFactory;
    protected $fillable=[
        'institute_id',
        'student_id',
        'answers',
    ];
    public function institute()
    {
        return $this->belongsTo(Institute::class,'institute_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
