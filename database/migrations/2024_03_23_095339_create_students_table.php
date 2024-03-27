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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->Integer('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->Integer('nationalitie_id')->unsigned();
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->Integer('blood_id')->unsigned();
            $table->foreign('blood_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->date('date_birth');
            $table->Integer('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->Integer('classroom_id')->unsigned();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->Integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
