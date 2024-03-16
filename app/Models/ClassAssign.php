<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'class_id', 
        'section_id', 
        'subjects', 
        'days',
        'class_schedule', 
    ];

    // public function userAsTeacher()
    // {
    //     return $this->belongsTo('App\Models\User', 'assign_teacher_id');
    // }

    // public function subjectAssign()
    // {
    //     return $this->hasOne('App\Models\SubjectAssign');
    // }

    public function institutionClass()
    {
        return $this->belongsTo('App\Models\InstitutionClass', 'class_id');
    }
}


