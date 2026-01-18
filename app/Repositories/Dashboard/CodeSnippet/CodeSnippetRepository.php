<?php
namespace App\Repositories\Dashboard\CodeSnippet;

use App\Models\CodeSnippet;

class CodeSnippetRepository implements ICodeSnippetRepository  {

    public function getCodeSnippet()
    {
        return CodeSnippet::first();
    }

    public function updateCodeSnippet($request)
    {
        $codeSnippet = CodeSnippet::first();
        return $codeSnippet->update($request);
    }
 }
