<?php

use Illuminate\Database\Seeder;
use App\Farmer;
use App\Profile;
use App\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = 10;
        for($a = 0; $a < $accounts; $a++){


//            $masterFarmer = MasterFarmer::find(rand(1,20));
            $faker = Faker\Factory::create();
            $number = Farmer::count() + 1;
//            $number = str_pad(Farmer::count() + 1, 5, 0, STR_PAD_LEFT);
//            $number = $masterFarmer->account_id.'-'.$number;

            $farmer = new Farmer();
            $farmer->account_id = $number;
            if($farmer->save()){
                $farmer->url = route('farmer.show', array('farmer'=>$farmer));
                $farmer->save();
                QrCode::size(500)
                    ->format('png')
                    ->generate($farmer->url, public_path('images/farmer/'.$farmer->account_id.'.png'));
                $profile = new Profile();
                $profile->first_name = $faker->firstName;
                $profile->last_name = $faker->lastName;
                $profile->middle_name = $faker->lastName;
                $profile->mobile = $faker->phoneNumber;
                $profile->address = $faker->address;
                $profile->education = $faker->word(1);
                $profile->four_ps = rand(0,1);
                $profile->pwd = rand(0,1);
                $profile->indigenous = rand(0,1);
                $profile->livelihood = rand(0,1);
                $profile->farm_lot = rand(100,5000);
                $profile->farming_since = rand(1980,2019);
                $profile->organization = $faker->word(2);
                $profile->qr_image = $farmer->account_id.'.png';
                $profile->qr_image_path = '/images/farmer/'.$farmer->account_id.'.png';
                if($farmer->profile()->save($profile)){
                    $user = new User();
                    $user->name = ucwords($profile->first_name).' '.ucwords($profile->last_name);
                    $user->email = $faker->email;
                    $user->password = bcrypt('agrabah');
                    $user->passkey = 'agrabah';
                    $user->active = 1;
                    if($user->save()) {
                        $user->assignRole(stringSlug('Farmer'));
                        $user->markEmailAsVerified();
                        $farmer->user_id = $user->id;
                        $farmer->save();
                    }
                }

            }
        }
    }
}
