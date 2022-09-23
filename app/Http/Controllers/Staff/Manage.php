<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\CreateRequest;
use App\Http\Requests\Staff\UpdateRequest;
use App\Http\Resources\Staff\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Manage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(StaffResource::collection(Staff::get()));
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

        $validated["password"] = Hash::make($validated["password"]);

        $staff = Staff::create($validated);

        $staff = Staff::where(["uuid" => $staff->uuid])->first();

        $staff->assignRole("staff");

        $stores = $validated["stores"] ?? null;

        if ($stores) {
            $staff->store()->attach($validated["stores"]);
        }

        $staff->brand()->attach($validated["brands"]);

        return response(new StaffResource($staff), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::where(["uuid" => $id])->first();

        if (!$staff) {
            return response('Record does not exist', 410);
        }

        return response(new StaffResource($staff));
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

        $staff = $request->user_object();

        $password = $validated["password"] ?? null;

        if ($password) {
            $validated["password"] = Hash::make($validated["password"]);
        } else {
            unset($validated["password"]);
        }

        $staff->update($validated);

        $brands = $validated["brands"] ?? null;
        $stores = $validated["stores"] ?? null;

        if ($brands) {
            $staff->brand()->detach();

            $staff->brand()->attach($validated["brands"]);
        }

        if ($stores) {
            $staff->store()->detach();

            $staff->store()->attach($validated["stores"]);
        } elseif (!filled($stores)) {
            $staff->store()->detach();
        }

        return response(new StaffResource($staff));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::where(["uuid" => $id])->first();

        if (!$staff) {
            return response('Record does not exist', 410);
        }

        $staff->brand()->detach();

        $staff->delete();

        return response('', 204);
    }
}
