<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'class', 
        'section', 
        // 'subjects', 
        // 'assign_teacher_id', 
        // 'days', 
    ];

    public function userAsTeacher()
    {
        return $this->belongsTo('App\Models\User', 'assign_teacher_id');
    }
}


