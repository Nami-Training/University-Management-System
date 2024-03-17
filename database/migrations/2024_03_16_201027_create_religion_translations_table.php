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
        Schema::create('religion_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('religion_id')->unsigned();
            $table->string('locale')->index();
            $table->string('Name');

            $table->unique(['religion_id', 'locale']);
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('religion_translations');
    }
};
