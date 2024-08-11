<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Course;
use App\Models\CourseContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Panggil seeder untuk pengguna
        $this->call(UserSeeder::class);

        // Buat 5 Divisi, masing-masing dengan 10 Kursus, dan setiap Kursus memiliki 5 Konten
        Division::factory(5)->create()->each(function ($division) {
            // Tetapkan step_order unik untuk setiap course dalam division ini
            for ($stepOrder = 1; $stepOrder <= 10; $stepOrder++) {
                $course = Course::factory()->create([
                    'division_id' => $division->id,
                    'step_order' => $stepOrder,
                ]);

                // Tetapkan step_order unik untuk setiap content dalam course ini
                for ($contentOrder = 1; $contentOrder <= 5; $contentOrder++) {
                    CourseContent::factory()->create([
                        'course_id' => $course->id,
                        'step_order' => $contentOrder,
                    ]);
                }
            }
        });
    }
}
