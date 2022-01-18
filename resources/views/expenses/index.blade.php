@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-fluid px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
            @if(session()->has('message1'))
                <div class="alert alert-danger">
                    {{session('message1')}}
                </div>
            @endif

        <div class="row">
            <div class="col-md-12 p-4">
                <a data-bs-toggle="modal" data-bs-target="#exampleModalCreate" href="#">Shto Shpezimet</a>

                <div class='addition'>
                    <form method="POST" action="{{route('expenses.store')}}">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produkti</th>
{{--                                <th>Sasia</th>--}}
{{--                                <th>Cmimi</th>--}}
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
                                            <option value="{{$product->product_name}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>

                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>

                                <td>
                                    <input id="total" type="number" required step="any"
                                           class="form-control  @error('total') is-invalid @enderror col-xl-6 total_amount"
                                           name="total[]" value="{{ old('total') }}">

                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td style="text-align: center">
                                    <a href="#" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-success" value="Ruaje">
                    </form>
                </div>
            </div>

        </div>
            <div class="col-md-12 p-4">
                <div>
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Produkti</th>
{{--                            <th>Sasia</th>--}}
{{--                            <th>Cmimi</th>--}}
                            <th>Total</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($currentTime2)
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$expense->id}}</td>
                                <td>{{$expense->product}}</td>
{{--                                <td>{{$expense->qty}}</td>--}}
{{--                                <td>{{$expense->price}}</td>--}}
                                <td>{{$expense->total}} Euro</td>
                                <td>{{$expense->created_at}}</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="modal fade" id="exampleModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Shto Produktin</h5>

                        </div>
                        <div class="modal-body">
                            <form name="stockProductForm" class="text-md-left"  method="POST" action="{{route('products.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name" class="col-md-4 col-form-label text-md-left">{{ __('Produkti') }}</label>

                                    <div class="col-md-12">
                                        <input id="product" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-primary" value="Regjistro">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>




            <script type="text/javascript">

                $('.firstTable').find('tr:first').find('.remove').css('display','none');

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
                    '<input type="number" step="any" required name="total[]"  class="form-control col-xl-6 total_amount" >'+
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

            // $('.firstTable').delegate('.qty','keyup',function (){
            //     var tr = $(this).parent().parent();
            //     var qty = tr.find('.qty').val() - 0;
            //     var price = tr.find('.prc').val() - 0;
            //     var total_amount  = (qty * price);
            //     tr.find('.total_amount').val(total_amount);
            //     totalAmount();
            // })

            // $('#given_amount').keyup(function (){
            //     var total = $('.total').html();
            //     var given_amount = $(this).val();
            //     var tot = given_amount - total;
            //     $('#balance').val(tot).toFixed(2);
            // })


        </script>




@endsection
