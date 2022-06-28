<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PublicationResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class PublicationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return PublicationResource::collection(Publication::latest()->get());
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
      'publication' => 'required|string',
    ]);

    $publication = auth()->user()->publications()->create($validated);

    return response()->json([
      'message' => 'La publication a été ajoutée avec succes !',
      'publication' => new PublicationResource($publication->load('user')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Publication  $publication
   * @return \Illuminate\Http\Response
   */
  public function show(Publication $publication): PublicationResource
  {
    return new PublicationResource($publication->load('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Publication  $publication
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Publication $publication): JsonResponse
  {
    $validated = $request->validate([
      'publication' => 'required|string',
    ]);

    $publication->update($validated);

    return response()->json([
      'message' => 'La publication a été modifiée avec succes !',
      'publication' => new PublicationResource($publication->load('user')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Publication  $publication
   * @return \Illuminate\Http\Response
   */
  public function destroy(Publication $publication): JsonResponse
  {
    $publication->delete();

    return response()->json([
      'message' => 'La publication a été supprimée avec succes !',
    ]);
  }
}
