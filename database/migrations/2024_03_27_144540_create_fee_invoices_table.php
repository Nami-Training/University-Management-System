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
        Schema::create('fee_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('invoice_date')->default(now());
            $table->Integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->Integer('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->Integer('classroom_id')->unsigned();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->Integer('fee_id')->unsigned();
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
            $table->decimal('amount',8,2);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_invoices');
    }
};
