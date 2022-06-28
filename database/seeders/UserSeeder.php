<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'identifier' => 'admin',
      'first_name' => 'Admin',
      'last_name' => 'Gestionnaire',
      'email' => 'admin@email.ci',
      'password' => bcrypt('password'),
      'role_id' => Role::ADMIN,
      'contact' => '0102030405',
      'gender' => 'M'
    ]);
   
  }
}
