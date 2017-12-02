<?php

use Illuminate\Database\Seeder;

use \App\User;
use \App\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User 1
        $super_user = User::create([
            'name' => 'Bjørnar Hagen',
            'email' => 'b@datahjelpen.no',
            'password' => bcrypt('123123')
        ]);
        $super_user->save();
        $super_user->assignRole('superadmin');
        $super_user->assignRole('admin');
        $super_user->save();

        $profile = new Profile;
        $profile->url = str_slug($super_user->name);
        $profile->name_display = $super_user->name;
        $profile->email_display = $super_user->email;
        $profile->user()->associate($super_user->id);
        $profile->save();

        // User 2
        $test_user = User::create([
            'name' => 'Ola nordmann',
            'email' => 'olanordmann@datahjelpen.no',
            'password' => bcrypt('123123')
        ]);
        $test_user->save();
        $test_user->assignRole('admin');
        $test_user->save();
    }
}
