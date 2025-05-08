<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cmsPageRecords = [
            [   'id' => 1,
                'title' => 'About Us',
                'description' => 'This is the About Us page. Here you can learn more about our company, mission, and values.',
                'url' => 'about-us',
                'meta_title' => 'About Us - Company Information',
                'meta_description' => 'Learn more about our company, mission, and values on our About Us page.',
                'meta_keyword' => 'about us, company, mission, values',
                'status' => 1, // 1 for active, 0 for inactive
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 2,
                'title' => 'Terms and Conditions',
                'description' => 'These are the Terms and Conditions. Please read them carefully before using our services.',
                'url' => 'terms-and-conditions',
                'meta_title' => 'Terms and Conditions - Legal Information',
                'meta_description' => 'Read our Terms and Conditions to understand the rules and guidelines for using our services.',
                'meta_keyword' => 'terms, conditions, legal, rules',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Privacy Policy',
                'description' => 'This is the Privacy Policy. We value your privacy and are committed to protecting your personal information.',
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy Policy - Data Protection',
                'meta_description' => 'Read our Privacy Policy to understand how we protect and use your personal information.',
                'meta_keyword' => 'privacy, policy, data protection, personal information',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        CmsPage::insert($cmsPageRecords);
    }
}
