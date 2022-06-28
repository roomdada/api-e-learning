<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return ModuleResource::collection(Module::with('lessons')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        $validated  = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
        ]);
        $module = Module::create($validated);

        return response()->json([
            'message' => 'Le module a été ajouté avec succes !',
            'data' => new ModuleResource($module->load('course', 'lessons')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module) : ModuleResource
    {
        return new ModuleResource($module->load('course', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module) : JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
        ]);
        $module->update($validated);

        return response()->json([
            'message' => 'Le module a été modifié avec succes !',
            'data' => new ModuleResource($module->load('course', 'lessons')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module) : JsonResponse
    {
        $module->delete();
        return response()->json(['message' => 'Le module a été supprimé avec succes !']);
    }
}
