<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroup\CreateRequest;
use App\Http\Requests\ProductGroup\UpdateRequest;
use App\Http\Resources\ProductGroup\ProductGroupResource;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class GroupManage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(ProductGroupResource::collection(ProductGroup::get()));
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

        $product_group = ProductGroup::create($validated);

        return response(new ProductGroupResource($product_group), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_group = ProductGroup::findOrFail($id);

        return response(new ProductGroupResource($product_group));
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

        $product_group = $request->getProductGroup();

        $product_group->update($validated);

        return response("", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_group = ProductGroup::findOrFail($id);

        $product_group->delete();

        return response("", 204);
    }
}
