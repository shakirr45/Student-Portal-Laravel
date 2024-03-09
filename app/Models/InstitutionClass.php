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
		$data = InstitutionClass::orderBy('id', 'ASC')->pluck('name', 'name')->toArray();
		
		return $data;
	}
}
