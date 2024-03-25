<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id', 
        'class_id', 
        'section_id', 
        'subject_id', 
        'days',
        'class_schedule', 
    ];


    public function institutionClass()
    {
        return $this->belongsTo('App\Models\InstitutionClass', 'class_id');
    }

    public function classSection()
    {
        return $this->belongsTo('App\Models\ClassSection', 'section_id');
    }


    public function userList()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

}


