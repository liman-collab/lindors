@extends('layouts.main')

@section('content')


    <div class="container p-2">
        <h4>POS</h4>

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
            @foreach($poses as $pos)
                <tr>
                    <td> {{$pos->id}}</td>
                    <td>{{$pos->input}} Euro</td>
                    <td>{{$pos->created_at}}</td>
                    <td><a class="btn btn-danger" href="">Delete</a> <a class="btn btn-primary" href="">Update</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>

@endsection
