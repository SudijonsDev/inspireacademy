<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centres')->insert([
            'name' => 'Bisho 1',
        ]);
        DB::table('centres')->insert([
            'name' => 'Bisho 2',
        ]);
        DB::table('centres')->insert([
            'name' => 'King Williams Town',
        ]);
        DB::table('centres')->insert([
            'name' => 'Soweto',
        ]);
    }
}
