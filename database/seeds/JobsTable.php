<?php

use Illuminate\Database\Seeder;

class JobsTable extends Seeder
{
    public function run()
    {
        DB::table('jobs')->insert([
        [
            'job_name'=>'Admin',
            'divisi'=>1,
            'salary'=>5000,
            'created_at'=>now(),
            'updated_at'=>now()
        ],
        [
            'job_name'=>'Director',
            'divisi'=>1,
            'salary'=>40000,
            'created_at'=>now(),
            'updated_at'=>now()
        ],
        [
            'job_name'=>'General Secretary',
            'divisi'=>1,
            'salary'=>25000,
            'created_at'=>now(),
            'updated_at'=>now()
        ]
        ]);
    }
}
