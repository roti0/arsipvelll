<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Seeder;

class DivisionTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            ['division_name'=>'Stake Holder',
        ],
            ['division_name'=>'Marketing',
        ],
            ['division_name'=>'Finance',
        ],            
            ['division_name'=>'Technician',
        ],
            ['division_name'=>'Scientist',
        ],
            ['division_name'=>'Human Resource',
        ],

        ]);
    }
}
