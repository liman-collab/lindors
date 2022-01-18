<?php

namespace App\Http\Controllers;

use App\Models\AllReports;
use App\Models\Arka;
use App\Models\Expense;
use App\Models\GenerateRaport;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Pos;
use App\Models\Stock;
use App\Models\StockReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerateRaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentTime = Carbon::now()->format('Y-m-d');

        $expenses = Expense::where('created_at','>=',$currentTime)->get();
        $orders = Order::where('created_at','>=',$currentTime)->get();
        $arkas = Arka::where('created_at','>=',$currentTime)->get();
        $pos = Pos::where('created_at','>=',$currentTime)->get();


        return view('generateRaports.index',compact('expenses','orders','arkas','pos'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AllReports $allReport)
    {
      dd($allReport);
    }

    public function generateAll(){
        $products = Expense::all();
        return view('generateRaports.generateAll',compact('products'));
    }

    public function search(Request $request){

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $expenses = AllReports::whereBetween('created_at', [$fromDate, $toDate])->get();
        $products = Expense::all();

        if ($expenses->isEmpty()){
            return redirect()->back()->with('message','Nuk gjendet asnje e dhenne me datat e specifikuara');
        }
        else{
            return view('generateRaports.generateAll',compact('expenses','products'));
        }

    }

    public function generateStock(){
//        $stocks = Stock::all();
        return view('generateRaports.generateStock');
    }


    public function searchStock(Request $request){

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');


        $stocks = StockReport::whereBetween('created_at', [$fromDate, $toDate])->get();
//        $sot = Stock::all();

        if ($stocks->isEmpty()){
            return redirect()->back()->with('message','Nuk gjendet asnje e dhenne me datat e specifikuara');
        }
        else{
            return view('generateRaports.generateStock',compact('stocks'));
        }

    }


    public function searchDailyReports(){
//        $invoices = Invoice::all();
        return view('generateRaports.generateDailyReports');
    }

    public function generateDailyReports(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');



        $invoices = Invoice::whereBetween('data', [$fromDate, $toDate])->get();

        if ($invoices->isEmpty()){
            return redirect()->back()->with('message','Nuk gjendet asnje e dhenne me datat e specifikuara');
        }   else{
            return view('generateRaports.generateDailyReports',compact('invoices'));
        }
    }



}
