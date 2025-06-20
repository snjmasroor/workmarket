<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certifications = [
            [
                'name' => 'CompTIA A+',
                'issuing_organization' => 'CompTIA',
                'certification_level' => 'Entry',
                'validity_period' => '3 years',
                'verification_method' => 'https://www.certmetrics.com/comptia',
            ],
            [
                'name' => 'Certified Ethical Hacker (CEH)',
                'issuing_organization' => 'EC-Council',
                'certification_level' => 'Intermediate',
                'validity_period' => '3 years',
                'verification_method' => 'https://aspen.eccouncil.org',
            ],
            [
                'name' => 'AWS Certified Solutions Architect',
                'issuing_organization' => 'Amazon Web Services',
                'certification_level' => 'Associate',
                'validity_period' => '3 years',
                'verification_method' => 'https://aws.amazon.com/certification/verification/',
            ],
            [
                'name' => 'Certified Nursing Assistant (CNA)',
                'issuing_organization' => 'State Boards',
                'certification_level' => 'Basic',
                'validity_period' => '2 years',
                'verification_method' => 'Varies by state',
            ],
            [
                'name' => 'Project Management Professional (PMP)',
                'issuing_organization' => 'PMI',
                'certification_level' => 'Professional',
                'validity_period' => '3 years',
                'verification_method' => 'https://certification.pmi.org/',
            ],
        ];

        foreach ($certifications as $cert) {
            DB::table('certifications')->insert([
                'name' => $cert['name'],
                'description' => Str::limit("Certification for {$cert['name']}", 150),
                'issuing_organization' => $cert['issuing_organization'],
                'certification_level' => $cert['certification_level'],
                'validity_period' => $cert['validity_period'],
                'expiration_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'verification_method' => $cert['verification_method'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
