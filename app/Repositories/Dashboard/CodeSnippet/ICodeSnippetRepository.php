<?php
namespace App\Repositories\Dashboard\CodeSnippet;



interface ICodeSnippetRepository  {

    public function getCodeSnippet();
    public function updateCodeSnippet($request);
 }
