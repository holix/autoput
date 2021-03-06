<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TollboothsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DistancesTableSeeder::class);
        $this->call(PricesTableSeeder::class);
    }
}
