<?php

namespace Database\Seeders;

use App\Models\StaffCode;
use Illuminate\Database\Seeder;

class StaffCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffCode::create([
            'staff_code' => 'zilonglayla515'
        ]);
    }
}
