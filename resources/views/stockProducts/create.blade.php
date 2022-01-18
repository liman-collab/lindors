@extends('layouts.main')

@section('content')


    <div class="modal-body">
        <form class="text-md-left"  method="POST" action="{{route('stockProducts.store')}}">
            @csrf
            <div class="form-group">
                <label for="product" class="col-md-4 col-form-label text-md-left">{{ __('Produkti') }}</label>

                <div class="col-md-12">
                    <input id="product" type="text" class="form-control @error('product') is-invalid @enderror" name="product" value="{{ old('product') }}" required autocomplete="product" autofocus>
                    @error('product')
                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('Pershkrimi(opsional)') }}</label>

                <div class="col-md-12">
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
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
                    <button type="submit" class="btn btn-primary">
                        {{ __('Regjistro') }}
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection
