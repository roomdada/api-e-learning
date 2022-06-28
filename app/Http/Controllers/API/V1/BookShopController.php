<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookShopResource;
use App\Models\BookShop;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookShop  $bookShop
     * @return \Illuminate\Http\Response
     */
    public function show(BookShop $bookShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookShop  $bookShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookShop $bookShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookShop  $bookShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookShop $bookShop)
    {
        //
    }
}
