<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CodeSnippet;
use App\Services\Dashboard\CodeSnippet\ICodeSnippetService;
use Illuminate\Http\Request;

class CodeSnippetController extends Controller
{
    protected $codeSnippetService;

    public function __construct(ICodeSnippetService $codeSnippetService)
    {
        $this->codeSnippetService = $codeSnippetService;
    }

    public function index()
    {
        $snippet = CodeSnippet::first();

    if (!$snippet) {
        $snippet = CodeSnippet::create([
            'header_code' => null,
            'footer_code' => null,
            'body_code'   => null,
        ]);
    }
        return view('dashboard.codesnippet.update');
    }

    public function update(Request $request)
{
    $request->validate([
        'header_code' => ['nullable', 'string'],
        'body_code'   => ['nullable', 'string'],
        'footer_code' => ['nullable', 'string'],
    ]);

    $updated = $this->codeSnippetService->updateCodeSnippet($request->all());

    if (!$updated) {
        return back()->with('error', __('dashboard.error_msg'));
    }

    return redirect()
        ->route('dashboard.welcome')
        ->with('success', __('dashboard.success_msg'));
}

}
