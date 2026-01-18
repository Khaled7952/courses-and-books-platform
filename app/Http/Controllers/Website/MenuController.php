<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\Menu\IMenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(IMenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $categories = $this->menuService->getCategories();

        $meals = $this->menuService->getMenuItems(null, 0, 8);

        return view('website.menu', compact('categories', 'meals'));
    }


    public function load(Request $request)
    {
        $categoryId = $request->category_id ?? null;
        $offset     = $request->offset ?? 0;

        $meals = $this->menuService->getMenuItems($categoryId, $offset, 8);

        return view('website.partials.partial_menu', compact('meals'));
    }
}

