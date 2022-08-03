<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function enroll()
    {
        return $this->hasMany(\App\Models\Enroll::class, 'class_id', 'id');
    }
}
