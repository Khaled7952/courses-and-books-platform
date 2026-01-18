<?php

namespace App\Providers;

use App\Repositories\Dashboard\CodeSnippet\ICodeSnippetRepository;
use Illuminate\Support\ServiceProvider;

class CodeSnippetProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(ICodeSnippetRepository $codeSnippetRepository): void
    {
        $codeSnippet = $codeSnippetRepository->getCodeSnippet();

        view()->share('codeSnippet', $codeSnippet);
    }
}
