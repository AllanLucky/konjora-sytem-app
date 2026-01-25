<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name'  => 'User',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),

                'photo' => null,
                'phone' => '0700000001',
                'address' => 'Admin Address',
                'city' => 'Nairobi',
                'country' => 'Kenya',
                'gender' => 'male',

                'bio' => 'System administrator responsible for managing platform operations and ensuring security.',
                'job_title' => 'System Administrator',
                'department' => 'IT Department',
                'skills' => 'Laravel, Security, User Management',
                'website' => 'https://linkedin.com/in/adminuser',

                'role' => 'admin',
                'status' => 'active',

                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Instructor',
                'last_name'  => 'User',
                'name' => 'Instructor User',
                'email' => 'instructor@example.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),

                'photo' => null,
                'phone' => '0700000002',
                'address' => 'Instructor Address',
                'city' => 'Mombasa',
                'country' => 'Kenya',
                'gender' => 'female',

                'bio' => 'Instructor focused on delivering practical technical education and mentorship.',
                'job_title' => 'Senior Instructor',
                'department' => 'Software Development',
                'experience' => '5 years, Senior Developer',
                'skills' => 'Laravel, Vue.js, Teaching',
                'website' => 'https://linkedin.com/in/instructoruser',

                'role' => 'instructor',
                'status' => 'active',

                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Normal',
                'last_name'  => 'User',
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),

                'photo' => null,
                'phone' => '0700000003',
                'address' => 'User Address',
                'city' => 'Kisumu',
                'country' => 'Kenya',
                'gender' => 'other',

                'bio' => 'Motivated learner exploring modern web technologies.',
                'job_title' => 'Student',
                'department' => 'Computer Science',
                'skills' => 'HTML, CSS, JavaScript',
                'website' => null,

                'role' => 'user',
                'status' => 'active',

                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
