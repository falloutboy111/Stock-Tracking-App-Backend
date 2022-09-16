<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\Http\Requests\LearningContent\UpdateRequest;
use App\Http\Requests\LearningModule\CreateRequest;
use App\Http\Resources\Learning\ModuleResource;
use App\Models\LearningModule;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(ModuleResource::collection(LearningModule::get()));
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

        $learning_module = LearningModule::create($validated);

        return response(new ModuleResource($learning_module), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$learning_module = LearningModule::find($id)) {
            return response("", 410);
        }

        return response(new ModuleResource($learning_module));
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

        $learning_module = $request->getLearningModule();

        if ($learning_module->update($validated)) {
            return response("", 204);
        }

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
        if (!$learning_module = LearningModule::find($id)) {
            return response("", 410);
        }

        $learning_module->delete();

        return response("", 204);
    }
}
