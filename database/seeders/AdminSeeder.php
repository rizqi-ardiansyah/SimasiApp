<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        // DB::table('users')->delete();

        $pusdalop1 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'Pusdalop 1',
            'email' => 'pusdalop1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $pusdalop2 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'Pusdalop 2',
            'email' => 'pusdalop2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $pusdalop1->assignRole('pusdalop');
        $pusdalop2->assignRole('pusdalop');

        $trc1 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'TRC 1',
            'email' => 'trc1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $trc2 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'TRC 2',
            'email' => 'trc2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $trc3 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'TRC 3',
            'email' => 'trc3@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $trc4 = User::create([
            'firstname' => 'Tim',
            'lastname' => 'TRC 4',
            'email' => 'trc4@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $trc1->assignRole('trc');
        $trc2->assignRole('trc');
        $trc3->assignRole('trc');
        $trc4->assignRole('trc');
    }
}
