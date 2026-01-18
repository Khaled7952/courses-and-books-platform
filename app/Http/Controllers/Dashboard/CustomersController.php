<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")->orWhere('mobile', 'like', "%$search%");
            });
        }

        $customers = $query->paginate(10);

        $customers->appends($request->all());

        return view('dashboard.customers.index', compact('customers'));
    }

    public function toggleStatus(Customer $customer)
    {
        $customer->update([
            'is_active' => !$customer->is_active,
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $customer->is_active,
        ]);
    }
}
