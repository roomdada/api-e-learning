<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'title' => $this->faker->sentence,
      'slug' => $this->faker->slug,
      'description' => $this->faker->paragraph,
      'image_path' => 'course.jpeg',
      'price' => $this->faker->randomFloat(2, 0, 10000),
      'category_id' => \App\Models\Category::all()->random()->id,
      'posted_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
      'point' => $this->faker->randomFloat(2, 0, 100),
      'duration' => $this->faker->randomNumber(2),
    ];
  }
}
