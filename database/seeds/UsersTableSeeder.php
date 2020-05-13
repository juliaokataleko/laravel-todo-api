<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 1,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' =>  Hash::make('12345'),
        ]);

        DB::table('users')->insert([
            'name' => 'Julião Kataleko',
            'username' => 'juliao',
            'email' => 'juliao@juliao.com',
            'role' => 3,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' =>  Hash::make('12345'),
        ]);
        
    }
}
