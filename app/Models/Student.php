<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id','name', 'age','class_id'];

    public function parent()
    {
        return $this->belongsTo(\App\Models\User::class, 'parent_id', 'id');
    }
    public function class()
    {
        return $this->belongsTo(\App\Models\Classes::class, 'class_id', 'id');
    }
}
