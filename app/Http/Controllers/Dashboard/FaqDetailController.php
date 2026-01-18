<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FaqDetail;
use App\Utils\ImageManger;
use Illuminate\Http\Request;

class FaqDetailController extends Controller
{
    protected $imageManger;

    public function __construct(ImageManger $imageManger)
    {
        $this->imageManger = $imageManger;
    }
    public function index()
    {
        $faq = FaqDetail::find(1);
        return view('dashboard.faq.imagetitle', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'second_title_ar'   => 'required|string|max:255',
            'second_title_en'   => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5058',
        ]);

        $faqDetail = FaqDetail::findOrFail($id);
        $faqDetail->setTranslation('title', 'ar', $request->input('title_ar'));
        $faqDetail->setTranslation('title', 'en', $request->input('title_en'));
        $faqDetail->setTranslation('second_title', 'ar', $request->input('second_title_ar'));
        $faqDetail->setTranslation('second_title', 'en', $request->input('second_title_en'));

        if ($request->hasFile('image')) {
            $oldImageName = $faqDetail->image;
            $oldImagePath = 'uploads/general/' . $oldImageName;
            $this->imageManger->deleteImageFromLocal($oldImagePath);
            $file_name = $this->imageManger->uploadSingleImage('/', $request->file('image'), 'general');
            $faqDetail->image = $file_name;
        }

        $faqDetail->save();

        return redirect()->route('dashboard.faq.index')->with('success', __('dashboard.success_msg'));
    }
}
