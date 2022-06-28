<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::with('childrens')->latest()->get());
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
            'name' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'La categorie a été ajouté avec succes !',
            'data' => new CategoryResource($category->load('parent', 'childrens')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category->load('parent', 'childrens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'La categorie a été modifiée avec succes !',
            'data' => new CategoryResource($category->load('parent', 'childrens')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) : JsonResponse
    {
        $category->delete();
        return response()->json([
            'message' => 'La categorie a été supprimée avec succes !',
        ]);
    }
 
}
