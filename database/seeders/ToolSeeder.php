<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            [
                'name' => 'MacBook Pro',
                'description' => 'High-performance laptop used by developers and designers.',
                'type' => 'Laptop',
                'model' => 'M2 Pro 2023',
                'verification_method' => 'Serial number registration',
                'price' => 2499.00,
                
            ],
            [
                'name' => 'Stethoscope',
                'description' => 'Used for auscultation in medical diagnostics.',
                'type' => 'Medical',
                'model' => 'Littmann Classic III',
                'verification_method' => 'Batch and serial number',
                'price' => 149.99,
                
            ],
            [
                'name' => 'Cordless Drill',
                'description' => 'Essential tool for construction and home repairs.',
                'type' => 'Power Tool',
                'model' => 'DeWalt DCD777C2',
                'verification_method' => 'QR code scan',
                'price' => 129.95,
                
            ],
            [
                'name' => 'Financial Calculator',
                'description' => 'Used for financial analysis, budgeting, and tax calculation.',
                'type' => 'Office Equipment',
                'model' => 'HP 12C',
                'verification_method' => 'Manual registration',
                'price' => 89.50,
                
            ],
            [
                'name' => 'Digital Thermometer',
                'description' => 'Used in clinics for quick and accurate temperature readings.',
                'type' => 'Medical Device',
                'model' => 'Braun ThermoScan 7',
                'verification_method' => 'Scan verification',
                'price' => 59.99,
                
            ],
        ];

        foreach ($tools as $tool) {
            DB::table('tools')->insert([
                'name' => $tool['name'],
                'description' => $tool['description'],
                'type' => $tool['type'],
                'model' => $tool['model'],
                'verification_method' => $tool['verification_method'],
                'price' => $tool['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
