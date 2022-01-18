@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-fluid px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <h1 class="mt-4">Pazari Ditor</h1>
        <div class="row">

            <div class="col-md-9">
                <div class="card-header">
                    <h4>Order Product</h4>
                </div>
                <div class='addition'>
                    <form method="POST" action="{{route('orders.store')}}">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produkti</th>
                                <th>Sasia</th>
                                <th>Cmimi</th>
                                <th>Total</th>
                                <th style="text-align: center"><a href="#" class="btn btn-success addRow"><i class="fas fa-plus"></i></a></th>
                            </tr>
                            </thead>
                            <tbody class="firstTable">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select class="form-control @error('product') is-invalid @enderror product" required  id="product" name="product[]">
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
                                    <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror qty" required name="qty[]" value="{{ old('qty') }}" >

                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                {{--                                --}}
                                <td>

                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror prc" required name="price[]" value="{{ old('price') }}" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <input id="total" type="number" disabled class="form-control @error('total') is-invalid @enderror col-xl-6 total_amount" name="total[]" value="{{ old('total') }}" >


                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                {{----}}
                                <td style="text-align: center">
                                    <a href="#" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                </div>
            </div>
            <div class="col-md-3" style="padding: 0">
                <div class="card-header">
                    <h4>Total: <b class="total"></b></h4>
                </div>
                <div class="card-body">
                    <div class="panel">
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        <label for="">Pagesa</label>

                                        <input type="text" name="given_amount" id="given_amount" class="form-control">

                                    </td>
                                    <td>
                                        <label for="">Returning Change</label>

                                        <input readonly type="text" name="balance" id="balance" class="form-control">

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
                            <br>
                            <br>
                            <button type="submit" class="btn btn-success saveIt">Ruaje</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        </form>
        <script type="text/javascript">

            $('.addRow').on('click',function (){
                addRow();
            });

            function addRow(){
                var product = $('.product').html();
                var numberOfRow = ($('.firstTable tr').length - 0) + 1;
                var tr = '<tr>'+
                    '<td>'+ numberOfRow +'</td>'+
                    '<td>'+
                    '<select name="product[]" required class="form-control product">'+ product +
                    '</select>'+
                    '</td>'+
                    '<td class="form-group">'+
                    '<input type="number" required name="qty[]" class="form-control qty">'+
                    '</td>'+
                    '<td class="form-group">'+
                    '<input type="number" required name="price[]" class="form-control prc">'+
                    '</td>'+
                    '<td class="form-group">'+
                    '<input type="number" required name="total[]" disabled class="form-control col-xl-6 total_amount" >'+
                    '</td>'+
                    '<td style="text-align: center">'+
                    '<a href="#" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>'+
                    '</td>'+
                    '</tr>';

                $('.firstTable').append(tr);

            };

            function totalAmount(){
                total = 0;
                $('.total_amount').each(function (i,e){
                    var amount = $(this).val() - 0;
                    total += amount;
                });
                $('.total').html(total)
            }


            $('tbody').on('click','.remove',function () {

                $(this).parent().parent().remove();
                totalAmount();
            })


            $('.firstTable').delegate('.product','change',function (){
                var tr = $(this).parent().parent();
                var price = tr.find('.product option:selected').attr('data-price');
                tr.find('.prc').val(price);
                var qty = tr.find('.qty').val() - 0;
                var price = tr.find('.prc').val() - 0;
                var total_amount  = (qty * price);
                tr.find('.total_amount').val(total_amount);
                totalAmount();
            })

            $('.firstTable').delegate('.qty','keyup',function (){
                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val() - 0;
                var price = tr.find('.prc').val() - 0;
                var total_amount  = (qty * price);
                tr.find('.total_amount').val(total_amount);
                totalAmount();
            })

            $('#given_amount').keyup(function (){
                var total = $('.total').html();
                var given_amount = $(this).val();
                var tot = given_amount - total;
                $('#balance').val(tot).toFixed(2);
            })


        </script>

        <span><strong>Tavolinat</strong></span>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Totali</th>
                <th scope="col">Parate e pranuar</th>
                <th scope="col">Kthimi i parave</th>
                <th scope="col">Menyra pageses</th>
                <th scope="col">Useri</th>
                <th scope="col">Data</th>
                <th scope="col">Menagjo</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($transaction as $transaction)
                <tr class="@if(!empty($transaction->given_amount))  bg-success custom-pe-none-confirm-td @else bg-danger @endif">

                    <th scope="row">  {{$transaction->id}}</th>

                    <td class="text-light">
                        {{$transaction->orders->sum('total')}} Euro
                    </td>


                    <td class="text-light">   {{$transaction->given_amount}} @if(!empty($transaction->given_amount))Euro @endif</td>
                    <td class="text-light">   {{$transaction->balance}} @if(!empty($transaction->balance))Euro @endif</td>
                    <td class="text-light">{{$transaction->payment_method}}</td>
                    <td class="text-light">{{$transaction->user_id}}</td>
                    <td class="text-light">{{$transaction->created_at}}</td>
                    <td scope="row">
                        <a class="btn text-light"href="{{route('transactions.edit',$transaction->id)}}">Shiko</a></td>
                    <td>     <form method="POST" action="{{ route('transactions.destroy', $transaction->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn text-light">Delete {{ $transaction->product }}</button>
                        </form></td>
                </tr>
            @endforeach
            </tbody>
        </table>



@endsection
