<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArkaStoreRequest;
use App\Models\Arka;
use App\Models\Input;
use App\Models\TotalDaily;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $todaysExpenses2 = Arka::select('price')->where("created_at",'>=', Carbon::today())->get();
//        $todaysExpenses = Arka::select('*')->where("created_at",'>=', Carbon::today())->get();
//
//        $paidTotal = DB::table('arkas')->where("created_at",'>=', Carbon::today())->sum('arkas.price');
//
//        $inputs = Input::select('input')->where("created_at",'>=', Carbon::today())->get();

        $arkas = Arka::all();

        return view('arkas.index',compact('arkas'));
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
    public function store(ArkaStoreRequest $request)
    {

//            foreach ($request->product as $key=>$product){
//                $data = new Arka();
//
//                $data->product =$product;
//                $data->price = $request->price[$key];
////                $data->total = $request->total;
//                $data->save();
//            }

                Arka::create([
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
    public function edit(Arka $arka)
    {

        return view('arkas.edit',compact('arka'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArkaStoreRequest $request, Arka $arka)
    {
        $arka->update([
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
    public function destroy(Arka $arka)
    {
        $arka->delete();
        return redirect()->route('dashboard.index')->with('message','Produkti u shlye me sukses');
    }
}
