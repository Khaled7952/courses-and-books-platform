<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Book::create([
            'title' => 'فن التغيير الإيجابي',
            'subtitle' => 'دليل عملي لتطوير الذات',
            'price' => 99.00,

            'cover_image' => 'book/cover.jpg',
            'back_image'  => 'book/back.jpg',

            'file_pdf' => 'books/book.pdf',

            'short_description' => 'كتاب يساعدك على تطوير نفسك وتحقيق أهدافك.',
            'details' => 'محتوى تفصيلي عن الكتاب وفصوله ومحتواه العلمي والعملي.',
            'about_author' => 'د. نورة — خبيرة تطوير ذات',

            'rating_avg' => 0,
            'rating_count' => 0,
        ]);
    }
}
