<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassOneStudentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'student_id',
        'session_id',
        'subject_id',
        'section_id',
        'promote_class',
        
        '1st_term_exam_result',
        '2nd_term_exam_result',
        '3rd_term_exam_result',
        'final_result',
        
        
        // 'assign_class_id',
        // 'amar_bangla_boi_1st_term',
        // 'amar_bangla_boi_2nd_term',
        // 'amar_bangla_boi_3rd_term',
        // 'english_for_today_1st_term',
        // 'english_for_today_2nd_term',
        // 'english_for_today_3rd_term',
        // 'prathomik_gonit_1st_term',
        // 'prathomik_gonit_2nd_term',
        // 'prathomik_gonit_3rd_term',

        // 'promote_status',

        'entry_user_id',
        'modified_user_id',

    ];
}










