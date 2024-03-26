<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    
    use HasFactory;
    protected $fillable = [
        'session',
        'session_year',
    ];

    protected function dataList( )
	{
		$data = Session::orderBy('id', 'ASC')->pluck('session', 'id')->toArray();
		
		return $data;

	}

    public function session()
    {
        return $this->hasOne('App\Models\User');
    }

    
}
