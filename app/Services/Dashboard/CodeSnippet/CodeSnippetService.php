<?php
namespace App\Services\Dashboard\CodeSnippet;

use App\Repositories\Dashboard\CodeSnippet\ICodeSnippetRepository;

class CodeSnippetService implements ICodeSnippetService
{
    protected $iCodeSnippetRepository;

    public function __construct(ICodeSnippetRepository $iCodeSnippetRepository)
    {
        $this->iCodeSnippetRepository = $iCodeSnippetRepository;
    }

    public function getCodeSnippet()
    {
        return $this->iCodeSnippetRepository->getCodeSnippet();
    }
    public function updateCodeSnippet($request)
    {
        return $this->iCodeSnippetRepository->updateCodeSnippet($request);
    }
}
