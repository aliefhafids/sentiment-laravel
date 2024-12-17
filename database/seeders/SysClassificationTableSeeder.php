<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sysclassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SysClassificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Sysclassification::create([
            'name' => 'Positif',
            'code' => 'PSF',
        ]);
        Sysclassification::create([
            'name' => 'Netral',
            'code' => 'NTL',
        ]);
        Sysclassification::create([
           'name' => 'Negatif',
           'code' => 'NGV',
       ]);
        Sysclassification::create([
           'name' => 'Tidak Diketahui',
           'code' => 'Null',
       ]);
    }
}
