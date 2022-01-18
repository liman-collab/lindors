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
                <h5>Gjenero Raportin</h5>
                <form method="GET" action="{{url('search')}}">
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
                        <th>Dita</th>
                        <th>Data</th>
                        <th>Totali</th>
{{--                        <th>Menagjo</th>--}}

                    </tr>
                    </thead>
                    <tbody id="reportTable">

                        @if(!empty($expenses))
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$expense->id}}</td>
                                <td>
                                    @if($expense->created_at->format('D') == 'Mon')<span>E Hene</span>
                                    @elseif($expense->created_at->format('D') == 'Tue')<span>E Marte</span>
                                    @elseif($expense->created_at->format('D') == 'Wed')<span>E Merkure</span>
                                    @elseif($expense->created_at->format('D') == 'Thu')<span>E Enjte</span>
                                    @elseif($expense->created_at->format('D') == 'Fri')<span>E Premte</span>
                                    @elseif($expense->created_at->format('D') == 'Sat')<span>E Shtune</span>
                                    @elseif($expense->created_at->format('D') == 'Sun')<span>E Diele</span>
                                    @endif
                                </td>
                                <td>{{$expense->created_at->format('Y-m-d')}}</td>

                                <td>
                                    <a href="{{route('expenses.show',$expense->id)}}">{{$expense->totali}} Euro</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>

                    </table>
                    <strong>Shuma : @if(!empty($expenses)) {{$expenses->sum('totali')}} Euro @endif</strong>
                </div>
            </div>
        </div>

    </div>




@endsection
