<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'division_id' => Division::factory(), 
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl(640, 480, 'education', true, 'Faker'),
        ];
    }
}
