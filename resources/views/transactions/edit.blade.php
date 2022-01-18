@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{--    <a class="btn btn-primary" href="{{route('orders.index')}}">Kthehu Mrapa</a>--}}

    <div class="container-fluid p-4">
        <form method="POST" action="{{ route('transactions.update',$transaction_id) }}">
            @csrf
            @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card-header">
                    <h4>Tavolina #{{$transaction_id}}</h4>
                </div>

                <div class='addition'>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Produkti</th>
                            <th>Sasia</th>
                            <th>Cmimi</th>
                            <th>Total</th>
                            <th>Menagjo</th>
                        </tr>
                        </thead>

                        <tbody class="firstTable">
                        @foreach($transaction->orders as $transactions)
                            <tr>
                                <td> {{$transactions->id}}</td>
                                <td> <input type="hidden" name="product[]" value="{!! $transactions->product !!}">{{$transactions->product}}</td>
                                <td><input type="hidden" name="qty[]" value="{!! $transactions->qty !!}">{{$transactions->qty}}</td>
                                <td> <input type="hidden" name="price[]" value="{!! $transactions->price !!}">{{$transactions->price}}</td>
                                <td>{{$transactions->price * $transactions->qty}}</td>
                                <td>

{{--                                    <form method="POST" action="{{ route('orders.destroy', $transactions->id) }}">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button class="btn btn-danger">Delete {{ $transactions->product }}</button>--}}
{{--                                    </form>--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="col-md-3" style="padding: 0">
                <div class="card-header">
                    <h4>Totali : {{ $transaction_orders }} Euro</h4>
                </div>
                <div class="card-body">
                    <div class="panel">
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        <label for="">Pagesa</label>

                                        <input type="text" name="given_amount" required id="given_amount" class="form-control">

                                    </td>
                                    <td>
                                        <label for="">Returning Change</label>

                                        <input readonly type="text" name="balance" required id="balance" class="form-control">

                                    </td>
                                </tr>
                            </table>

                            <td>Menyrat e Pageses</td>

                            <div class="d-flex gap-5 p-0">
                                <div class="align-items-center">
                                    <input type="radio" name="payment_method" id="payment_method" value="cash" checked>
                                    <label for="payment_method">&nbsp;Cash </label>
                                </div>

                                <div class="align-items-center">
                                    <input type="radio" name="payment_method" id="payment_method" value="pos" >
                                    <label for="payment_method">&nbsp;POS </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

            <input type="submit" class="btn btn-success" value="Ruaje">
{{--        <button type="submit" class="btn btn-success saveIt">Ruaje</button>--}}


        </form>
    </div>


{{--    Modal--}}

    <div class="row d-flex">
        <div>
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Shto Artikuj
            </a>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sheno te hyrat</h5>

                </div>
                <div class="modal-body">
                    <div class='addition'>
                        <form method="POST" action="{{url('saveMoreItems/'.$transaction->id)}}">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Produkti</th>
                                    <th>Sasia</th>
                                    <th>Cmimi</th>
                                    <th>Total</th>
                                    <th style="text-align: center"><a href="#" class="btn btn-success addRow1"><i class="fas fa-plus"></i></a></th>
                                </tr>
                                </thead>
                                <tbody class="firstTable1">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select class="form-control @error('product') is-invalid @enderror product1"  id="product" name="product[]">
                                            <option value="">Zgjedh</option>
                                            @foreach($products as $product)
                                                <option data-price="{{$product->price}}" value="{{$product->product_name}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>

                                        @error('product')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror qty1" name="qty[]" value="{{ old('qty') }}" >

                                        @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>

                                    <td>

                                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror prc1" name="price[]" value="{{ old('price') }}" >

                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input id="total" type="number" disabled class="form-control @error('total') is-invalid @enderror col-xl-6 total_amount1" name="total[]" value="{{ old('total') }}" >


                                        @error('total')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>

                                    <td style="text-align: center">
                                        <a href="#" class="btn btn-danger remove1"><i class="fas fa-minus"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success saveIt1">Ruaje</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


{{--</form>--}}
    <script type="text/javascript">

        $('.addRow1').on('click',function (){
            addRow1();
        });
        // document.addEventListener('contextmenu', function(e) {
        //     e.preventDefault();
        // }); prevent Inspect
        function addRow1(){
            var product = $('.product1').html();
            var numberOfRow = ($('.firstTable1 tr').length - 0) + 1;
            var tr = '<tr>'+
                '<td>'+ numberOfRow +'</td>'+
                '<td>'+
                '<select name="product[]" class="form-control product1">'+ product +
                '</select>'+
                '</td>'+
                '<td class="form-group">'+
                '<input type="number" name="qty[]" class="form-control qty1">'+
                '</td>'+
                '<td class="form-group">'+
                '<input type="number" name="price[]" class="form-control prc1">'+
                '</td>'+
                '<td class="form-group">'+
                '<input type="number" name="total[]" disabled class="form-control col-xl-6 total_amount1" >'+
                '</td>'+
                '<td style="text-align: center">'+
                '<a href="#" class="btn btn-danger remove1"><i class="fas fa-minus"></i></a>'+
                '</td>'+
                '</tr>';

            $('.firstTable1').append(tr);

        };

        function totalAmount1(){
            total = 0;
            $('.total_amount1').each(function (i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total)
        }


        $('tbody').on('click','.remove1',function () {

            $(this).parent().parent().remove();
            totalAmount1();
        })


        $('.firstTable1').delegate('.product1','change',function (){
            var tr = $(this).parent().parent();
            var price = tr.find('.product1 option:selected').attr('data-price');
            tr.find('.prc1').val(price);
            var qty = tr.find('.qty1').val() - 0;
            var price = tr.find('.prc1').val() - 0;
            var total_amount  = (qty * price);
            tr.find('.total_amount1').val(total_amount);
            totalAmount1();
        })

        $('.firstTable1').delegate('.qty1','keyup',function (){
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty1').val() - 0;
            var price = tr.find('.prc1').val() - 0;
            var total_amount  = (qty * price);
            tr.find('.total_amount1').val(total_amount);
            totalAmount1();
        })

        $('#given_amount').keyup(function (){
            var total = {{ $transaction_orders }};1
            var given_amount = $(this).val();
            var tot = given_amount - total;
            $('#balance').val(tot).toFixed(2);
        })



    </script>




@endsection

