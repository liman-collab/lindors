@extends('layouts.main')

@section('content')


    <div class="container p-2">
        <h4>Pazari Ditor</h4>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Te hyrat</th>
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
                    <td><a class="btn btn-danger" href="">Delete</a> <a class="btn btn-primary" href="">Update</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>

@endsection

