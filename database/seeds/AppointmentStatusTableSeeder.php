<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AppointmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments_status')->delete();

        DB::table('appointments_status')->insert([
            ['id' => 1, 'status' => 'accepted'],
            ['id' => 2, 'status' => 'pending'],
            ['id' => 3, 'status' => 'rejected']
        ]);

    }
}
