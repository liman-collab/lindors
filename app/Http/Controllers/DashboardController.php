<?php

namespace App\Http\Controllers;

use App\Models\Arka;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Pos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->hasRole('admin')) {

            $currentTime2 = Carbon::now()->format('Y-m-d');
            $order = Order::select('input')->where('created_at','>=',$currentTime2)->first();
            $expense = DB::table('expenses')->where('expenses.created_at','>=', $currentTime2)->sum('expenses.total');


            $arkas = Arka::where('created_at','>=',$currentTime2)->get();
            $pos = Pos::where('created_at','>=',$currentTime2)->get();

            $orders = Order::where('created_at','>=',$currentTime2)->get();
            $expenses = Expense::where('created_at','>=',$currentTime2)->get();



            $mbetja = 0;
            if (!empty($order->input) && !empty($expense)){
                $mbetja = $order->input - $expense;
            }elseif(empty($order->input)){
                $mbetja -= $expense;
            }elseif(!empty($order->input)){
                $mbetja = $order->input - $expense;
            }else{
                $mbetja = $order->input - $expense;
            }


            return view('dashboard.index',compact('mbetja','currentTime2','arkas','pos','orders','expenses'));
        }else{
            return 'Nuk jeni admin';
        }


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
    public function edit(Arka $arka,Pos $pos,Order $order,Expense $expense)
    {

        return view('dashboard.edit',compact('arka','pos','order','expense'));

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


//    public function secondEdit(){
//
//    }
//
//
//    public function secondUpdate(){
//
//    }

}
