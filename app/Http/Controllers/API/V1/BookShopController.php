<?php

namespace App\Http\Controllers\API\V1;

use App\Models\BookShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookShopRequest;
use App\Http\Resources\BookShopResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookShopController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return BookShopResource::collection(BookShop::latest()->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BookShopRequest $request): JsonResponse
  {
    $bookShop = BookShop::create(array_merge($request->validated(), [
      'user_id' => auth()->id(),
    ]));

    return response()->json([
      'message' => 'La librairie a été ajouté avec succes !',
      'bookShop' => new BookShopResource($bookShop->load('user')),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\BookShop  $bookShop
   * @return \Illuminate\Http\Response
   */
  public function show(BookShop $bookShop)
  {
    return new BookShopResource($bookShop->load('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\BookShop  $bookShop
   * @return \Illuminate\Http\Response
   */
  public function update(BookShopRequest $request, BookShop $bookShop): JsonResponse
  {
    $bookShop->update($request->validated());
    return response()->json([
      'message' => 'La librairie a été mis a jour avec succes !',
      'data' => new BookShopResource($bookShop->load('user')),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\BookShop  $bookShop
   * @return \Illuminate\Http\Response
   */
  public function destroy(BookShop $bookShop) : JsonResponse
  {
    $bookShop->delete();
    return response()->json([
      'message' => 'La librairie a été supprimé avec succes !',
    ]);
  }
}
