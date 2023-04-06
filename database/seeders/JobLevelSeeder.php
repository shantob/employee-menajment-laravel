<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobLevel;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_levels = [
            'Intern',
            'Junior',
            'Mid Level',
            'Senior'
        ];
        
        foreach ($job_levels as $level) {

            JobLevel::create([
                'name'=> $level
            ]);
        }
    }
}
