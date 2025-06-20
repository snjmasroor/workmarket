<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            'Information Technology', 'Healthcare', 'Finance', 'Education',
            'Manufacturing', 'Construction', 'Retail', 'Real Estate',
            'Transportation', 'Telecommunications', 'Energy', 'Media',
            'Hospitality', 'Automotive', 'Food & Beverage', 'Entertainment',
            'Legal', 'Aerospace', 'Agriculture', 'Biotechnology',
            'Chemical', 'Consulting', 'Consumer Goods', 'Defense',
            'E-commerce', 'Electronics', 'Environmental', 'Fashion',
            'Government', 'Insurance', 'Logistics', 'Marine',
            'Marketing', 'Mining', 'Non-Profit', 'Pharmaceuticals',
            'Public Relations', 'Publishing', 'Security', 'Sports'
        ];
        foreach ($industries as $industry) {
            DB::table('industries')->insert([
                'name' => $industry,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
