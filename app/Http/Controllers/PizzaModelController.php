<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePizzaModelRequest;
use App\Http\Requests\UpdatePizzaModelRequest;
use App\Models\PizzaModel;
use Illuminate\Http\Request;

class PizzaModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pizza-model.index', [
            'pizza_models' => PizzaModel::paginate(),
        ]);
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
     * @param  \App\Http\Requests\StorePizzaModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePizzaModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PizzaModel  $pizzaModel
     * @return \Illuminate\Http\Response
     */
    public function show(PizzaModel $pizzaModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PizzaModel  $pizzaModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PizzaModel $pizzaModel)
    {
        return view('pizza-model.edit', [
            'pizzaModel' => $pizzaModel,
            'manufacturers' => \App\Models\Manufacturer::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePizzaModelRequest  $request
     * @param  \App\Models\PizzaModel  $pizzaModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PizzaModel $pizzaModel)
    {
        $validated = $request->validate([
            "manufacturer_id" => "required",
            "name" => "required",
            "description" => "required",
        ]);

        $pizzaModel->update($validated);

        // set the success message to the session
        session()->flash('success', 'Pizza category updated successfully');

        // redirect to user page
        return redirect()->route('pizza-models.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PizzaModel  $pizzaModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PizzaModel $pizzaModel)
    {
        $pizzaModel->delete();

         // set the success message to the session
         session()->flash('success', 'Pizza category is deleted successfully');

         // redirect to user page
         return redirect()->route('pizza-models.index');
    }
}
