<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_word_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained('mtb_languages')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('dtb_lessons')->onDelete('cascade');
            $table->string('word');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_word_questions');
    }
};
