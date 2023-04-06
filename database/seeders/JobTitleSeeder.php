<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_titles = [
            'Backend Developer',
            'Frontend Developer',
            'Mobile App Developer',
            'DevOps',
            'Software Tester'
        ];
        
        foreach ($job_titles as $title) {

            JobTitle::create([
                'name'=> $title
            ]);
        }
    }
}
