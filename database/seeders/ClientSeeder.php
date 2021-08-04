<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('clients')->insert(
          [
              'name'=> 'માહરેન્દ્રસિંહ રાઠોડ', 'phone1'=> 9137634193, 'phone2'=> NULL, 'email'=> 'mahendrasinh@gmail.com', 
              'ref_name'=> 'જીતુભાઇ',  'ref_phone'=> NULL,  'ref_email'=> 'jitu2000@gmail.com',
              'address'=> 'vadodara', 'image'=> NULL, 'note'=> 'રજા ચીઠી બનાવની છે. ડોક્યુમેન્ટ રેડી કરવાના બાકી છે',
              'status'=> 1, 'admin_id'=> 1

          
          ]);
    }
}
