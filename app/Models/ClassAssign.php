<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'teacher_id', 
        'class_id', 
        'class', 
        // 'section_id', 
        'subject_id', 
        // 'days',
        // 'class_schedule', 
    ];

    // protected function classOneDataList( )
	// {
	// 	$data = ClassAssign::orderBy('id', 'ASC')->where('class', 1)->pluck('subject_id', 'id')->toArray();
		
	// 	return $data;
	// }


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

    public function manageClass()
    {
        return $this->hasOne('App\Models\ManageClass');
    }

}


