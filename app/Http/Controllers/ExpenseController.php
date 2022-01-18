<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Models\AllReports;
use App\Models\Expense;
use App\Models\Expense2;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function Illuminate\Events\queueable;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
//        $expenses = Expense::all();
        $currentTime2 = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now();

        $currentTime2 = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now();

//        dd($currentTime2);
        $expenses = Expense::where('created_at','>=',$currentTime2)->get();


        return view('expenses.index',compact('products','expenses','currentTime2'));
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


        foreach ($request->product as $key => $product) {

            $data = new Expense();
            $data2 = new Expense2();

            $data->product = $product;


            $currentTime = Carbon::now();

            if ($currentTime) {
                $products = DB::table('expenses')->where('product', '=', $data->product)->where(
                    'created_at','=',$currentTime->format('Y-m-d'))->count();

                if ($products == 0) {
                    $data->total = $request->total[$key];
                    $data2->product = $product;
                    $data2->total = $request->total[$key];
                    $data->save();
                    $data2->save();
                } else {
                    return redirect()->back()->with('message1', 'Dublifikim i produktit');
                }
            }

        }


        $expenses = DB::table('expenses')->where
        ('expenses.created_at','like',$currentTime->format('Y-m-d 00:00:00'))->sum('expenses.total');

        $reports = DB::table('all_reports')->where
        ('all_reports.created_at','like',$currentTime->format('Y-m-d 00:00:00'))->get();

        if ($currentTime && !empty(count($reports))) {
            AllReports::where('created_at', Carbon::now()->format('Y-m-d 00:00:00'))
                ->update(['totali' => $expenses]);

            return redirect()->route('expenses.index');
        }

        AllReports::create([
            'dita' => $currentTime->format('D'),
            'data' => $currentTime->format('Y-m-d'),
            'totali' => $expenses,
        ]);


        return redirect()->route('expenses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AllReports $expense)
    {



        $allReports = DB::table('all_reports')->select('*')->where('id',$expense->id)->get();

        foreach ($allReports as $allReport){

            $expenses2 = DB::table('expenses')->select('*')->where('created_at',$allReport->created_at)->get();



            if (!empty(count($expenses2))){

                $date = DB::table('expenses')->select('created_at')->
                where('created_at',$allReport->created_at)->first();

            }else{

                $expenses2 = DB::table('expense2s')->
                select('*')->where('created_at',$allReport->created_at)->get();

                $date = DB::table('expense2s')->select('created_at')->
                where('created_at',$allReport->created_at)->first();

            }



            return view('generateRaports.show',compact('expenses2','date'));
        }

    }


//    public function showGeneratedExpense(AllReports $expense)
//    {
//
//
//        $allReports = DB::table('all_reports')->select('*')->where('id',$expense->id)->get();
//
//        foreach ($allReports as $allReport){
//
//            $expenses2 = DB::table('expense2s')->select('*')->where('created_at',$allReport->created_at)->get();
//
//            $date = DB::table('expense2s')->select('created_at')->
//            where('created_at',$allReport->created_at)->first();
//
//            return view('generateRaports.show',compact('expenses2','date'));
//        }
//
//    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseStoreRequest $request, Expense $expense)
    {


        $expense->update([
            'id' => $request->id,
            'product' =>$request->product,
            'total' => $request->total,
        ]);


        $currentTime = Carbon::now();

        $expenses = DB::table('expenses')->where
        ('expenses.created_at','like',$currentTime->format('Y-m-d 00:00:00'))->sum('expenses.total');

        DB::table('expense2s')
            ->where('created_at',$currentTime->format('Y-m-d'))
            ->where('product',$request->product)
            ->update(['id' => $request->id,'product'=> $request->product,'total'=>$request->total]);


        DB::table('all_reports')
            ->where('created_at',$currentTime->format('Y-m-d'))
            ->update(['totali' => $expenses ]);


        return redirect()->route('results.index')->with('message','Shpenizmi u shlye me suskes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {


        $currentTime = Carbon::now();
        $expenses = DB::table('expenses')->where
        ('expenses.created_at','like',$currentTime->format('Y-m-d 00:00:00'))->sum('expenses.total');

        $singleExpense = Expense::select('total')->where('id',$expense->id)->first();


        DB::table('all_reports')
            ->where('created_at',$currentTime->format('Y-m-d'))
            ->update(['totali' => $expenses - $singleExpense->total]);

        $expense->delete();


        DB::table('expense2s')
            ->where('created_at',$currentTime->format('Y-m-d'))
            ->where('product', $expense->product)
            ->delete();




        return redirect()->route('results.index')->with('message','Shpenizmi u shlye me suskes');

    }
}
