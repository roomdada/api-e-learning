<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $category = Category::create([
      'name' => 'Marketing',
      'description' => 'Cette catégorie permet de décrire les compétences de marketing',
    ]);

    $category = Category::create([
      'name' => 'Programmation',
      'description' => 'Cette catégorie permet de décrire les compétences de programmation',
    ]);

    $category = Category::create([
      'name' => 'Réseau',
      'description' => 'Cette catégorie permet de décrire les compétences de réseau',
    ]);

    foreach (Category::all() as $key => $category) {
      $category->childrens()->create([
        'name' => 'Cours de ' . $category->name,
        'description' => 'Cette catégorie permet de décrire les compétences de ' . $category->name,
      ]);
    }
  }
}
