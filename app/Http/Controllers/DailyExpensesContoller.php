<?php

namespace App\Http\Controllers;

use App\Http\Requests\TotalDailyStoreRequest;
use App\Models\Pazari;
use App\Models\TotalDaily;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyExpensesContoller extends Controller
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
    public function store()
    {
        $paidTotal = DB::table('pazaris')->where("created_at",'>=', Carbon::today())->sum('pazaris.price');
        $products = DB::table('pazaris')->where("created_at",'>=', Carbon::today())->get('pazaris.product');

        foreach ($products as $product){
            $ret[]= $product->product;
        }

        TotalDaily::create([
             'products'=> implode("," , $ret),
             'total' => $paidTotal
        ]);
//        return redirect()->route('orders.index');

        return redirect()->route('dashboard.index')->with('message','Gjenerimi fatures u kirjua me sukses');
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
    public function destroy($id)
    {
        //
    }
}
