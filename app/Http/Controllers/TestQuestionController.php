<?php

namespace App\Http\Controllers;

use App\Events\TestQuestionEvent;
use App\Http\Requests\TestQuestion\CreateRequest;
use App\Http\Requests\TestQuestion\UpdateRequest;
use App\Http\Resources\TestQuestionResource;
use App\Models\TestQuestion;
use App\Models\TestQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TestQuestionResource::collection(TestQuestion::get());
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

        $test_question = TestQuestion::create($validated);

        $option_create = [];

        foreach ($validated["test_question_option"] as $test_question_option) {
            $option_create[] = [
                "uuid" => Str::uuid(),
                "test_question_uuid" => $test_question->uuid,
                "option" => $test_question_option["option"],
                "correct" => $test_question_option["correct"],
            ];
        }

        TestQuestionOption::insert($option_create);

        event(new TestQuestionEvent($validated));

        return response(new TestQuestionResource($test_question), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test_question = TestQuestion::where(["uuid" => $id])->first();

        if (!$test_question) {
            return response("Record not found", $test_question);
        }

        return response(new TestQuestionResource($test_question));
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

        $request->test_question_object()->update($validated);

        return response(new TestQuestionResource(TestQuestion::find($request->test_question_object()->id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test_question = TestQuestion::where(["uuid" => $id])->first();

        if (!$test_question) {
            return response("Record not found", 410);
        }

        $test_question->delete();

        return response("", 204);
    }
}
