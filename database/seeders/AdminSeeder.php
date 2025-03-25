<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::updateOrCreate([
            'id' => 1
        ], [
            'name'  => 'CRM Admin',
            'email' => 'admin@crm.com',
            'password'  => Hash::make("password"),
            'remember_token'    => null,
            'profile_pic' => null,
            'active' => 1
        ]);
    }
}
