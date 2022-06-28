<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CourseResource::collection(Course::with('category')->latest()->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CourseRequest $request): JsonResponse
  {

    $course = Course::create(array_merge($request->validated(), [
      'slug' => Str::slug($request->title),
    ]));


    return response()->json([
      'message' => 'Le cours a été créé avec succès!',
      'course' => new CourseResource($course->load('category')),
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Course  $course
   * @return \Illuminate\Http\Response
   */
  public function show(Course $course)
  {
    return new CourseResource($course->load('category', 'quizzes', 'modules'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Course  $course
   * @return \Illuminate\Http\Response
   */
  public function update(CourseRequest $request, Course $course): JsonResponse
  {
    $course->update($request->validated());

    return response()->json([
      'message' => 'Le cours a été modifié avec succès!',
      'course' => new CourseResource($course->load('category')),
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Course  $course
   * @return \Illuminate\Http\Response
   */
  public function destroy(Course $course)
  {
    $course->delete();

    return response()->json([
      'message' => 'Le cours a été supprimé avec succès!',
    ], 200);
  }
}
