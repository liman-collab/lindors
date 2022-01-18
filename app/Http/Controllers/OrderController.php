<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Input;
use App\Models\Order;
use App\Models\Pazari;
use App\Models\Pos;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $todaysExpenses2 = Order::select('price')->where("created_at",'>=', Carbon::today())->get();
//        $todaysExpenses = Order::select('*')->where("created_at",'>=', Carbon::today())->get();
//
//        $paidTotal = DB::table('orders')->where("created_at",'>=', Carbon::today())->sum('orders.price');
//
//        $inputs = Input::select('input')->where("created_at",'>=', Carbon::today())->get();
//        $products = Product::all();
//
////
//        $orders = Order::max('transaction_id');
////        $lastOrders = Order::select('*')->where('transaction_id',$orders)->get();
//        $lastOrders = Order::select('*')->where('transaction_id',$orders)->get();
//
//        $transaction = Transaction::all();
//
//        $sumTotal = DB::table('orders')->groupBy('transaction_id')->sum('orders.total');
//        dd($sumTotal);
        $orders = Order::all();
        return view('orders.index',compact('orders'));
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
    public function store(OrderStoreRequest $request)
    {


        Order::create([
            'input'=>$request->input,
            'pos'=>$request->pos,
           'pazari'=>$request->input + $request->pos,
        ]);

        Pos::create([
            'input'=>$request->pos,
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
    public function edit(Order $order)
    {
        return view('orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStoreRequest $request, Order $order)
    {
        $order->update([
            'id' => $request->id,
            'input' => $request->input,
            'pos' => $request->pos,
            'pazari' =>$request->input + $request->pos,
        ]);


        return redirect()->route('dashboard.index')->with('message','Produkti u azhornua me sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

        $order->delete();

//        $transactionInventory = Order::where('transaction_id',$order->transaction_id)->get();
        return redirect()->route('dashboard.index');

//        if(empty(count($transactionInventory))){
//            Transaction::where('id',$order->transaction_id)->delete();
//            return redirect()->route('orders.index');
//        }else{
//            return back();
//        }
//        dd('test');
    }

    public function saveMoreItems(Request $request){


        $transaction_id = $request->transaction_id;

//        dd($transaction_id);

        for($product = 0; $product < count($request->product); $product++){
            $orders = new Order;
            $orders->transaction_id = $transaction_id;
            $orders->product = $request->product[$product];
            $orders->qty = $request->qty[$product];
            $orders->price = $request->price[$product];
            $orders->total = $request->price[$product] *  $request->qty[$product];
            $orders->save();
        }

        return back();



    }

}
