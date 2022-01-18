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
                <h5>Gjenerimi i raporteve ditore</h5>
                <form method="GET" action="{{url('generateDailyReports')}}">
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
                                <th>Arka</th>
                                <th>Pos</th>
                                <th>Pazari Ditor</th>
                                <th>Shpenzimet</th>
                                <th>Mbetja</th>
                                <th>Numri Serik</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody id="reportTable">

                            @if(!empty($invoices))
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{$invoice->id}}</td>
                                        <td>
                                            {{$invoice->arka}}
                                        </td>
                                        <td>
                                            {{$invoice->pos}}
                                        </td>
                                        <td>
                                            {{$invoice->order}}
                                        </td>
                                        <td>
                                            {{$invoice->expense}}
                                        </td>
                                        <td>
                                            {{$invoice->mbetja}}
                                        </td>
                                        <td>
                                            {{$invoice->serialNumber}}
                                        </td>
                                        <td>
                                            {{$invoice->data}}
                                        </td>

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
