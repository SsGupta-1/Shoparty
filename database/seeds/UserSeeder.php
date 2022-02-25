<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['role_id' => 1, 'image' => 'avatar.png', 'name' => 'Shoparty Admin', 'email' => 'vikrant.lal@quytech.com', 'password' => '12345678', 'mobile' => '9999999999', 'is_verified' => 1, 'gender' => 'Other', 'dob' => '01/01/1990', 'is_active' => 1]
        ];
  
        foreach ($user as $key => $value) {
            $User_added = User::where(['email' => $value['email']])->first();
            if(empty($User_added)){
                User::create($value);
            }
        }
    }
}
