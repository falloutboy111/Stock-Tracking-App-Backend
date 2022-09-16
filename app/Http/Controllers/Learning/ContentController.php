<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\Http\Requests\LearningContent\CreateRequest;
use App\Http\Requests\LearningContent\UpdateRequest;
use App\Http\Resources\Learning\ContentResource;
use App\Models\LearningContent;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learning_content = LearningContent::get();

        return response(ContentResource::collection($learning_content));
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

        $learning_content = LearningContent::create($validated);

        return response(new ContentResource($learning_content), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$learning_content = LearningContent::find($id)){
            return response("", 410);
        }

        return response(new ContentResource($learning_content));
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

        $content = $request->get_learning_content();

        $content->update($validated);

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
        if (!$learning_content = LearningContent::find($id)){
            return response("", 410);
        }

        $learning_content->delete();


        return response("", 204);
    }
}
