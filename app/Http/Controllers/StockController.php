<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockReportRequest;
use App\Http\Requests\StockStoreRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockProducts;
use App\Models\StockReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = StockProducts::all();
        $stocks = Stock::all();
        return view('stocks.index',compact('products','stocks'));
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
    public function store(StockStoreRequest $request)
    {

        foreach ($request->product as $key=>$product){
                $data = new Stock();

                $data->product = $product;

            $products = DB::table('stocks')->where('product','=', $data->product)->count();
            if ($products==0){

              $data->start = $request->start[$key];
                $data->end = $request->end[$key];
                $data->evidence = $request->evidence[$key];
                $data->save();

            }else{

                return redirect()->back()->with('message1','Dublifikim i produktit');

            }

        }

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
    public function edit(Stock $stock)
    {
        return view('stocks.edit',compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockStoreRequest $request, Stock $stock)
    {

        if ($request->start > $request->end){
            $stock->update([
                'id' => $request->id,
                'product' => $request->product,
                'start' => $request->start,
                'end' => $request->end,
                'evidence' => $request->evidence,

            ]);
        }else{
            return redirect()->back()->with('message2','Vlerat nuk jane korrekt');
        }



        return redirect()->route('stocks.index')->with('message','Produkti u azhornua me sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('message','Produkti u shlye me sukses');

    }

    public function generateStockReports()
    {

        $stocks = Stock::all();
        foreach ($stocks as $stock) {
            if(!empty($stock) && !empty($stock->end)) {
                StockReport::create([
                    'product' => $stock->product,
                    'start' => $stock->start,
                    'end' => $stock->end,
                    'evidence' => $stock->start - $stock->end,
                ]);

            }else{
//                dd('there are no more items in the Stock Report');
                return redirect()->back()->with('message1','Ploteso te gjitha fushat');
            }
        }
        DB::table('stocks')->truncate();

        return redirect()->route('stocks.index')->with('message', 'Stoku eshte gjeneruar');

    }

}
