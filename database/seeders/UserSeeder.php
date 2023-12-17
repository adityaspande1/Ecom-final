<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Ram Pande',
            'email'=>'ram@pande.com',
            // 'password'=>Hash::make('12345')
            // $hashedPassword = password_hash('12345', PASSWORD_BCRYPT);
            // 'password'=>password_hash('12345', PASSWORD_BCRYPT)
            'password'=>'12345'
        ]);
    }
}
