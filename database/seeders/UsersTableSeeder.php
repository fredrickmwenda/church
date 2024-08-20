<?php
namespace Database\Seeders;
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
        $credentials = array(
            "email" => 'mwendafredrick31@gmail.com',
            "password" => '123456',
            "first_name" => 'Admin',
            "last_name" => 'Admin',
        );
        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::registerAndActivate($credentials);
        $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);
    }
}
