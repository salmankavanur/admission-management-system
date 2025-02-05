<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brochure extends Model
{
    use HasFactory;
    protected $fillable=[
        'institute_id',
        'department_id',
        'file',
    ];
    public function institute()
    {
        return $this->belongsTo(Institute::class,'institute_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
