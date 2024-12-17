<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\RatingsTableSeeder;
use Database\Seeders\ClassificationTableSeeder;
use Database\Seeders\SysClassificationTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClassificationTableSeeder::class);
        $this->call(SysClassificationTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
    }
}
