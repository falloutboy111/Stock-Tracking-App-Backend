<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\Http\Requests\LearningMaterial\CreateRequest;
use App\Http\Requests\LearningMaterial\UpdateRequest;
use App\Http\Resources\Learning\MaterialResource;
use App\Models\LearningMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(MaterialResource::collection(LearningMaterial::get()));
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

        $learning_material = LearningMaterial::create($validated);

        return response(new MaterialResource($learning_material), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$material = LearningMaterial::find($id)) {
            return response("", 410);
        }

        return response(new MaterialResource($material));
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

        $material = $request->getLearningMaterial();

        $material->update($validated);

        return response("");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$material = LearningMaterial::find($id)) {
            return response("", 410);
        }

        $material->delete();

        return response("", 204);
    }
}
