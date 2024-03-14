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
        Schema::create('specialization_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialization_id')->unsigned();
            $table->string('locale')->index();
            $table->string('Name');

            $table->unique(['specialization_id', 'locale']);
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialization_translations');
    }
};
