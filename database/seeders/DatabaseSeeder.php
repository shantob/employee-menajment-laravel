<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            JobLevelSeeder::class,
            JobTitleSeeder::class,
            UserSeeder::class,
            DocumentTypeSeeder::class,
            Projectseeder::class,
        ]);

        if(env('APP_ENV') == 'local'){
            
            $this->call([
                Projectseeder::class,
            ]);
        }

        // \App\Models\User::factory(10)->create();
    }
}
