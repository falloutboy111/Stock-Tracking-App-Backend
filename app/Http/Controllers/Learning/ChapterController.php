<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\Http\Requests\LearningChapter\CreateRequest;
use App\Http\Requests\LearningChapter\UpdateRequest;
use App\Http\Resources\Learning\ChapterResource;
use App\Models\LearningChapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learning_chapter = LearningChapter::get();

        return response(ChapterResource::collection($learning_chapter));
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

        $learning_chapter = LearningChapter::create($validated);

        return response(new ChapterResource($learning_chapter), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$learning_chapter = LearningChapter::find($id)) {
            return response("", 410);
        }

        return response(new ChapterResource($learning_chapter));
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

        $chapter = $request->get_chapter();

        $chapter->update($validated);

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
        if (!$learning_chapter = LearningChapter::find($id)) {
            return response("", 410);
        }

        $learning_chapter->delete();

        return response($learning_chapter, 204);
    }
}
