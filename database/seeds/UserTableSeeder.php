<?php

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

  public function run() {

    $faker = Faker::create('ar_SA');

    for ($i = 0; $i < 10; $i++) {
      User::create([
        'name'         => $faker->name,
        'phone'        => "51111111$i",
        'email'        => $faker->unique()->email,
        'password'     => 123456,
        'is_blocked'      => rand(0, 1),
        'active'       => rand(0, 1),
      ]);
    }
  }
}
