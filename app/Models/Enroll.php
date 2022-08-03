<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','class_id'];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id', 'id');
    }
    public function class()
    {
        return $this->belongsTo(\App\Models\Classes::class, 'class_id', 'id');
    }
}
