<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BrandsSeeder::class,
            ProductsTableSeeder::class,
            ProductImageSeeder::class,
            CategoryProductSeeder::class,
            ProductLinkCategorieSeeder::class,
            UsersTableSeeder::class,
            AdminSeeder::class
        ]);
    }
}
