<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ];

    protected function dataList( )
	{
		$data = ClassSection::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
		
		return $data;
	}

    public function userList()
    {
        return $this->hasOne('App\Models\User');
    }

    public function classAssign()
    {
        return $this->hasOne('App\Models\ClassAssign');
    }
    public function manageClass()
    {
        return $this->hasOne('App\Models\ManageClass');
    }
}
