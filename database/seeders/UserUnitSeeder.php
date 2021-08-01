<?php

namespace Database\Seeders;

use App\Models\UserUnit;
use Illuminate\Database\Seeder;

class UserUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserUnit::create(['unit' => 'Pendidikan']);
        UserUnit::create(['unit' => 'Keuangan']);
        UserUnit::create(['unit' => 'Kesehatan']);
    }
}
