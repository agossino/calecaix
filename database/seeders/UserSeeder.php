<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Accompagnatore',
            'email' => 'accompagnatore@example.com','role' => 'accompagnatore','is_admin'=>0,'password' => Hash::make('12345678')
        ]);
        User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@example.com','role' => 'editor','is_admin'=> 0,'password' => Hash::make('12345678')
            ]);

            User::factory()->create([
                'name' => 'Test Amministratore',
                'email' => 'amministratore@example.com','role' => 'amministratore','is_admin'=> 1,'password' => Hash::make('12345678')
                ]);

         DB::table('users')->insert(['name' => 'rino_cai','email' => 'rino.ruggeri@gmail.com','password' => Hash::make('12345678')
            ,'role' => 'amministratore','is_admin' => 1]);
    }
}


