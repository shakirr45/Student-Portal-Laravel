<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id', 
        'section', 
        // 'subjects', 
        // 'assign_teacher_id', 
        // 'days', 
    ];

    public function userAsTeacher()
    {
        return $this->belongsTo('App\Models\User', 'assign_teacher_id');
    }

    public function subjectAssign()
    {
        return $this->hasOne('App\Models\SubjectAssign');
    }

    public function institutionClass()
    {
        return $this->belongsTo('App\Models\InstitutionClass', 'class_id');
    }
}


