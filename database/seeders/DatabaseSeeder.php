<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\StaffCode;
use App\Models\UserUnit;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Balmond',
            'email' => 'balmond@gmail.com',
            'password' => Hash::make('zilonglayla515'),
            'nip' => '12345678',
            'surat' => 'keterangan.pdf',
            'jabatan' => 'Kepala Bidang',
            'unit' => 'Kesehatan'
        ]);

        StaffCode::create([
            'staff_code' => 'zilonglayla515'
        ]);

        UserUnit::create(['unit' => 'Pendidikan']);
        UserUnit::create(['unit' => 'Keuangan']);
        UserUnit::create(['unit' => 'Kesehatan']);
    }
}
