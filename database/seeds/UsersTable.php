<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name'=>'Clara Koeman',
            'email'=>'admin@admin.com',
            'address'=>'Oklahoma, Manhattan 26',
            'job'=>1,
            'hiredate'=>now(),
            'birthdate'=>date('1980/01/12'),
            'password'=>bcrypt('password'),
            'level'=>1,
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now()],
            ['name'=>'Steven Low',
            'email'=>'aaaa@aaaa.com',
            'address'=>'New Montana, New York 26',
            'job'=>2,
            'hiredate'=>now(),
            'birthdate'=>date('1965/12/06'),
            'password'=>bcrypt('password'),
            'level'=>2,
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now()],
            ['name'=>'fired',
            'email'=>'fired@aaa.com',
            'address'=>'Oklahoma, Manhattan 26',
            'job'=>3,
            'hiredate'=>now(),
            'birthdate'=>date('1980/01/12'),
            'password'=>bcrypt('password'),
            'level'=>2,
            'status'=>0,
            'created_at'=>now(),
            'updated_at'=>now()]

        ]);
    }
}
