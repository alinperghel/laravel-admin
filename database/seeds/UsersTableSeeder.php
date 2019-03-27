<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Alin V',
            'email' => 'a.perghel@gmail.com',
            'email_verified_at' => $faker->dateTime,
            'password' => Hash::make('123xYz!@#'),
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
            'terms_accepted_at' => $faker->dateTime,
            'phone_number' => $faker->phoneNumber
        ]);

        DB::table('users')->insert([
            'name' => 'Test UV',
            'email' => 'alin@develorom.ro',
            'email_verified_at' => null,
            'password' => Hash::make('123xYz!@#'),
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
            'terms_accepted_at' => $faker->dateTime,
            'phone_number' => $faker->phoneNumber
        ]);

        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'email_verified_at' => (rand(0, 1) == 1) ? $faker->dateTime : null,
                'password' => Hash::make('123xYz!@#'),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'terms_accepted_at' => $faker->dateTime,
                'phone_number' => $faker->phoneNumber
            ]);
        }
    }

}
