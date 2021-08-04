<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        DB::table('tasks')->insert(
            [
                'name'=> 'રજા ચીઠી બનાવની છે', 'category_id'=> 18, 'client_id'=> 1, 'admin_id'=> 1
            
            ]);
    }
}
