<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 20; $i++) {
          User::create([
            'nama' => $faker->name,
            'username' => $faker->userName,
            'password' => '$2y$10$eAn4Qdh25fXdeDqz5RwgsObONn4d40D41lK2h/WMpMfHS2U1w68oe',
            'password_text' => 'admin123',
            'level' => $faker->randomElement($array = array (1,2,3,5))
          ]);
        }
    }
}
