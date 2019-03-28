<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
//use App\User;

class TermsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();

        DB::table('terms')->insert([
            'name' => 'Some good terms',
            'content' => $faker->realText(450),
            'user_id' => 1,
            'published_at' => $faker->dateTimeThisMonth,
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
        ]);

        DB::table('terms')->insert([
            'name' => 'We should polish this terms',
            'content' => $faker->realText(450),
            'user_id' => 2,
            'published_at' => null,
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
        ]);
        
        DB::table('terms')->insert([
            'name' => 'Some other terms',
            'content' => $faker->realText(450),
            'user_id' => 2,
            'published_at' => null,
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
        ]);
        
        DB::table('terms')->insert([
            'name' => 'Some good terms but old',
            'content' => $faker->realText(450),
            'user_id' => 2,
            'published_at' => $faker->dateTime('2019-02-30 19:28:21'),
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
        ]);
    }

}
