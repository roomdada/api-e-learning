<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuizController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return QuizResource::collection(Quiz::latest()->get());
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
      'title' => 'required|string',
      'description' => 'required|text',
      'course_id' => 'required|integer|exists:courses,id',
    ]);

    $quiz = Quiz::create($validated);
    return response()->json([
      'message' => 'Le quiz a été ajouté avec succes !',
      'data' => new QuizResource($quiz->load('course')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function show(Quiz $quiz) : QuizResource
  {
    return new QuizResource($quiz->load('course'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Quiz $quiz) : JsonResponse
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|text',
      'course_id' => 'required|integer|exists:courses,id',
    ]);

    $quiz->update($validated);
    return response()->json([
      'message' => 'Le quiz a été modifié avec succes !',
      'data' => new QuizResource($quiz->load('course')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function destroy(Quiz $quiz) : JsonResponse
  {
    $quiz->delete();
    return response()->json([
      'message' => 'Le quiz a été supprimé avec succes !',
    ]);
  }
}
