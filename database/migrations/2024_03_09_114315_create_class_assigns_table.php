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
        Schema::create('class_assigns', function (Blueprint $table) {
            $table->id();
            // $table->integer('teacher_id')->default(0);
            $table->integer('class_id')->default(0);
            $table->string('class')->nullable();
            // $table->integer('section_id')->default(0);
            $table->integer('subject_id')->default(0);
            // $table->string('days')->nullable();
            // $table->string('class_schedule')->nullable();
            // $table->integer('assign_teacher_id')->default(0);
            // $table->text('days')->nullable()->comment('Json Data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_assigns');
    }
};
