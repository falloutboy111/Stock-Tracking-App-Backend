<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestSection\CreateRequest;
use App\Http\Requests\TestSection\UpdateRequest;
use App\Http\Resources\Test\SectionResource;
use App\Models\TestSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $test_section = TestSection::where(["test_uuid" => $request->test_uuid])->get();

        if ($test_section->count() < 1) {
            return response([]);
        }
        
        return response(SectionResource::collection($test_section));
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

        $test_section = TestSection::create($validated);

        return response(new SectionResource($test_section));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $section_id)
    {
        return response(new SectionResource(TestSection::where(["test_uuid" => $id, "uuid" => $section_id])->first()), 201);
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

        $test_section = $request->test_section_object();

        $test_section->update($validated);

        return response(new SectionResource($test_section));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $section_id)
    {
        $test_section = TestSection::where(["test_uuid" => $id, "uuid" => $section_id])->first();

        if (!$test_section) {
            return response("", 410);
        }

        $test_section->delete();

        return response("", 204);
    }
}
