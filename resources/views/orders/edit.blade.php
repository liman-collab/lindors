@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <!-- DataTales Example -->
        <div class="">

            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary float-left">Azhorno Pazarin Ditor</h5>

            </div>


            <div class="card-body p-4">
                <form class="text-md-left"  method="POST" action="{{route('orders.update', $order->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row col-md-6">

                        <div class="form-group">
                            <label for="id" class="col-md-4 col-form-label text-md-left">{{ __('Id') }}</label>

                            <div class="col-md-12">
                                <input disabled id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $order->id) }}" required autocomplete="id" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input" class="col-md-12 col-form-label text-md-left">{{ __('Kuleta') }}</label>

                            <div class="col-md-12">
                                <input id="input" type="text" class="form-control @error('input') is-invalid @enderror" name="input" value="{{ old('input',$order->input) }}">


                                @error('input')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pos" class="col-md-12 col-form-label text-md-left">{{ __('POS') }}</label>

                            <div class="col-md-12">
                                <input id="pos" type="text" class="form-control @error('pos') is-invalid @enderror" name="pos" value="{{ old('pos',$order->pos) }}">


                                @error('pos')
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
                <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete </button>
                </form>
            </div>


        </div>




    </div>
@endsection
