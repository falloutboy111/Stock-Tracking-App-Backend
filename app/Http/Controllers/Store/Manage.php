<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CreateRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\Http\Resources\Store\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class Manage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(StoreResource::collection(Store::get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $store = Store::create($validated);

        return response(new StoreResource($store), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::where(["uuid" => $id])->first();

        if (!$store) {
            return response('Record does not exist', 410);
        }

        return response(new StoreResource($store));
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

        $store = $request->store_object();

        $store->update($validated);

        if ($validated["malls"]) {
            $store->mall()->detach();

            $store->mall()->attach($validated["malls"]);
        } elseif (!filled($validated["malls"])) {
            $store->mall()->detach();
        }

        return response(new StoreResource($store));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::where(["uuid" => $id])->first();

        if (!$store) {
            return response('Record does not exist', 410);
        }

        $store->mall()->detach();

        $store->delete();

        return response('', 204);
    }
}
