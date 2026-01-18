<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Services\Dashboard\Faq\IFaqService;

class FaqController extends Controller
{
    protected $iFaqService;

    public function __construct(IFaqService $iFaqService)
    {
        $this->iFaqService = $iFaqService;
    }

    public function index()
    {
        $faq = $this->iFaqService->getAllFaqs();
        return view('dashboard.faq.index', compact('faq'));
    }

    public function create()
    {
        return view('dashboard.faq.create');
    }

    public function store(FaqRequest $request)
    {
        $faq = $this->iFaqService->createFaq($request->validated());

        if (!$faq) {
            return back()->withErrors('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.faq.index')
            ->with('success', __('dashboard.add_msg'));
    }

    public function edit($id)
    {
        $faq = $this->iFaqService->findFaqById($id);

        if (!$faq) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return view('dashboard.faq.edit', compact('faq'));
    }

    public function update(FaqRequest $request, $id)
    {
        $faq = $this->iFaqService->updateFaq($id, $request->validated());

        if (!$faq) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.faq.index')
            ->with('success', __('dashboard.update_msg'));
    }

    public function destroy($id)
    {
        $faq = $this->iFaqService->destroy($id);

        if (!$faq) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->back()->with('success', __('dashboard.delete_msg'));
    }
}
