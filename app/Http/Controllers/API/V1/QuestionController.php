<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'wording' => 'required|text',
            'quiz_id' => 'required|integer|exists:quizzes,id',
        ]);

        $question = Question::create($validated);

        return response()->json([
            'message' => 'La question a été ajoutée avec succes !',
            'data' => new QuestionResource($question->load('quiz')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) : QuestionResource
    {
        return new QuestionResource($question->load('quiz'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question) : JsonResponse
    {
        $validated = $request->validate([
            'wording' => 'required|text',
            'quiz_id' => 'required|integer|exists:quizzes,id',
        ]);

        $question->update($validated);

        return response()->json([
            'message' => 'La question a été modifiée avec succes !',
            'data' => new QuestionResource($question->load('quiz')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) : JsonResponse
    {
        $question->delete();

        return response()->json([
            'message' => 'La question a été supprimée avec succes !',
        ]);
    }

}
