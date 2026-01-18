<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        if (!Setting::first()) {

            Setting::create([

                'hero_title'        => 'كتاب د. نورة للاستشارات النفسية',
                'hero_description'  => 'اكتشف كيف تساعدك الاستشارات النفسية على تحقيق التوازن النفسي وتحسين جودة حياتك.',
                'hero_book_image'   => null, // لحد ما ترفع الصورة من البانل

                'banner_title'      => 'رحلة وعي.. تبدأ من هنا',
                'banner_subtitle'   => 'نقدّم لك دعماً نفسياً متخصصاً بأسلوب مهني وإنساني',

                'doctor_about'      => 'د. نورة — أخصائية واستشارية نفسية، تقدم جلسات إرشاد نفسي وعلاجي، وتنمية مهارات التكيف، مع خبرة واسعة في دعم الأفراد والأسر.',

                'email'     => 'info@drnoura.com',
                'phone'     => '966500000000+',
                'whatsapp'  => '966500000000+',
                'address'   => 'المملكة العربية السعودية',

                'logo' => null,

                'social_links' => [
                    [
                        'link' => 'https://facebook.com',
                        'icon' => 'fab fa-facebook-f'
                    ],
                    [
                        'link' => 'https://twitter.com',
                        'icon' => 'fab fa-twitter'
                    ],
                    [
                        'link' => 'https://instagram.com',
                        'icon' => 'fab fa-instagram'
                    ],
                ],

                'privacy_policy' =>
                'نلتزم في موقع د. نورة للاستشارات النفسية بالحفاظ على خصوصية جميع الزوار والعملاء، ويتم التعامل مع البيانات بسرية تامة ولا يتم مشاركتها مع أي طرف خارجي دون موافقة صريحة.',

            ]);
        }
    }
}
