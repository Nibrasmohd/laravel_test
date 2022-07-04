<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class addtousers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('regusers')->insert([
            'username'=>'Jhon',
            'usermail'=>'jhon@gmail.com',
            'userpass'=>Hash::make(1234)
        ]);
    }
}
