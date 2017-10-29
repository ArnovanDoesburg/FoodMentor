<?php

use App\Role;
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
        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'A admin user';
        $role_admin->save();

        $role_foodmentor = new Role();
        $role_foodmentor->name = 'Foodmentor';
        $role_foodmentor->description = 'A Foodmentor user';
        $role_foodmentor->save();

        $role_user = new Role();
        $role_user->name = 'User';
        $role_user->description = 'A normal user';
        $role_user->save();
    }
}
