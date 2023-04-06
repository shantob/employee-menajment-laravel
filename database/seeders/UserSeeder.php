<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'phone' => '01010101010',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ADMIN,
        ]);

        if(env('APP_ENV') == 'local'){
            $this->employees();
        }
    }

    private function employees(){
        
        for($i=1; $i<50; $i++){

            $user = User::create([
                'name' => 'Employee '.$i,
                'phone' => '0'.$i.'0110101'.$i,
                'email' => 'emp'.$i.'@gmail.com',
                'password' => Hash::make('password'),
                'role' => User::EMPLOYEE,
            ]);

            Employee::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'job_title_id' => 1,
                'job_level_id' => 1,
                'father_name' => 'Father Name',
                'mother_name' => 'Mother Name',
                'gender' => 'Male',
                'religion' => 'Islam',
                'join_date' => date('Y-m-d'),
                'salary' => 20000
            ]);
        }
    }
}
