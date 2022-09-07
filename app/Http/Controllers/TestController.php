<?php

namespace App\Http\Controllers;

use App\Events\TestQuestionEvent;
use App\Http\Requests\Test\CreateRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(TestResource::collection(Test::get()));
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
        
        $test = Test::create($validated);

        return response(new TestResource($test), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::where(["uuid" => $id])->first();

        if (!$test) {
            return response("Record not found", 410);
        }

        return response(new TestResource($test));
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

        $request->test_object()->update($validated);

        return response(new TestResource(Test::find($request->test_object()->id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::where(["uuid" => $id])->first();

        if (!$test) {
            return response("Record not found", 410);
        }

        $test->delete();

        return response("", 204);
    }
}
