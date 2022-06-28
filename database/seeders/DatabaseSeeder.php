<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      RoleSeeder::class,
      CountrySeeder::class,
      UserSeeder::class,
      CategorySeeder::class,
    ]);

    \App\Models\Course::factory()->count(30)->create()->each(function (\App\Models\Course $course) {
      $course->quizzes()->saveMany(Quiz::factory()->count(10)->make());
    });
  }
}
