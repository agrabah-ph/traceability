<?php

use Illuminate\Database\Seeder;
use App\User;
use App\MasterFarmer;
use App\Profile;

class MasterFarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = 20;
        for($a = 0; $a < $accounts; $a++){
            $faker = Faker\Factory::create();
            $number = str_pad(MasterFarmer::count() + 1, 5, 0, STR_PAD_LEFT);
            $master = new MasterFarmer();
            $master->account_id = $number;
            if($master->save()){
                $profile = new Profile();
                $profile->first_name = $faker->firstName;
                $profile->middle_name = $faker->lastName;
                $profile->last_name = $faker->lastName;
                if($master->profile()->save($profile)){
                    $user = new User();
                    $user->name = ucwords($profile->first_name).' '.ucwords($profile->last_name);
                    $user->email = $faker->email;
                    $user->password = bcrypt('agrabah');
                    $user->passkey = 'agrabah';
                    $user->active = 1;
                    if($user->save()) {
                        $user->assignRole(stringSlug('Master Farmer'));
                        $user->markEmailAsVerified();
                        $master->user_id = $user->id;
                        $master->save();
                    }
                }
            }
        }
    }
}
