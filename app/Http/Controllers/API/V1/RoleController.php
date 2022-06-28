<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return RoleResource::collection(Role::with('users')->get());
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
    ]);

    $role = Role::create($validated);

    return response()->json([
      'message' => 'Le role a été ajouté avec succes !',
      'role' => new RoleResource($role->load('users')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role): RoleResource
  {
    return new RoleResource($role->load('users'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role): JsonResponse
  {
    $validated = $request->validate([
      'name' => 'required|string',
    ]);

    $role->update($validated);

    return response()->json([
      'message' => 'Le role a été modifié avec succes !',
      'role' => new RoleResource($role->load('users')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role): JsonResponse
  {
    $role->delete();

    return response()->json([
      'message' => 'Le role a été supprimé avec succes !',
    ]);
  }
}
