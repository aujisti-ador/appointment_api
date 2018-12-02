<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i = 1; $i <= 50; $i++) {

            $faker = Faker\Factory::create();
            $gender = $faker->randomElement(['male', 'female']);

            $user = new User();
            $user->id = $i;
            $user->name = $faker->name($gender);
            $user->email = $faker->email;
            $user->password = bcrypt(123456);
            $user->designation = $faker->jobTitle;
            $user->gender = $gender;
            $user->organizations_id = $faker->numberBetween($min = 1, $max = 20);
            $user->mobile_no = $faker->phoneNumber;
            $user->secret_question = $faker->realText($maxNbChars = 200, $indexSize = 2);
            $user->secret_answer = $faker->realText($maxNbChars = 200, $indexSize = 2);
            $user->avatar = $faker->imageUrl(200, 200, 'people');
            $user->save();
        }
    }
}
