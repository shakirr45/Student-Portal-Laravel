<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_assign_id',
        'subjects',
        'days',
    ];
    
}
