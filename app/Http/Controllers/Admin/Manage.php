<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Admin\AuthResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Manage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(AdminResource::collection(Admin::get()));
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

        $user = Admin::create($validated);
        
        $user = Admin::where(["uuid" => $user->uuid])->first();

        $user->assignRole("admin");

        $user->brand()->attach($validated["brands"]);
        $user->store()->attach($validated["stores"]);

        return response(new AdminResource($user), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$admin = Admin::where(["uuid" => $id])->first()) {
            return response('', 410);
        }

        return response(new AdminResource($admin));
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

        $password = $validated["password"] ?? null;

        if ($password) {
            $validated["password"] = Hash::make($validated["password"]);
        } else {
            unset($validated["password"]);
        }

        $user = $request->user_object();
        $stores = $validated["stores"] ?? null;
        $brands = $validated["brands"] ?? null;

        $user->update($validated);

        if ($brands) {
            $user->brand()->detach();

            $user->brand()->attach($brands);
        }

        if ($stores) {
            $user->store()->detach();

            $user->store()->attach($validated["stores"]);
        }

        return response(new AdminResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::where(["uuid" => $id])->first();

        if (!$admin) {
            return response('', 410);
        }

        $admin->delete();

        return response('', 204);
    }

    public function current_user(Request $request)
    {
        return response(new AuthResource($request->user));
    }
}
