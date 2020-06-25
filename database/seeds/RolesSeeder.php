<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert(
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user',
            ]
        );
    }
}
