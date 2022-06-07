<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePizzaSizeRequest;
use App\Http\Requests\UpdatePizzaSizeRequest;
use App\Models\PizzaSize;

class PizzaSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePizzaSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePizzaSizeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PizzaSize  $pizzaSize
     * @return \Illuminate\Http\Response
     */
    public function show(PizzaSize $pizzaSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PizzaSize  $pizzaSize
     * @return \Illuminate\Http\Response
     */
    public function edit(PizzaSize $pizzaSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePizzaSizeRequest  $request
     * @param  \App\Models\PizzaSize  $pizzaSize
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePizzaSizeRequest $request, PizzaSize $pizzaSize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PizzaSize  $pizzaSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(PizzaSize $pizzaSize)
    {
        //
    }
}
