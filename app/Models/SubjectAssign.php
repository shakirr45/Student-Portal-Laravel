<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_assign_id',
        'assign_teacher_id',
        'subjects',
        'days',
    ];

    public function classAssign()
    {
        return $this->belongsTo('App\Models\ClassAssign', 'class_assign_id');
    }

    public function userList()
    {
        return $this->belongsTo('App\Models\User', 'assign_teacher_id');
    }
    
}
