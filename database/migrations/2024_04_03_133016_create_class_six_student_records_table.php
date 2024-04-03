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
        Schema::create('class_six_student_records', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->default(0);
            $table->integer('session_id')->default(0);
            $table->integer('promote_class_id')->default(0);
            $table->integer('section_id')->default(0);
            // $table->integer('promote_status')->default(1);

            $table->string('shastho_surokkha_1st_term')->nullable();
            $table->string('shastho_surokkha_2nd_term')->nullable();
            $table->string('shastho_surokkha_3rd_term')->nullable();

            $table->string('gonit_1st_term')->nullable();
            $table->string('gonit_2nd_term')->nullable();
            $table->string('gonit_3rd_term')->nullable();

            $table->string('biggan_1st_term')->nullable();
            $table->string('biggan_2nd_term')->nullable();
            $table->string('biggan_3rd_term')->nullable();

            $table->string('digital_projukti_1st_term')->nullable();
            $table->string('digital_projukti_2nd_term')->nullable();
            $table->string('digital_projukti_3rd_term')->nullable();


            $table->string('bangla_1st_term')->nullable();
            $table->string('bangla_2nd_term')->nullable();
            $table->string('bangla_3rd_term')->nullable();

            $table->string('engregi_1st_term')->nullable();
            $table->string('engregi_2nd_term')->nullable();
            $table->string('engregi_3rd_term')->nullable();

            $table->string('itihash_o_shamjik_biggan_1st_term')->nullable();
            $table->string('itihash_o_shamjik_biggan_2nd_term')->nullable();
            $table->string('itihash_o_shamjik_biggan_3rd_term')->nullable();

            $table->string('jibon_o_jibika_1st_term')->nullable();
            $table->string('jibon_o_jibika_2nd_term')->nullable();
            $table->string('jibon_o_jibika_3rd_term')->nullable();

            $table->string('shilpo_o_shonoskrity_1st_term')->nullable();
            $table->string('shilpo_o_shonoskrity_2nd_term')->nullable();
            $table->string('shilpo_o_shonoskrity_3rd_term')->nullable();

            $table->string('dhormo_sikkaha_1st_term')->nullable();
            $table->string('dhormo_sikkaha_2nd_term')->nullable();
            $table->string('dhormo_sikkaha_3rd_term')->nullable();


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
        Schema::dropIfExists('class_six_student_records');
    }
};
