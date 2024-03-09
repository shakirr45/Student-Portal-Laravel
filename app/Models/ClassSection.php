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
		$data = ClassSection::orderBy('id', 'ASC')->pluck('name', 'name')->toArray();
		
		return $data;
	}
}
