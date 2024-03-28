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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->Integer('student_id')->unsigned();
            $table->Integer('from_grade')->unsigned();
            $table->Integer('from_Classroom')->unsigned();
            $table->Integer('from_section')->unsigned();
            $table->Integer('to_grade')->unsigned();
            $table->Integer('to_Classroom')->unsigned();
            $table->Integer('to_section')->unsigned();
            $table->string('academic_year');
            $table->string('academic_year_new');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('from_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('from_Classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('to_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('to_Classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
