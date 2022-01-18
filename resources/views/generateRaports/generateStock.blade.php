@extends('layouts.main')

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif


    <div class="container-fluid">
        <br>

        <div class="row">

            <div class="container-fluid">
                <h5>Gjenero Raportin mbi Stokun</h5>
                <form method="GET" action="{{url('searchStock')}}">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md">
                            <input type="date" required class="form-control @error('fromDate') is-invalid @enderror" id="fromDate" name="fromDate">
                            @error('fromDate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md">
                            <input type="date" required class="form-control @error('toDate') is-invalid @enderror" id="toDate" name="toDate">
                            @error('toDate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md">
                            <button type="submit" class="btn" name="search" title="Search">
                                <img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png"/>
                            </button>

                        </div>
                    </div>
                </form>
                <br>
                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produkti</th>
                                <th>Sasia ne fillim</th>
                                <th>Sasia ne fund</th>
                                <th>Evidenca</th>
                                <th>Data</th>
                                <th>Mungojne</th>
                                <th>Menagjo</th>
                            </tr>
                            </thead>
                            <tbody id="reportTable">

                            @if(!empty($stocks))
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{$stock->id}}</td>
                                        <td>{{$stock->product}}</td>
                                        <td>{{$stock->start}}</td>
                                        <td>{{$stock->end}}</td>
                                        <td>{{$stock->start - $stock->end}}</td>
                                        <td>{{$stock->created_at->format('Y-m-d')}}</td>
                                        <td>{{$stock->notes}}</td>
                                        <td><a href="{{route('stockReports.edit',$stock->id)}}" class="btn btn-warning">Update</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

        </div>




@endsection
