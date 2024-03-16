<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassWiseSubjectAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_assign_id',
        'section_assign_id',
        'assign_teacher_id',
        'subjects',
        'days',
    ];

    public function institutionClass()
    {
        return $this->belongsTo('App\Models\InstitutionClass', 'class_assign_id');
    }

    public function userList()
    {
        return $this->belongsTo('App\Models\User', 'assign_teacher_id');
    }
}
