<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request): JsonResponse
  {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return response()->json(['message' => 'E-mail ou mot de passe incorrect !'], 400);
    }

    $token = $user->createToken('bearer-token')->plainTextToken; // Generate token for authentication

    return response()->json([
      'token' => $token,
      'data' => new UserResource($user),
      'success' => true,
    ], 201);
  }

  public function register(RegisterRequest $request): JsonResponse
  {
    $identifier = explode('@', $request->email)[0];
    $user = User::create(array_merge($request->validated(), ['identifier' => $identifier, 'password' => Hash::make($request->password)])); 
    return response()->json([
      'message' => 'Votre compte a été créé avec succès !',
      'user' => new UserResource($user),
    ], 201);
  }
}
