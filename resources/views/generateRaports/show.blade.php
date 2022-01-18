@extends('layouts.main')

@section('content')
{{--    date('g:ia', strtotime($timestamp));--}}
    <div class="card-body card container-fluid">
        @if(!empty($date))
        <h6>Shpenzimet per daten {{date('Y-m-d', strtotime($date->created_at))}}</h6>
        @foreach($expenses2 as $expense)
            {{$expense->product}} - {{ $expense->total}} Euro <br>
        @endforeach
        @else
            <h2>Nuk ka rekord te kesaj date</h2>
        @endif
    </div>

@endsection
