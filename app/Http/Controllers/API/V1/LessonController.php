<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LessonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return LessonResource::collection(Lesson::latest()->get());
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
      'content' => 'required|string',
      'module_id' => 'required|integer|exists:modules,id',
      'video_url' => 'nullable|string',
    ]);

    $lesson = Lesson::create($validated);

    return response()->json([
      'message' => 'La leçon a été ajoutée avec succes !',
      'lesson' => new LessonResource($lesson->load('module')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Lesson  $lesson
   * @return \Illuminate\Http\Response
   */
  public function show(Lesson $lesson)
  {
    return new LessonResource($lesson->load('module'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Lesson  $lesson
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Lesson $lesson): JsonResponse
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'content' => 'required|string',
      'module_id' => 'required|integer|exists:modules,id',
      'video_url' => 'nullable|string',
    ]);

    $lesson->update($validated);

    return response()->json([
      'message' => 'La leçon a été modifiée avec succes !',
      'lesson' => new LessonResource($lesson->load('module')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Lesson  $lesson
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lesson $lesson): JsonResponse
  {
    $lesson->delete();
    return response()->json([
      'message' => 'La leçon a été supprimée avec succes !',
    ]);
  }
}
