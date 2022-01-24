<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('Seeding users...');
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'dev@lukaszryczko.pl',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $this->command->info('Created test account: dev@lukaszryczko.pl : password');
        $this->command->comment('Seeding voivodeships...');

        $voivodeshipJson = File::get('database/data/voivodeships.json');
        $voivodeships = json_decode($voivodeshipJson, true);

        foreach($voivodeships as $voivodeship){
            \App\Models\Voivodeship::create([
                'name' => $voivodeship['name'],
                'symbol' => $voivodeship['symbol']
            ]);
        }

        $this->command->info('Voivodeships created successfully');
        $this->command->comment('Seeding regions...');

        $regionsJson = File::get('database/data/regions.json');
        $regions = json_decode($regionsJson, true);

        foreach($regions as $region){
            \App\Models\Region::create([
               'unique_name' => $region['unique_slug'],
                'administrative_area_name' => $region['region'],
            ]);
            $this->command->info('Creating: ' . $region['unique_slug']);
        }

        $this->command->info('Regions created successfully');



    }
}
