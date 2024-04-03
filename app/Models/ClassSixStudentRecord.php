<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSixStudentRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'session_id',
        'promote_class_id',
        'section_id',

        'shastho_surokkha_1st_term',
        'shastho_surokkha_2nd_term',
        'shastho_surokkha_3rd_term',

        'gonit_1st_term',
        'gonit_2nd_term',
        'gonit_3rd_term',

        'biggan_1st_term',
        'biggan_2nd_term',
        'biggan_3rd_term',

        'digital_projukti_1st_term',
        'digital_projukti_2nd_term',
        'digital_projukti_3rd_term',

        'bangla_1st_term',
        'bangla_2nd_term',
        'bangla_3rd_term',

        'engregi_1st_term',
        'engregi_2nd_term',
        'engregi_3rd_term',

        'itihash_o_shamjik_biggan_1st_term',
        'itihash_o_shamjik_biggan_2nd_term',
        'itihash_o_shamjik_biggan_3rd_term',

        'jibon_o_jibika_1st_term',
        'jibon_o_jibika_2nd_term',
        'jibon_o_jibika_3rd_term',

        'shilpo_o_shonoskrity_1st_term',
        'shilpo_o_shonoskrity_2nd_term',
        'shilpo_o_shonoskrity_3rd_term',

        'dhormo_sikkaha_1st_term',
        'dhormo_sikkaha_2nd_term',
        'dhormo_sikkaha_3rd_term',

        // 'promote_status',

        'entry_user_id',
        'modified_user_id',

    ];
}

