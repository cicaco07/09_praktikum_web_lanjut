<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['nama_kelas' => 'TI_2A',],
            ['nama_kelas' => 'TI_2B',],
            ['nama_kelas' => 'TI_2C',],
            ['nama_kelas' => 'TI_2D',],
            ['nama_kelas' => 'TI_2E',],
            ['nama_kelas' => 'TI_2F',],
            ['nama_kelas' => 'TI_2G',],
            ['nama_kelas' => 'TI_2H',],
            ['nama_kelas' => 'TI_2I',],
        ];

        DB::table('kelas')->insert($kelas);
    }
}
