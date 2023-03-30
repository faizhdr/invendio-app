<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('merek')->insert(
            [
                [
                    'nama' => 'Toshiba',
                ],
                [
                    'nama' => 'Samsung',
                ],
                [
                    'nama' => 'LG'
                ],
            ]);
    }
}
