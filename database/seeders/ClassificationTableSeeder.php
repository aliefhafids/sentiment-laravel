<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Classification::create([
            'name' => 'Positif',
            'code' => 'PSF',
        ]);
        Classification::create([
            'name' => 'Netral',
            'code' => 'NTL',
        ]);
        Classification::create([
           'name' => 'Negatif',
           'code' => 'NGV',
       ]);
        
    }
}
