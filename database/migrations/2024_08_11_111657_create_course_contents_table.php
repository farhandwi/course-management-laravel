<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseContentsTable extends Migration
{
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->integer('step_order');
            $table->timestamps();

            $table->unique(['course_id', 'step_order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
}
