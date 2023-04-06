<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'NID',
            'Passport',
            'CV',
            'Certificate',
            'Image',
            'Marksheet'
        ];
        
        foreach ($types as $type) {

            DocumentType::create([
                'name'=> $type
            ]);
        }
    }
}
