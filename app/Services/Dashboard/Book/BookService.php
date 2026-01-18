<?php

namespace App\Services\Dashboard\Book;

use App\Repositories\Dashboard\Book\IBookRepository;
use App\Utils\ImageManger;

class BookService implements IBookService
{
    protected $bookRepository, $imageManger;

    public function __construct(IBookRepository $bookRepository, ImageManger $imageManger)
    {
        $this->bookRepository = $bookRepository;
        $this->imageManger = $imageManger;
    }

    public function getBook($id)
    {
        $book = $this->bookRepository->getBook($id);

        return $book ?? abort(404);
    }

    public function updateBook($data, $id)
    {
        $book = $this->getBook($id);

        // ================= COVER IMAGE =================
        if (!empty($data['cover_image'])) {
            if (!empty($book->cover_image)) {
                $oldCover = 'uploads/general/' . $book->cover_image;
                $this->imageManger->deleteImageFromLocal($oldCover);
            }

            $data['cover_image'] = $this->imageManger->uploadSingleImage('/', $data['cover_image'], 'general');
        }

        // ================= BACK IMAGE =================
        if (!empty($data['back_image'])) {
            if (!empty($book->back_image)) {
                $oldBack = 'uploads/general/' . $book->back_image;
                $this->imageManger->deleteImageFromLocal($oldBack);
            }

            $data['back_image'] = $this->imageManger->uploadSingleImage('/', $data['back_image'], 'general');
        }

        // ================= BOOK FILE (PDF / DOC / EPUB...) =================
        if (!empty($data['file_pdf'])) {
            if (!empty($book->file_pdf)) {
                $this->imageManger->deleteImageFromLocal('uploads/pdfbooks/' . $book->file_pdf);
            }

            $data['file_pdf'] = $this->imageManger->uploadSingleImage('/', $data['file_pdf'], 'pdfbooks');
        }

        // ================= UPDATE BOOK =================
        $updated = $this->bookRepository->updateBook($data, $book);

        // ================= CLEAR CACHE =================
        cache()->forget('book');

        return $updated;
    }
}
