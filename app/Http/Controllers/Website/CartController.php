<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\CartManager\ICartManager;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(ICartManager $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart = $this->cart->getCart();

        return view('website.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $this->cart->addCourse($request->course_id);

        return response()->json([
            'success' => true,
            'count' => $this->cart->getCount(),
             'message' => '✅ تمت الإضافة إلى السلة',
        ]);
    }

    public function remove($id)
    {
        $this->cart->removeCourse($id);

        return response()->json([
            'success' => true,
            'count' => $this->cart->getCount(),
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => $this->cart->getCount(),
        ]);
    }
}
