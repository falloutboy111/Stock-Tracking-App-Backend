<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
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
        return response(BrandResource::collection(Brand::get()));
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

        $user = Brand::create($validated);

        return response(new BrandResource($user), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$brand = Brand::where(["uuid" => $id])->first()) {
            return response('Record does not exist', 410);
        }

        return response(new BrandResource($brand), 201);
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

        $brand = $request->user_object();

        $brand->update($validated);

        return response(new BrandResource($brand));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Brand::where(["uuid" => $id])->first();

        if (!$admin) {
            return response('Record does not exist', 410);
        }

        $admin->delete();

        return response('Record does not exist', 204);
    }
}
