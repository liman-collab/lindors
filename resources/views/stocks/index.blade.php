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

            @if(session()->has('message2'))
                <div class="alert alert-danger">
                    {{session('message2')}}
                </div>
            @endif


{{--        <h2>Stoku</h2>--}}
        <div class="row">
            <div class="col-md-12 p-4">
                <div class='addition'>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModalCreate" href="#">Shto Produkte</a>
                    <form method="POST" action="{{route('stocks.store')}}">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produkti</th>
                                <th>Sasia Start</th>
                                <th>Sasia End</th>
                                <th>Evidenca</th>
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
                                            <option  value="{{$product->product_name}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>

                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <input id="start" type="number" class="form-control @error('start') is-invalid @enderror start" required name="start[]" value="{{ old('start') }}" >

                                    @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>

                                    <input id="end" type="number" disabled class="form-control @error('end') is-invalid @enderror end" required name="end[]" value="{{ old('end') }}" >

                                    @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <input id="evidence" type="number"  class="form-control @error('evidence') is-invalid @enderror col-xl-6 evidence" name="evidence[]" value="{{ old('evidence') }}" >


                                    @error('evidence')
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



            <div class="modal fade" id="exampleModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Shto Produktin</h5>

                        </div>
                        <div class="modal-body">
                            <form name="stockProductForm" class="text-md-left"  method="POST" action="{{route('stockProducts.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name" class="col-md-4 col-form-label text-md-left">{{ __('Produkti') }}</label>

                                    <div class="col-md-12">
                                        <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('Pershkrimi(opsional)') }}</label>

                                    <div class="col-md-12">
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus>
                                        @error('description')
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

                $('form').bind('submit', function () {
                    $(this).find(':input').prop('disabled', false);
                });

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
                        '<input type="number" required name="start[]" class="form-control start">'+
                        '</td>'+
                        '<td class="form-group">'+
                        '<input type="number" required name="end[]" disabled class="form-control end">'+
                        '</td>'+
                        '<td class="form-group">'+
                        '<input type="number" required name="evidence[]"  class="form-control col-xl-6 evidence" >'+
                        '</td>'+
                        '<td style="text-align: center">'+
                        '<a href="#" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>'+
                        '</td>'+
                        '</tr>';

                    $('.firstTable').append(tr);

                };


                $('.firstTable').find('tr:first').find('.remove').css('display','none');

                $('tbody').on('click','.remove',function () {

                    $(this).parent().parent().remove();


                })



                $('.firstTable').delegate('.start','keyup',function (){
                    var tr = $(this).parent().parent();
                    var start = tr.find('.start').val();
                    tr.find('.evidence').val(start);
                })



            </script>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabela e Stokut
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Produkti</th>
                            <th>Sasia ne fillim</th>
                            <th>Sasia ne fund</th>
                            <th>Evidenca</th>
                            <th>Data</th>
                            <th>Menagjo</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr class="@if(!empty($stock->end)) bg-danger  @endif bg-success text-light">
{{--                                <td>{{$stock->id}}</td>--}}
                                <td>{{$stock->product}}</td>
                                <td>{{$stock->start}}</td>
                                <td>{{$stock->end}}</td>
                                <td>{{$stock->start - $stock->end}}</td>
                                <td>{{$stock->created_at}}</td>
                                <td><a data-bs-toggle="modal" data-bs-target="#exampleModal{{$stock->id}}"
                                       class="font-weight-bold" href="{{route('stocks.edit',$stock->id)}}"><i class="fas fa-edit link-light"></i></a>
                                    |
                                    <form class="d-inline-block" method="POST" action="{{route('stocks.destroy',$stock->id)}}}}">
                                        @csrf
                                        @method('DELETE')
{{--                                        <input type="submit"><i class="fas fa-trash"></i></input>--}}
                                        <button class="btn link-light p-0 m-0"><i class="fas fa-trash"></i></button>

                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{$stock->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form class="text-md-left"  method="POST" action="{{route('stocks.update',$stock->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="id" class="col-md-4 col-form-label text-md-left">{{ __('Id') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="id" type="text" disabled class="form-control @error('id') is-invalid @enderror" name="id"  value="{{ old('id',$stock->id) }}" required autocomplete="id" autofocus>
                                                        @error('id')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product" class="col-md-4 col-form-label text-md-left">{{ __('Product') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="product" type="text"
                                                               class="form-control @error('product') is-invalid @enderror"
                                                               name="product"  value="{{ old('product',$stock->product) }}"
                                                               required autocomplete="product" autofocus>
                                                        @error('product')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="start" class="col-md-4 col-form-label text-md-left">{{ __('Sasia Start') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start"  value="{{ old('start',$stock->start) }}" required autocomplete="start" autofocus>
                                                        @error('start')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="end" class="col-md-4 col-form-label text-md-left">{{ __('Sasia End') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="end" type="text" class="form-control @error('end') is-invalid @enderror" name="end"  value="{{ old('end',$stock->end) }}" required autocomplete="end" autofocus>
                                                        @error('end')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="evidence" class="col-md-4 col-form-label text-md-left">{{ __('Evidenca') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="evidence" type="text" class="form-control @error('evidence') is-invalid @enderror" name="evidence"  value="{{ old('evidence',$stock->evidence) }}" required autocomplete="evidence" autofocus>
                                                        @error('evidence')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
                        @endforeach


                        </tbody>
                    </table>
{{--                    @if()--}}
                    <form method="POST" action="{{route('generateStockReports')}}">
                        @csrf
                        <button class="btn btn-secondary">Gjenero</button>
                    </form>
{{--                    @endif--}}
                </div>
            </div>
    </div>
@endsection
