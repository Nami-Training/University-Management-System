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
        Schema::create('gender_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gender_id')->unsigned();
            $table->string('locale')->index();
            $table->string('Name');

            $table->unique(['gender_id', 'locale']);
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender_translations');
    }
};
