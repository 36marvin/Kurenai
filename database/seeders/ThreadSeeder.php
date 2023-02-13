<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ThreadModel;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  Make 10 threads that will be assigned to randonly-named
         *  boards that most likely don't exist ('vsddj', 'gtrvr', etc..). 
        */ 
        // ThreadModel::factory()
        //           ->count(10)
        //           ->make();

        /**
         *  Make 10 threads that will be assigned to a specific board
         *  called "kurenaitest".
         */
        ThreadModel::factory()
                  ->sendToDesignatedTestingBoard()
                  ->count(10)
                  ->create();
    }
}
