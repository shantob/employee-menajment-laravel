<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\ProjectFeatures;

class Projectseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = ['Ecommerce', 'Hotel Management', 'Grocery', 'Ride Sharing', 'Courier'];
        $features = ['Authentication', 'Payment Gateway', 'Admin Dashboard', 'User Dashboard'];
        
        foreach($projects as $project){
            
            $new_project = Project::create([
                'name' => $project,
                'description' => $project.' description...',
                'start_date' => date('Y-m-d'),
                'deadline' => '2024-12-12',
            ]);

            foreach($features as $feature){
                
                ProjectFeatures::create([
                    'project_id' => $new_project->id,
                    'name' => $feature,
                    'description' => $feature.' description...',
                    'status' => 1,
                ]);
            }
        }
    }
}
