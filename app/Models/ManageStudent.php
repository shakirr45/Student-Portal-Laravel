<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStudent extends Model
{
    use HasFactory;
    protected $hidden = [
        // 'class_assign_id',
    ];
}
