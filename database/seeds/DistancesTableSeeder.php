<?php

use Illuminate\Database\Seeder;

class DistancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tollbooths = \App\Tollbooth::orderBy('id', 'ASC')->get();

        foreach ($tollbooths as $first) {
            $soFar = 0;
            foreach ($tollbooths as $second) {
                if($first->id < $second->id) {
                    $value = mt_rand(11, 15);
                    $soFar += $value;
                    \App\Distance::create([
                        'tollbooth1_id' => $first->id,
                        'tollbooth2_id' => $second->id,
                        'value' => $soFar
                    ]);
                }
            }
        }
    }
}
