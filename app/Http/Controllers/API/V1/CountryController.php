<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CountryResource::collection(Country::with('users')->latest()->get());
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
      'name' => 'required|string',
      'acronym' => 'required|string',
    ]);

    $country = Country::create($validated);

    return response()->json([
      'message' => 'Le pays a été ajouté avec succes !',
      'country' => new CountryResource($country->load('users')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function show(Country $country)
  {
    return new CountryResource($country->load('users'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Country $country) : JsonResponse
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'acronym' => 'required|string',
    ]);

    $country->update($validated);

    return response()->json([
      'message' => 'Le pays a été mis à jour avec succes !',
      'country' => new CountryResource($country->load('users')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function destroy(Country $country) : JsonResponse
  {
    $country->delete();

    return response()->json([
      'message' => 'Le pays a été supprimé avec succes !',
    ]);
  }
}
