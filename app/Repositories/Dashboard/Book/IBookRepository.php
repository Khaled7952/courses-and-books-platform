<?php
namespace App\Repositories\Dashboard\Book;

interface IBookRepository{
    public function getBook($id);
    public function updateBook($data, $book);
}
