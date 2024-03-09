<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ];


    protected function dataList( )
	{
		$data = DayOfWeek::orderBy('id', 'ASC')->pluck('name', 'name')->toArray();
		
		return $data;
	}
}
