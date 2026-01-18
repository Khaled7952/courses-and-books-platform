<?php
namespace App\Repositories\Dashboard\Book;

use App\Models\Book;

class BookRepository implements IBookRepository{

    public function getBook($id){
        return Book::find($id);
    }

    public function updateBook($data, $book){
        return $book->update($data);
    }
}
