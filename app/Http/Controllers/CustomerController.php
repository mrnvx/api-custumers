<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customers = Customer::all()->map(function ($customer) {

        // return [
        //         // "customer_id" => $customer->customer_id,
        //         // "first_name" => $customer->first_name,
        //         // "last_name" => $customer->last_name,
        //         // "address" => $customer->address,
        //         // "city" => $customer->city,
        //         // "state" => $customer->state,
        //         // "points" => $customer->points,
        //         // "goldMember" => $customer->goldMember()

        //     ];
        // });


        // return response()->json($customers);

        $customers = DB::select(
            'SELECT 
    c.customer_id,
    c.first_name,
    c.last_name,
    c.address,
    c.city,
    c.state,
    c.points,
    o.order_id,
    o.order_date,
    os.name
FROM 
    customers c
JOIN 
    orders o
    JOIN
    order_statuses os
ON 
    c.customer_id = o.customer_id'
        );
        $customers = array_map(function ($customer) {
            // Create an instance of the Customer model
            $customerModel = new Customer();
            $customerModel->points = $customer->points;

            // Add 'is_gold_member' based on points
            $customer->gold_member = $customerModel->goldMember();

            return $customer;
        }, $customers);
        //     ];
        // });

        return response()->json(['data' => $customers]);
    // \Log::debug($customers);
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
        $customer = Customer::find($id);

        
$customer = DB::table('customers as c')
->join('orders as o', 'c.customer_id', '=', 'o.customer_id')
->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
->where('c.customer_id', $id)
->select(
    'c.customer_id',
    'c.first_name',
    'c.last_name',
    'c.address',
    'c.city',
    'c.state',
    'c.points',
    'o.order_date',
    'os.name as order_status'
)
->first(); // Fetch a single record

// Check if customer exists
if ($customer) {
// Create an instance of the Customer model
$customerModel = new Customer();
$customerModel->points = $customer->points;

// Add 'gold_member' based on points
$customer->gold_member = $customerModel->goldMember();

// Return the customer data as a JSON response
return response()->json($customer);
} else {
return response()->json(['message' => 'Customer not found'], 404);
}
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
