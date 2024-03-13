<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionClass extends Model
{
    use HasFactory;
    protected $hidden = [
        'name',
        'code',
    ];

    protected function dataList( )
	{
		$data = InstitutionClass::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
		
		return $data;
	}

    public function classAssign()
    {
        return $this->hasOne('App\Models\ClassAssign');
    }

    public function classWiseSubjectAssign()
    {
        return $this->hasOne('App\Models\ClassWiseSubjectAssign');
    }

}
