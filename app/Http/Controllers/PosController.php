<?php

namespace App\Http\Controllers;

use App\Http\Requests\PosStoreRequest;
use App\Models\Pos;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poses = Pos::all();
        return view('pos.index',compact('poses'));

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
    public function store(PosStoreRequest $request)
    {
        Pos::create([
            'input' => $request->input,
        ]);

        return redirect()->route('dashboard.index');
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
    public function edit(Pos $po)
    {
//        dd($po);
        return view('pos.edit',compact('po'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosStoreRequest  $request, Pos $po)
    {
        $po->update([
            'id' => $request->id,
            'input' => $request->input,

        ]);

        return redirect()->route('dashboard.index')->with('message','Produkti u azhornua me sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $po)
    {
        $po->delete();
        return redirect()->route('dashboard.index')->with('message','Produkti u azhornua me sukses');

    }
}
