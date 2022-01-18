@extends('layouts.main')

@section('content')


    <div class="container py-2">
{{--        <h4>Mbetja</h4>--}}
        <div class="row card-body">
            <div class="col-md-3 col-xl-6">
                <h4>Pazari Ditor</h4>
{{--                <div class="card-body">--}}

                    <table class="table table-bordered">
{{--                <table class="table table-bordered">--}}
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pazari Ditor</th>
                        <th>Data</th>
                        <th>Menagjo</th>
                    </tr>
                    </thead>

                    <tbody class="firstTable">
                    @foreach($orders as $order)
                        <tr>
                            <td> {{$order->id}}</td>
                            <td>{{$order->input}} Euro</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <form method="POST" action="{{route('orders.destroy',$order->id)}}}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>

{{--                                <a class="btn btn-primary" href="">Update</a></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h6>
                    Totali :  @foreach($orders as $order)  {{$order->input}} Euro   @endforeach
                </h6>

            </div>
            <div class="col-md-3 col-xl-6">
                <h4>Shpenzimet</h4>
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produkti</th>
                        <th>Totali</th>
                        <th>Data</th>
                        <th>Menagjo</th>
                    </tr>
                    </thead>

{{--                    {{$currentTime2}}--}}

                    <tbody class="firstTable">
{{--                    @if($currentTime2)--}}
                    @foreach($expenses as $expense)
                        <tr>
                            <td> {{$expense->id}}</td>
                            <td>{{$expense->product}}</td>
{{--                            <td>{{$expense->qty}}</td>--}}
{{--                            <td>{{$expense->price}}</td>--}}
                            <td>{{$expense->total}}</td>
                            <td>{{$expense->created_at->format('Y-m-d')}}</td>
                            <td>
                                <form class="d-inline-block" method="POST" action="{{route('expenses.destroy',$expense->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                                <a class="btn btn-primary" href="{{route('expenses.edit',$expense->id)}}">Update</a></td>
                        </tr>
                    @endforeach
{{--                    @endif--}}
                    </tbody>

                </table>
                <h6> Totali : {{$totalExpense}} Euro</h6>
            </div>
        </div>

        <div>
            <h4>Mbyllja :  @foreach($orders as $order) {{$order->input - $totalExpense}} Euro @endforeach</h4>
        </div>




    </div>

@endsection
