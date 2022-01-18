<?php

namespace App\Http\Controllers;


use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Arka;
use App\Models\Building;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use PDF;



class InvoiceController extends Controller
{

    public function invoice(Request $request){

        $data = $request->input('raportDate');
        $notes = $request->input('notes');


//        dd($notes);

        $currentTime = Carbon::now()->format('Y-m-d');
        $expenses = Expense::where('created_at','>=',$currentTime)->get();
        $orders = Order::where('created_at','>=',$currentTime)->first();
        $arkas = Arka::where('created_at','>=',$currentTime)->first();
        $pos = Pos::where('created_at','>=',$currentTime)->first();

//        dd($expenses->sum('total'));

        $serialNumber = rand(1,99999);

        if (!empty($expenses)) {
            Invoice::create([
                'arka' => $arkas->input ?? 0,
                'pos' => $orders->pos,
                'order' => $orders->input,
                'expense' => $expenses->sum('total'),
                'mbetja' => $orders->input - $expenses->sum('total'),
                'notes' => $notes,
                'data' => $data,
                'serialNumber' => $serialNumber,
            ]);
        }else{
            Invoice::create([
                'arka' => $arkas->input ?? 0,
                'pos' => $orders->pos,
                'order' => $orders->input,
                'expense' =>  0,
                'mbetja' => $orders->input,
                'notes' => $notes,
                'data' => $data,
                'serialNumber' => $serialNumber,
            ]);
        }
        DB::table('expenses')->truncate();
        DB::table('orders')->truncate();
        DB::table('arkas')->truncate();
        DB::table('pos')->truncate();



        return redirect()->route('dashboard.index')->with(['message','Raporti u gjenerua me sukses']);

    }


}
