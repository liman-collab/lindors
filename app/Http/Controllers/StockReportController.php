<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockReportRequest;
use App\Models\StockReport;
use Illuminate\Http\Request;

class StockReportController extends Controller
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
    public function edit(StockReport $stockReport)
    {
       return view('generateRaports.edit',compact('stockReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockReportRequest $request, StockReport $stockReport)
    {

        if ( $request->end > $request->notes ) {

            $stockReport->update([
                'id' => $request->id,
                'product' => $request->product,
                'start' => $request->start,
                'end' => $request->end,
                'evidence' => $request->evidence,
                'notes' => $request->notes,
            ]);

        }else{
            return redirect()->back()->with('message2','Vlerat nuk jane korrekte');
        }

        return redirect()->back()->with('message','Stoku u azhornua me sukses');
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
