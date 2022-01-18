@extends('layouts.main')

@section('content')


    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

        <div class="col-md">
            <form method="POST" action="{{url('generate-invoice')}}">
                @csrf

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Arka </th>

                </tr>
                </thead>
{{--        {{$orders->first()->input}}--}}
                <tbody class="firstTable">
                @foreach($arkas as $arka)
                    <tr>
                        <td>
<!--                            --><?php
//
//                            function getArka($input,$secondInput){
//
//                                $total = $input + $secondInput;
//                                return $total;
//                            }
//
//                            ?>


{{--                            @if(!empty(count($orders)))--}}
{{--                            @if($expenses->sum('total') > $orders->first()->input)--}}

{{--                                        <input type="hidden"--}}
{{--                                               value="{{getArka($arka->input,$orders->first()->input - $expenses->sum('total'))}}"--}}
{{--                                               name="arka_input">--}}

{{--                                        {{getArka($arka->input,$orders->first()->input - $expenses->sum('total'))}}--}}
{{--                            @else --}}
                                        {{$arka->input}} Euro
{{--                            @endif--}}
{{--                                @endif--}}
                          </td>
                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>


        <div class="col-md">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>POS </th>

                </tr>
                </thead>

                <tbody class="firstTable">
                @foreach($orders as $order)

                    <tr>
                        <td> {{$order->pos}} Euro</td>
                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>
        <div class="col-md">


            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Pazari Ditor</th>

                </tr>
                </thead>

                <tbody class="firstTable">
                @foreach($orders as $order)
                    <tr>
                        <td>
{{--                            @if(!empty(count($orders)))--}}
{{--                            @if($expenses->sum('total') > $orders->first()->input)--}}
{{--                                    <input type="hidden"--}}
{{--                                           value="{{$order->input + ($arka->input - getArka($arka->input,$orders->first()->input - $expenses->sum('total')))}}"--}}
{{--                                           name="order_input">--}}

{{--                                {{$order->input + ($arka->input - getArka($arka->input,$orders->first()->input - $expenses->sum('total'))) }}--}}
{{--                            @else --}}
                                    {{$order->input}} Euro
{{--                            @endif--}}
{{--                            @endif--}}
                          </td>
                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>
        <div class="col-md">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Shpenzimet</th>
                </tr>
                </thead>

                <tbody >
                <tr>
                    <td>  {{$expenses->sum('total')}} Euro</td>
                </tr>

                </tbody>

            </table>
        </div>
        <div class="col-md">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Mbetja </th>
                </tr>
                </thead>

                <tbody class="firstTable">
                @foreach($orders as $order)
                    <tr>
                        <td>
{{--                            @if(!empty(count($orders)))--}}
{{--                            @if($expenses->sum('total') > $orders->first()->input)--}}
{{--                                    <input type="hidden"--}}
{{--                                           value="  {{($arka->input - getArka($arka->input,$orders->first()->input - $expenses->sum('total')))--}}
{{--                                + $orders->first()->input-$expenses->sum('total')}}"--}}
{{--                                           name="mbetja_input">--}}


{{--                               {{($arka->input - getArka($arka->input,$orders->first()->input - $expenses->sum('total')))--}}
{{--                                + $orders->first()->input-$expenses->sum('total')}}--}}
{{--                            @else--}}
                                {{ $order->input - $expenses->sum('total')}} Euro
{{--                            @endif--}}
{{--                            @endif--}}
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="row d-flex">

            <div class="col-md-3 d-inline-block">
                <input type="date" required class="form-control @error('raportDate') is-invalid @enderror" id="raportDate" name="raportDate">
            </div>


        <textarea class="form-control"  placeholder="Pershkrimi(opsional)" type="text" name="notes" id="notes" style="width: 40%"></textarea>


            <div class="col-md-3 d-inline-block">
                <input type="submit" class="btn btn-primary form-control"  id="confirmInvoice" value="Gjenero Raportin">
            </div>

    </div>

    </form>

    </div>




@endsection
