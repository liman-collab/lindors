<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockProductStoreRequest;
use App\Http\Requests\StockStoreRequest;
use App\Models\StockProducts;
use Illuminate\Http\Request;

class StockProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('stockProducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockProductStoreRequest $request)
    {
        StockProducts::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
        ]);

        return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockStoreRequest $request, StockProducts $stockProducts)
    {
        $stockProducts->update([
            'id' => $request->id,
            'product_name' => $request->product_name,
            'description' => $request->description,

        ]);

        return redirect()->route('stocks.index')->with('message','Produkti u azhornua me sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
