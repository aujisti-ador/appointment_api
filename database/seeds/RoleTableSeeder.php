<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            ['id' => 1, 'role' => 'super admin'],
            ['id' => 2, 'role' => 'admin'],
            ['id' => 3, 'role' => 'moderator'],
            ['id' => 4, 'role' => 'user'],
            ['id' => 5, 'role' => 'assistant'],
        ]);
    }
}
