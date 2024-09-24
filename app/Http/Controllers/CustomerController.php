<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all()->map(function ($customer) {

        return [
                "customer_id" => $customer->customer_id,
                "first_name" => $customer->first_name,
                "last_name" => $customer->last_name,
                "address" => $customer->address,
                "city" => $customer->city,
                "state" => $customer->state,
                "points" => $customer->points,
                "goldMember" => $customer->goldMember()
            ];
        });


        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:100'],
        'state' => ['required', 'string', 'max:100'],
        'points' => ['required', 'integer', 'min:0'],
        ]);

        $customer = Customer::create($request->all());
        return $customer;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
