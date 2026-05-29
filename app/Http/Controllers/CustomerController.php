<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:customers,email',
            'phone'  => 'required',
            'alamat' => 'required',
        ]);

        Customer::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }
}