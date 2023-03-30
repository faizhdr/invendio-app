<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert(
            [
                [
                    'nama' => 'Bangku',
                    'foto' => '',
                    'idmerek' => 1,
                    'idkategori' => 2,
                    'keterangan' => 'Bangku dari Kayu Jati',
                ],
                [
                    'nama' => 'Meja',
                    'foto' => '',
                    'idmerek' => 2,
                    'idkategori' => 3,
                    'keterangan' => 'Meja dari Kayu Jati',
                ],
                
                
            ]);
    }
}
