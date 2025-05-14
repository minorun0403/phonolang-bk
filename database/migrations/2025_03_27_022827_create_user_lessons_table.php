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
        Schema::create('dtb_user_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('dtb_users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('dtb_lessons')->onDelete('cascade');
            $table->float('score');
            $table->timestamp('completed_at')->useCurrent();
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
        Schema::dropIfExists('dtb_user_lessons');
    }
};
