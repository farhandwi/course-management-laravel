<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('photo')->nullable()->default('https://via.placeholder.com/640x480.png/0088ff?text=education+Faker+neque');
            $table->integer('step_order');
            $table->timestamps();
        
            $table->unique(['division_id', 'step_order']);
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
