<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\Dashboard\Book\IBookService;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(IBookService $bookService)
    {
        $this->bookService = $bookService;
    }


    public function index()
    {
        $book = Book::first();

        if (!$book) {
            $book = Book::create([
                'title' => "إسم الكتاب",
                'subtitle' => "وصف صغير",
                'price' => null,
                'cover_image' => null,
                'back_image' => null,
                'short_description' => null,
                'details' => null,
                'about_author' => null,
                'rating_avg' => null,
                'rating_count' => 0,
            ]);
        }

        return view('dashboard.book.book', compact('book'));
    }


    public function update(BookRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $updated = $this->bookService->updateBook($data, $id);

        if (!$updated) {
            Session::flash('error', 'حدث خطأ ما برجاء المحاولة لاحقاً');
            return redirect()->back();
        }

        Session::flash('success', 'تم حفظ البيانات بنجاح');
        return redirect()->back();
    }
}
