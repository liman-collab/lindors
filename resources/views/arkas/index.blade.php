@extends('layouts.main')

@section('content')


    <div class="container p-2">
        <h4>Arka</h4>

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
        @foreach($arkas as $arka)
            <tr>
                <td> {{$arka->id}}</td>
                <td>{{$arka->input}} Euro</td>
                <td>{{$arka->created_at}}</td>
                <td><a class="btn btn-danger" href="">Delete</a> <a class="btn btn-primary" href="">Update</a></td>
            </tr>
        @endforeach
        </tbody>

    </table>

    </div>

@endsection
