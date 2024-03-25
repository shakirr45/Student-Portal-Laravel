<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sub_code',
    ];

    protected function dataList( )
	{
		$data = Subject::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
		
		return $data;
	}

    public function classAssign()
    {
        return $this->hasOne('App\Models\ClassAssign');
    }
}

