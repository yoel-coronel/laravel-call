<?php

namespace App\Http\Controllers;

use App\TiendaApi;
use Illuminate\Http\Request;

class TiendaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data'=>TiendaApi::where('estado',1)->get()],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\TiendaApi  $tiendaApi
     * @return \Illuminate\Http\Response
     */
    public function show(TiendaApi $tiendaApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TiendaApi  $tiendaApi
     * @return \Illuminate\Http\Response
     */
    public function edit(TiendaApi $tiendaApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TiendaApi  $tiendaApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiendaApi $tiendaApi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TiendaApi  $tiendaApi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiendaApi $tiendaApi)
    {
        //
    }
}
