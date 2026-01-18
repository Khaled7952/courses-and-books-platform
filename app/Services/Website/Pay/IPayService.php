<?php

namespace App\Services\Website\Pay;

use Illuminate\Http\Request;

interface IPayService
{
    public function checkoutBook(int $bookId): array;

    public function checkoutCourses(array $courseIds): array;

    public function handleSuccess(Request $request): array;

    public function handleFailed(Request $request): array;

    public function verifyPaymobHmac(array $payload): bool;
}
