<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'page_name' => 'home',
                'meta_title' => 'الصفحة الرئيسية',
                'meta_description' => 'مرحباً بك في الصفحة الرئيسية.',
                'meta_keywords' => 'الصفحة الرئيسية',
            ],
            [
                'page_name' => 'services',
                'meta_title' => 'خدماتنا',
                'meta_description' => 'تعرّف على خدماتنا.',
                'meta_keywords' => 'خدمات, حلول',
            ],
            [
                'page_name' => 'faq',
                'meta_title' => 'الأسئلة الشائعة',
                'meta_description' => 'الأسئلة الشائعة.',
                'meta_keywords' => 'أسئلة شائعة',
            ],
            [
                'page_name' => 'projects',
                'meta_title' => 'مشاريعنا',
                'meta_description' => 'استعرض مشاريعنا.',
                'meta_keywords' => 'مشاريع, بورتفوليو',
            ],
            [
                'page_name' => 'blog',
                'meta_title' => 'المدونة',
                'meta_description' => 'اقرأ مقالاتنا.',
                'meta_keywords' => 'مدونة, مقالات',
            ],
            [
                'page_name' => 'categories',
                'meta_title' => 'تصنيفات المدونة',
                'meta_description' => 'تصفح تصنيفات المدونة.',
                'meta_keywords' => 'تصنيفات, مدونة',
            ],
            [
                'page_name' => 'tags',
                'meta_title' => 'التاجز',
                'meta_description' => 'تصفح التاجز.',
                'meta_keywords' => 'تاجز, مدونة',
            ],
            [
                'page_name' => 'contactus',
                'meta_title' => 'اتصل بنا',
                'meta_description' => 'تواصل معنا.',
                'meta_keywords' => 'اتصال, دعم',
            ],
        ];

        foreach ($items as $item) {
            Seo::create($item);
        }
    }
}
