<?php
namespace App\Services\Dashboard\Book;


interface IBookService  {

 public function getBook($id);
 public function updateBook($data, $id);


}
