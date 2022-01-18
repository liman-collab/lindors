@extends('layouts.main')

@section('content')

    <div class="form-group">
        <label for="input" class="col-md-4 col-form-label text-md-left">{{ __('Te hyrat ne euro') }}</label>

        <div class="col-md-12">
            <input id="input" type="text" class="form-control @error('input') is-invalid @enderror" name="input" value="{{ old('input') }}" required autocomplete="input" autofocus>
            @error('input')
            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
            @enderror
        </div>
    </div>

@endsection
