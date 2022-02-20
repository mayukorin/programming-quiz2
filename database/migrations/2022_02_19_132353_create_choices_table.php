<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quiz_id');
            $table->string('content');
            $table->integer('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign('quizzes_correct_choice_id_foreign');
            $table->dropColumn('correct_choice_id');
        });
        Schema::dropIfExists('choices');
        Schema::dropIfExists('quizzes');
    }
}
