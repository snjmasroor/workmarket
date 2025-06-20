<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            [
                'title' => 'Basic PHP Knowledge',
                'description' => 'A test covering fundamental PHP programming concepts.',
                'passing_score' => 70,
                'max_attempts' => 3,
                'duration_minutes' => 30,
                'test_type' => 'Multiple Choice',
                
            ],
            [
                'title' => 'Laravel Proficiency',
                'description' => 'Covers Laravel framework, routing, middleware, and Eloquent.',
                'passing_score' => 75,
                'max_attempts' => 2,
                'duration_minutes' => 40,
                'test_type' => 'Timed Assessment',
               
            ],
            [
                'title' => 'Healthcare Safety Compliance',
                'description' => 'Tests basic healthcare compliance and safety protocols.',
                'passing_score' => 80,
                'max_attempts' => 5,
                'duration_minutes' => 25,
                'test_type' => 'Quiz',
                
            ],
            [
                'title' => 'Financial Risk Assessment',
                'description' => 'A finance test focusing on risk analysis and accounting standards.',
                'passing_score' => 85,
                'max_attempts' => null,
                'duration_minutes' => 45,
                'test_type' => 'Case Study',
                
            ],
            [
                'title' => 'JavaScript Essentials',
                'description' => 'Covers JS syntax, DOM manipulation, and event handling.',
                'passing_score' => 70,
                'max_attempts' => 4,
                'duration_minutes' => 35,
                'test_type' => 'Practical Test',
               
            ],
        ];

        foreach ($tests as $test) {
            DB::table('tests')->insert([
                'title' => $test['title'],
                'description' => $test['description'],
                'passing_score' => $test['passing_score'],
                'max_attempts' => $test['max_attempts'],
                'duration_minutes' => $test['duration_minutes'],
                'test_type' => $test['test_type'],
                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
