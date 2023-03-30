<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(
            [
                [
                    'nama' => 'Elektronik',
                ],
                [
                    'nama' => 'Furniture',
                ],
                [
                    'nama' => 'Fashion'
                ],
            ]);
    }
}
