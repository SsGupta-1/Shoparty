<?php
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['role'=>'Admin'],
            ['role'=>'Customer']
        ];
  
        foreach ($user as $key => $value) {
            $Role_added = Role::where(['role' => $value['role']])->first();
            if(empty($Role_added)){
                Role::create($value);
            }
        }
    }
}
