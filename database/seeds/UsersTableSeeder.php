<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    	for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([ 
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'address'=>$faker->text($maxNbChars = 50),
                'mobile' => 123456789,
                'password' => Hash::make('123456')
            ]);
        }
    }
}
