<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $role_foodmentor = Role::where('name', 'Foodmentor')->first();
        $role_user = Role::where('name', 'User')->first();

        $admin = new User();
        $admin->name = 'Arno';
        $admin->email = 'arnovandoesburg@gmail.com';
        $admin->password = bcrypt('arno');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $foodmentor = new User();
        $foodmentor->name = 'Arjan';
        $foodmentor->email = 'arjanvandoesburg@gmail.com';
        $foodmentor->password = bcrypt('arjan');
        $foodmentor->save();
        $foodmentor->roles()->attach($role_foodmentor);


        $user = new User();
        $user->name = 'Sandra';
        $user->email = 'sandravandoesburg@gmail.com';
        $user->password = bcrypt('sandra');
        $user->save();
        $user->roles()->attach($role_user);

    }
}
