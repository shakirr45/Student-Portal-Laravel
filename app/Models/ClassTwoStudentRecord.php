<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTwoStudentRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'session_id',
        'promote_class_id',
        'section_id',
        'amar_bangla_boi_1st_term',
        'amar_bangla_boi_2nd_term',
        'amar_bangla_boi_3rd_term',
        'english_for_today_1st_term',
        'english_for_today_2nd_term',
        'english_for_today_3rd_term',
        'prathomik_gonit_1st_term',
        'prathomik_gonit_2nd_term',
        'prathomik_gonit_3rd_term',

        'entry_user_id',
        'modified_user_id',

        // 'promote_status',

    ];
}
