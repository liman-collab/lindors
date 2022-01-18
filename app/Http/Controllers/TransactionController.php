<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
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
    public function store(Transaction $transaction)
    {

        dd($transaction);

        //            dd($request->td(''));

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $products = Product::all();
//        return view('transactions.show',compact('products','transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $products = Product::all();

        $transaction_id = $transaction->id;



        $transaction_orders = Order::select('*')->where('transaction_id',$transaction_id)->sum('orders.total');


        return view('transactions.edit',compact('products','transaction','transaction_orders','transaction_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Transaction $transaction)
    {

//        dd($transaction->id);




        $transaction->update([
            'id' => $transaction->id,
            'paid_amount' => $request->given_amount- $request->balance,
            'given_amount' =>  $request->given_amount,
            'balance' => $request->balance,
            'payment_method' => $request->payment_method,
//            'user_id' =>  $request->user_id,
        ]);

        return redirect()->route('orders.index')->with('message','Porosia u mbyll me suskses');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
//        dd($transaction->orders->id);

        $transaction->delete();
//
        return redirect()->route('orders.index')->with('message','Transaksioni u shlye me sukses');
    }
}
