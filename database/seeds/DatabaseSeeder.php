<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(OrganizationsTableSeeder::class);
         $this->call(AppointmentStatusTableSeeder::class);
         $this->call(RoleTableSeeder::class);
    }
}
