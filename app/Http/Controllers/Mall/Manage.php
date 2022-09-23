<?php

namespace App\Http\Controllers\Mall;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mall\CreateRequest;
use App\Http\Requests\Mall\UpdateRequest;
use App\Http\Resources\Mall\MallResource;
use App\Models\Mall;
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
        return response(MallResource::collection(Mall::get()));
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

        $mall = Mall::create($validated);

        return response(new MallResource($mall), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(new MallResource(Mall::where(["uuid" => $id])->first()));
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

        $mall = $request->mall_object();

        $mall->update($validated);

        return response(new MallResource($mall));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Mall::where(["uuid" => $id])->first();

        if (!$admin) {
            return response('Record does not exist', 410);
        }

        $admin->delete();

        return response('', 204);
    }
}
