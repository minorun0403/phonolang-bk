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
        Schema::create('dtb_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('dtb_users')->onDelete('cascade');
            $table->foreignId('long_question_id')->nullable()->constrained('dtb_long_questions')->onDelete('cascade');
            $table->foreignId('word_question_id')->nullable()->constrained('dtb_word_questions')->onDelete('cascade');
            $table->boolean('is_correct')->default(0);
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
        Schema::dropIfExists('dtb_user_answers');
    }
};
