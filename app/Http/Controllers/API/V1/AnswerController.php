<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Answer;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnswerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return AnswerResource::collection(Answer::latest()->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'question_id' => 'required|exists:questions,id',
      'answer' => 'required|string',
    ]);

    $answer = Answer::create($validated);
    return response()->json([
      'message' => 'La reponse a été envoyée avec succes !',
      'answer' => new AnswerResource($answer->load('question')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function show(Answer $answer)
  {
    return new AnswerResource($answer->load('question'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Answer $answer): JsonResponse
  {
    $validated = $request->validate([
      'question_id' => 'required|exists:questions,id',
      'answer' => 'required|string',
      'is_correct' => 'required|boolean',
    ]);

    $answer->update($validated);
    return response()->json([
      'message' => 'La reponse a été mise à jour avec succes !',
      'answer' => new AnswerResource($answer->load('question')),
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function destroy(Answer $answer): JsonResponse
  {
    $answer->delete();
    return response()->json(['message' => 'La reponse a été supprimé'], 200);
  }
}
