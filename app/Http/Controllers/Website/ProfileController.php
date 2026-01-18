<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookRating;
use App\Models\Course;
use App\Models\CourseRating;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = auth('customer')->id();

        $itemsQuery = OrderItem::query()
            ->whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });

        $bookIds = (clone $itemsQuery)
            ->where('item_type', Book::class)
            ->pluck('item_id')
            ->unique()
            ->values();

        $books = Book::query()
            ->whereIn('id', $bookIds)
            ->get();

        $courseIds = (clone $itemsQuery)
            ->where('item_type', Course::class)
            ->pluck('item_id')
            ->unique()
            ->values();

        $courses = Course::query()
            ->whereIn('id', $courseIds)
            ->get();

        $bookRating = null;

        if ($books->count() > 0) {
            $bookId = $books->first()->id;

            $bookRating = BookRating::query()
                ->where('book_id', $bookId)
                ->where('customer_id', $userId)
                ->value('rating');
        }

        $courseRatings = CourseRating::query()
            ->where('customer_id', $userId)
            ->whereIn('course_id', $courseIds)
            ->get()
            ->keyBy('course_id');

        $courses = $courses->map(function ($course) use ($courseRatings) {
            $row = $courseRatings->get($course->id);

            $course->user_rating  = $row?->rating ?? 0;
            $course->user_comment = $row?->comment ?? null;

            return $course;
        });

        return view('website.profile.index', compact('books', 'courses', 'bookRating'));
    }

    public function rateBook(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $customerId = auth('customer')->id();
        $newRating  = (int) $request->rating;

        $ratingRow = BookRating::where('book_id', $book->id)
            ->where('customer_id', $customerId)
            ->first();

        $oldAvg   = (float) ($book->rating_avg ?? 0);
        $oldCount = (int) ($book->rating_count ?? 0);

        if (!$ratingRow) {
            BookRating::create([
                'book_id'     => $book->id,
                'customer_id' => $customerId,
                'rating'      => $newRating,
            ]);

            $newCount = $oldCount + 1;
            $newAvg   = (($oldAvg * $oldCount) + $newRating) / $newCount;

            $book->update([
                'rating_count' => $newCount,
                'rating_avg'   => round($newAvg, 2),
            ]);

            cache()->forget('book');

            return redirect()->back()->with('success', 'تم تقييم الكتاب بنجاح ✅');
        }

        $oldUserRating = (int) $ratingRow->rating;

        $ratingRow->update([
            'rating' => $newRating,
        ]);

        $newAvg = $oldCount > 0
            ? (($oldAvg * $oldCount) - $oldUserRating + $newRating) / $oldCount
            : $newRating;

        $book->update([
            'rating_avg' => round($newAvg, 2),
        ]);

        cache()->forget('book');

        return redirect()->back()->with('success', 'تم تحديث تقييمك بنجاح ✅');
    }

    public function rateCourse(Request $request, Course $course)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $customerId = auth('customer')->id();
        $newRating  = (int) $request->rating;
        $comment    = $request->comment;

        $ratingRow = CourseRating::query()
            ->where('course_id', $course->id)
            ->where('customer_id', $customerId)
            ->first();

        $oldAvg   = (float) ($course->rating_avg ?? 0);
        $oldCount = (int) ($course->rating_count ?? 0);

        if (!$ratingRow) {
            CourseRating::create([
                'course_id'   => $course->id,
                'customer_id' => $customerId,
                'rating'      => $newRating,
                'comment'     => $comment,
            ]);

            $newCount = $oldCount + 1;
            $newAvg   = (($oldAvg * $oldCount) + $newRating) / $newCount;

            $course->update([
                'rating_count' => $newCount,
                'rating_avg'   => round($newAvg, 2),
            ]);

            return redirect()->back()->with('success', 'تم تقييم الدورة بنجاح ✅');
        }

        $oldUserRating = (int) $ratingRow->rating;

        $ratingRow->update([
            'rating'  => $newRating,
            'comment' => $comment,
        ]);

        $newAvg = $oldCount > 0
            ? (($oldAvg * $oldCount) - $oldUserRating + $newRating) / $oldCount
            : $newRating;

        $course->update([
            'rating_avg' => round($newAvg, 2),
        ]);

        return redirect()->back()->with('success', 'تم تحديث تقييمك للدورة بنجاح ✅');
    }
}
