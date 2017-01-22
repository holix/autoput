<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tollbooths = \App\Tollbooth::orderBy('id', 'ASC')->get();
        $categories = \App\Category::orderBy('id', 'ASC')->get();

        foreach($categories as $category) {
            $category_base = log($category->id + 1, 3);
            foreach ($tollbooths as $first) {
                $soFar = 0;
                foreach ($tollbooths as $second) {
                    if ($first->id < $second->id) {
                        $value = round(mt_rand(11, 15) * $category_base / 20, 1);
                        $soFar += $value;
                        \App\Price::create([
                            'tollbooth1_id' => $first->id,
                            'tollbooth2_id' => $second->id,
                            'category_id' => $category->id,
                            'value' => $soFar
                        ]);
                    }
                }
            }
        }
    }
}
