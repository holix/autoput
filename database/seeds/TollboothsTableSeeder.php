<?php

use Illuminate\Database\Seeder;

class TollboothsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Čatrnja', 'Cerovljani', 'Aleksandrovac', 'Laktaši', 'Banja Luka'] as $tollbooth) {
            \App\Tollbooth::create([
                'name' => $tollbooth
            ]);
        }
    }
}
