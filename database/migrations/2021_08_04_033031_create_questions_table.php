<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->unsignedInteger('views')->default(0);//đếm câu hỏi được xem bn lần
            $table->unsignedInteger('answers')->default(0);//đếm bao nhiêu câu trả lời cho câu hỏi đó
            $table->integer('votes')->default(0);//đếm bao nhiêu người đang đặt 1 câu hỏi
            $table->unsignedBigInteger('best_answer_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
