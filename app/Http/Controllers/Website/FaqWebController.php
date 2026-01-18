<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqDetail;
use App\Models\Skill;
use Illuminate\Http\Request;

class FaqWebController extends Controller
{
     public function index()
    {
        $faqs = Faq::active()
            ->orderBy('sort_order', 'ASC')
            ->get();

            $skill = Skill::first();
           $counters = $skill?->counters ?? [];

        $faqDetail = FaqDetail::first();

        return view('website.faq.index', compact('faqs', 'faqDetail' , 'counters'));
    }
}
