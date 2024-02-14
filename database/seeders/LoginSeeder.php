<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $login = [
            [
                'User' => 'John Doe',
                'Password' => Hash::make('password'),
            ],
            [
                'User' => 'Jane Doe',
                'Password' => Hash::make('password'),
            ],
            [
                'User' => 'Mike Doe',
                'Password' => Hash::make('password'),
            ],
            [
                'User' => 'Pamela Doe',
                'Password' => Hash::make('password'),
            ],
        ];

        DB::table('Login')->insert($login);
    }
}
