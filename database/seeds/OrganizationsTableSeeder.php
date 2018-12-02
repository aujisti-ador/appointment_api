<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Organization;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->delete();

        for ($i = 1; $i <= 20; $i++) {

            $faker = Faker\Factory::create();
            $faker->addProvider(new Faker\Provider\en_US\Address($faker));

            $user = new Organization();
            $user->id = $i;
            $user->name = $faker->company;
            $user->domain_name = $faker->domainName;
            $user->address = $faker->streetAddress;
            $user->save();
        }
    }
}
