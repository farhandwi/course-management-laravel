<?php

namespace Database\Factories;

use App\Models\CourseContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseContentFactory extends Factory
{
    protected $model = CourseContent::class;

    public function definition()
    {
        return [
            'course_id' => null, // Akan di-set di seeder
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'step_order' => 0, // Akan di-set di seeder
        ];
    }
}
