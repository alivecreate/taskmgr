<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
  
class AdminSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     *
     * @return void
     */
    
     
    public function run()
    {
        DB::table('admins')->insert([
            [
            'name' => 'Admin',
            'email' => 'task@mailvadodara.com',
            'password' => Hash::make('123123'),
            ],
            [
            'name' => 'Jitu',
            'email' => 'jitu@gmail.com',
            'password' => Hash::make('123123'),
            ],
            [
            'name' => 'paresh',
            'email' => 'paresh@gmail.com',
            'password' => Hash::make('123123'),
            ]]
    );

        

    }
}
