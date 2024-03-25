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
            // $table->integer('bangla_sub_id')->default(0);
            // $table->integer('english_sub_id')->default(0);
            // $table->integer('mathematics_sub_id')->default(0);

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
