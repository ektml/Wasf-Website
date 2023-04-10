<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name' => "ahmed essawy",
            'email' => Str::random(10).'@gmail.com',
            "phone"=>"01091023782",
             "id_number"=>"41231222",
            "type"=>"freelancer",
            'password' => Hash('12345678'),
        ]);
       DB::table('users')->insert([
            'name' => "mohammed",
            'email' => Str::random(10).'@gmail.com',
            "phone"=>"01031923782",
             "id_number"=>"41231222",
            "type"=>"user",
            'password' => Hash('12345678'),
        ]);
       DB::table('users')->insert([
            'name' => "kalid ",
            'email' => Str::random(10).'@gmail.com',
            "phone"=>"01191023782",
             "id_number"=>"41231222",
            "type"=>"admin",
            'password' => Hash('12345678'),
        ]);
    }
}
