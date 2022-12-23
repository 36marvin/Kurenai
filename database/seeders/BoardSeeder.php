<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoardModel;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Makes 10 public and non frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->make();

        // Makes 10 public and frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->frozen()
                  ->make();

        // Makes 10 secret and non frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->secret()
                  ->make();

        // Makes 10 secret and frozen boards
        BoardModel::factory()
                  ->count(10)
                  ->secret()
                  ->frozen()
                  ->make();
    }
}
