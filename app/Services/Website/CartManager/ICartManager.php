<?php

namespace App\Services\Website\CartManager;

interface ICartManager
{
    public function addCourse(int $courseId): void;

    public function removeCourse(int $courseId): void;

    public function getCart(): array;

    public function getCount(): int;

}
