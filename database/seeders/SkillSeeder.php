<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // IT Skills
            'PHP', 'Laravel', 'JavaScript', 'React', 'Node.js',
            'DevOps', 'Linux', 'MySQL', 'Git', 'AWS',

            // Healthcare Skills
            'Nursing', 'Patient Care', 'Medical Coding',
            'Phlebotomy', 'CPR', 'Healthcare IT', 'Radiology',
            'Clinical Documentation', 'EHR Management', 'Pharmacology',

            // Finance Skills
            'Accounting', 'Financial Analysis', 'Taxation',
            'Budgeting', 'Excel Modeling', 'Bookkeeping',
            'Investment Management', 'Auditing', 'QuickBooks', 'Payroll',
        ];
        foreach ($skills as $skill) {
            DB::table('skills')->insert([
                'name' => $skill,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
