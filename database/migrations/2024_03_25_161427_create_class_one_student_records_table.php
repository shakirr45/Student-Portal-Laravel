<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_one_student_records', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->default(0);
            $table->integer('session_id')->default(0);
            // $table->integer('assign_class_id')->default(0);
            $table->integer('subject_id')->default(0);
            $table->integer('section_id')->default(0);
            $table->string('promote_class')->nullable();

            $table->string('1st_term_exam_result')->nullable();
            $table->string('2nd_term_exam_result')->nullable();
            $table->string('3rd_term_exam_result')->nullable();
            $table->string('final_result')->nullable();

            // $table->integer('promote_status')->default(1);
            // $table->string('amar_bangla_boi_1st_term')->nullable();
            // $table->string('amar_bangla_boi_2nd_term')->nullable();
            // $table->string('amar_bangla_boi_3rd_term')->nullable();

            // $table->string('english_for_today_1st_term')->nullable();
            // $table->string('english_for_today_2nd_term')->nullable();
            // $table->string('english_for_today_3rd_term')->nullable();

            // $table->string('prathomik_gonit_1st_term')->nullable();
            // $table->string('prathomik_gonit_2nd_term')->nullable();
            // $table->string('prathomik_gonit_3rd_term')->nullable();

            $table->integer('entry_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_one_student_records');
    }
};
