<?php

namespace App\Http\Controllers;

use App\Models\teste;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "message" => "Vou mostrar os dados"],
             200);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function show(teste $teste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function edit(teste $teste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, teste $teste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function destroy(teste $teste)
    {
        //
    }
}
