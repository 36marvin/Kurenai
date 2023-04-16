<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoardModel;
use App\Models\ThreadModel;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Makes 110 public and non frozen boards
        BoardModel::factory()
                  ->count(110)
                  ->create();

        // Makes 10 public and frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->frozen()
                  ->create();

        // Makes 10 secret and non frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->secret()
                  ->create();

        // Makes 10 secret and frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->secret()
                  ->frozen()
                  ->create();
                  
        // make kurenaitest (board that will receive threads from the thread seeder)
        BoardModel::factory()
                  ->count(1)
                  ->kurenaitest()
                  ->create();
    }
}
