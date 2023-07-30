<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StorePriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceRequest $request)
    {
        Price::create($request->validated());
        toastr()->success('Price ajouter avec success!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        return view('price.update', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePriceRequest $request, Price $price)
    {
        $price->update($request->validated());
        toastr()->success('Prix mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $price)
    {
        $delete = Price::findOrFail($price);
        return $this->supp($delete);
    }
}
