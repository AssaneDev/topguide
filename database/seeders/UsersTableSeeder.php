<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
              //admin
              [
                'name'=>'Admin',
                'email'=>'soluguide@gmail.com',
                'password'=> Hash::make('Ordinateur12'),
                'role' => 'admin',
                'status'=>'active'
              ],

              //user
              [
                'name'=>'user',
                'email'=>'soluser@gmail.com',
                'password'=> Hash::make('111'),
                'role'=>'user',
                'status'=>'active'
              ],
              //Guide
              [
                'name'=>'guide',
                'email'=>'guidesolu@gmail.com',
                'password'=> Hash::make('111'),
                'role'=>'guide',
                'status'=>'active'
              ],

        ]);
    }
}
