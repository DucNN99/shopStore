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
        $user           = new User();
        $user->username = 'Administrator';
        $user->email    = 'ngocduc23081999hh@gmail.com';
        $user->password = bcrypt('admin1234');
        $user->role     = 0;
        $user->save();
    }
}
