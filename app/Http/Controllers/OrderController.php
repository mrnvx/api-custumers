<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($customerId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $orders = DB::table('orders as o')
            ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
            ->where('o.customer_id', $customerId)
            ->select(
                'o.order_id',
                'o.customer_id',
                'o.order_date',
                'o.status',
                'o.comments',
                'o.shipped_date',
                'o.shipper_id',
                'os.name as order_status' // Adding the order status name
            )
            ->get();


        return response()->json($orders);
        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($customerId, $orderId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Find the order
        $order = DB::table('orders as o')
            ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
            ->where('o.customer_id', $customerId)
            ->where('o.order_id', $orderId)
            ->select(
                'o.order_id',
                'o.customer_id',
                'o.order_date',
                'o.status',
                'o.comments',
                'o.shipped_date',
                'o.shipper_id',
                'os.name as order_status', // Adding the order status name
            )
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
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
