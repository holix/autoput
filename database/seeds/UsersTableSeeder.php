<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'admin' => true,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            \App\User::create([
                'email' => 'radnik' . $i . '@radnik.com',
                'password' => bcrypt('radnik' . $i),
                'first_name' => 'Radnik',
                'last_name' => '#' . $i,
                'admin' => false,
            ]);
        }
    }
}
