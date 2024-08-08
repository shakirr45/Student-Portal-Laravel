<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSevenStudentRecord extends Model
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
        

        'entry_user_id',
        'modified_user_id',

    ];
}
