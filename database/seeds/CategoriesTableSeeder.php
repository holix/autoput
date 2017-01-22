<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['A - motocikli', 'B - motorna vozila do 3500kg', 'C1 - motorna vozila od 3500kg', 'C - motorna vozila od 7500kg', 'D - autobusi'] as $category) {
            \App\Category::create([
                'name' => $category
            ]);
        }
    }
}
