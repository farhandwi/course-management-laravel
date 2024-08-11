<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCourseContentsTable extends Migration
{
    public function up()
    {
        Schema::create('user_course_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_course_id')->constrained('user_courses')->onDelete('cascade');
            $table->foreignId('content_id')->constrained('course_contents')->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_course_contents');
    }
}
