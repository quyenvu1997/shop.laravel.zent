<?php

use Illuminate\Database\Seeder;

class Product_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    	for ($i = 0; $i < 10; $i++) {
            DB::table('product_images')->insert([
                'product_id' => 1,
        		'link' => $faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
