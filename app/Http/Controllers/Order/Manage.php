<?php

namespace App\Http\Controllers\Order;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class Manage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(OrderResource::collection(Order::get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = collect($request->validated());

        $order = Order::create($validated->except("order_items")->toArray());

        $order_items = collect($validated["order_items"])->transform(function ($order_item, $value) use (&$order)
        {
            return array_merge([
                "uuid" => Str::uuid(),
                "order_uuid" => $order->uuid
            ], $order_item);
        })->toArray(); 
    
        OrderItem::insert($order_items);

        return response(new OrderResource($order), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$order = Order::find($id)) {
            return response("Record not found", 410);
        }

        return response(new OrderResource($order), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $order = $request->order;

        $order->update($validated);

        return response("");
    }

    public function export($id) 
    {
        if (!$order = Order::find($id)) {
            return response("Record not found", 410);
        }

        return Excel::download(new OrderExport($order), 'order.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function email($id) 
    {
        if (!$order = Order::find($id)) {
            return response("Record not found", 410);
        }

        // $path = Excel::store(new OrderExport($order), 'order.csv');

        return response("");
    }
}
