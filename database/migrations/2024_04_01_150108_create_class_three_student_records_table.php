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
        Schema::create('class_three_student_records', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->default(0);
            $table->integer('session_id')->default(0);
            $table->integer('promote_class_id')->default(0);
            $table->integer('section_id')->default(0);
            // $table->integer('promote_status')->default(1);
            $table->string('amar_bangla_boi_1st_term')->nullable();
            $table->string('amar_bangla_boi_2nd_term')->nullable();
            $table->string('amar_bangla_boi_3rd_term')->nullable();

            $table->string('english_for_today_1st_term')->nullable();
            $table->string('english_for_today_2nd_term')->nullable();
            $table->string('english_for_today_3rd_term')->nullable();

            $table->string('prathomik_gonit_1st_term')->nullable();
            $table->string('prathomik_gonit_2nd_term')->nullable();
            $table->string('prathomik_gonit_3rd_term')->nullable();

            $table->string('bangladesh_o_bissho_porichoy_1st_term')->nullable();
            $table->string('bangladesh_o_bissho_porichoy_2nd_term')->nullable();
            $table->string('bangladesh_o_bissho_porichoy_3rd_term')->nullable();

            $table->string('islam_o_noytik_shikkha_1st_term')->nullable();
            $table->string('islam_o_noytik_shikkha_2nd_term')->nullable();
            $table->string('islam_o_noytik_shikkha_3rd_term')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_three_student_records');
    }
};
