@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <!-- DataTales Example -->
        <div class="">

            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary float-left">Azhorno Pazarin Ditor</h5>

            </div>

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

            <div class="card-body p-4">
                <form class="text-md-left"  method="POST" action="{{route('stockReports.update', $stockReport->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row col-md-6">

                        <div class="form-group">
                            <label for="id" class="col-md-4 col-form-label text-md-left">{{ __('Id') }}</label>

                            <div class="col-md-12">
                                <input disabled id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $stockReport->id) }}" required autocomplete="id" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product" class="col-md-12 col-form-label text-md-left">{{ __('Produkti') }}</label>

                            <div class="col-md-12">
                                <input id="product" type="text" class="form-control @error('product') is-invalid @enderror" name="product" value="{{ old('product',$stockReport->product) }}">


                                @error('product')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-md-12 col-form-label text-md-left">{{ __('Start') }}</label>

                            <div class="col-md-12">
                                <input id="start" type="number" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start',$stockReport->start) }}">


                                @error('start')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-md-12 col-form-label text-md-left">{{ __('End') }}</label>

                            <div class="col-md-12">
                                <input id="end" type="number" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end',$stockReport->end) }}">


                                @error('end')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="evidence" class="col-md-12 col-form-label text-md-left">{{ __('Evidenca') }}</label>

                            <div class="col-md-12">
                                <input id="evidence" type="number" class="form-control @error('evidence') is-invalid @enderror" name="evidence" value="{{ old('evidence',$stockReport->evidence) }}">


                                @error('evidence')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="col-md-12 col-form-label text-md-left">{{ __('Shenimet') }}</label>

                            <div class="col-md-12">
                                <input id="notes" type="number" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes',$stockReport->notes) }}">


                                @error('notes')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <br>

                    <div class="form-group d-flex gap-2">
                        <div>
                            <button  type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
                <br>
{{--                <form method="POST" action="{{ route('orders.destroy', $order->id) }}">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button class="btn btn-danger">Delete </button>--}}
{{--                </form>--}}
            </div>


        </div>




    </div>
@endsection
