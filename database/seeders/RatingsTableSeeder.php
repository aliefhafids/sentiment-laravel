<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'ratings' => '1',
            'desc' => 'Sangat Buruk',
        ]);
        Rating::create([
            'ratings' => '2',
            'desc' => 'Buruk',
        ]);
        Rating::create([
            'ratings' => '3',
            'desc' => 'Sedang',
        ]);
        Rating::create([
            'ratings' => '4',
            'desc' => 'Baik',
        ]);
        Rating::create([
           'ratings' => '5',
           'desc' => 'Sangat Baik',
       ]);
        
    }
}
