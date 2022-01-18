@extends('layouts.main')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="card-body">
    <h6>Azhorno Shpenzimin</h6>
    <form class="card col-md-6" method="POST" action="{{route('expenses.update',$expense->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group p-3">
            <label for="id">Id</label>
            <input type="number"  class="form-control @error('id') is-invalid @enderror"
                   id="id"  name="id" value="{{old('id',$expense->id)}}">

            @error('id')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group p-3">
            <label for="product">Produkti</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror"
                   id="product" name="product" value="{{old('product',$expense->product)}}">

            @error('product')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group p-3">
            <label for="total">Totali</label>
            <input type="number" step="any" class="form-control @error('total') is-invalid @enderror"
                   id="total" name="total" value="{{old('total',$expense->total)}}">

            @error('total')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <button type="submit" id="updateButton" class="btn btn-primary col-md-3 mx-3">Update</button>
    </form>
    </div>

    <script type="text/javascript">

         $('#product').attr('disabled', 'disabled');
         $('#id').attr('disabled', 'disabled');

        $('#updateButton').click(function (){
            $('#product').removeAttr('disabled');
            $('#id').removeAttr('disabled');
            });
    </script>


@endsection
