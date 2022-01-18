@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container-fluid px-4">
{{--        <br>--}}
{{--        <div class="text-center">--}}
{{--            <img class="rounded-circle p-4" src="images/logo.jpg" alt="">--}}
{{--        </div>--}}
                <ol class="breadcrumb mb-4">
{{--                    <li class="breadcrumb-item active">Dashboard</li>--}}
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                Arka
                                <a type="button" class="btn p-0 btn-link text-white @if(!empty(count($arkas))) disabled @endif" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Sheno te hyrat
                                </a>
                            </div>
                            @if($currentTime2)
                            @foreach($arkas as $arka)

                                    <div class="card-body d-flex justify-content-between px-3 align-items-center">
                                    {{$arka->input}} Euro
                                        <a class="btn btn-link text-white" href="{{route('arka.edit',$arka->id)}}">Edit</a>

                                </div>
{{--                            @if($mbetja < 0) Duhet te jene: {{$arka->input + $mbetja}} Euro @endif--}}
                            @endforeach
                            @endif

{{--                            <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                                <a class="small text-white" href="{{route('arka.index')}}">View Details</a>--}}
{{--                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>--}}
{{--                            </div>--}}

                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                Pazari Ditor
                                <a type="button" class="btn p-0 btn-link text-white @if(!empty(count($orders))) disabled @endif" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    Sheno te hyrat
                                </a>
                            </div>
                            @if($currentTime2)
                                @foreach($orders as $order)
                                    <div class="card-body d-flex justify-content-between px-3 align-items-center">
                                        {{$order->pazari}} Euro
                                        <a class="btn btn-link text-white" href="{{route('orders.edit',$order->id)}}">Edit</a>

                                    </div>
{{--                                    @if($mbetja < 0) Duhet te jene: {{$order->input - $mbetja}} Euro @endif--}}
                                @endforeach
                            @endif
{{--                            <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                                <a class="small text-white" href="{{route('orders.index')}}">View Details</a>--}}
{{--                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>--}}
{{--                            </div>--}}

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 ">
                        <div class="card col bg-dark text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                Arka POS
{{--                                <a type="button" class="btn p-0 btn-link text-white @if(!empty(count($pos))) disabled @endif" data-bs-toggle="modal" data-bs-target="#exampleModal1">--}}
{{--                                    Sheno te hyrat--}}
{{--                                </a>--}}
                            </div>
                            @if($currentTime2)
                                @foreach($orders as $order)
                                    <div class="card-body d-flex justify-content-between px-3 align-items-center">
                                        {{$order->pos}} Euro
{{--                                        <a class="btn btn-link text-white" href="{{route('pos.edit', $posArka->id)}}">Edit</a>--}}
                                    </div>
                                @endforeach
                            @endif


                        </div>

{{--                        <div class="card col bg-dark text-white mb-4">--}}
{{--                            <div class="card-body d-flex justify-content-between">--}}
{{--                               Kuleta--}}

{{--                            </div>--}}
{{--                            @if($currentTime2)--}}
{{--                                @foreach($orders as $order)--}}
{{--                                    <div class="card-body d-flex justify-content-between px-3 align-items-center">--}}
{{--                                        {{$order->input}} Euro--}}
{{--                                        <a class="btn btn-link text-white" href="{{route('pos.edit', $posArka->id)}}">Edit</a>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}


{{--                        </div>--}}




                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                Shpenzimet
{{--                                <a type="button" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal3">--}}
{{--                                    Sheno te hyrat--}}
{{--                                </a>--}}
                                @if($currentTime2)
                                           <div>
                                               {{$expenses->sum('total')}} Euro
                                           </div>
                                @endif
                            </div>



                            <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white" href="{{route('expenses.index')}}">Shto Shpezimet</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>

                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 d-flex">
                <br>

                <a class=" @if(empty(count($orders))) disabled  @endif btn btn-secondary m-1" id="confirmInvoice1"  href="{{route('generate-raports.index')}}">Ruaj Raportin Ditor</a>

                <br>
                <a class="btn btn-secondary m-1" id="confirmInvoice"   href="{{url('/generateAll')}}">Gjenero Raportin per Shpenzime</a>
                <br>
                <a class="btn btn-secondary m-1" id="confirmInvoice"   href="{{url('/generateStock')}}">Raporti mbi Stokun</a>
                <br>
                <a class="btn btn-secondary m-1" id="confirmInvoice"   href="{{url('/searchDailyReports')}}">Gjenero Raportet Ditore</a>
            </div>


            <div class="col-xl-2 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                        Stoku
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white" href="{{route('stocks.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>

                </div>
            </div>



            <div class="col-xl-6 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                      Mbetja


                        <div class="@if($mbetja < 0) bg-danger p-1 @endif"> @if($mbetja) {{$mbetja}}  @else 0  @endif Euro</div>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white" href="{{route('results.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>

                </div>
            </div>

        </div>
        <br><br>
        @if($mbetja < 0)
            <div class="card bg-danger text-light p-3">
                <h4>Mbetja eshte negative</h4>
{{--                @foreach($orders as $order)--}}
{{--                <a href="{{route('dashboard.edit',$order->id)}}"></a>--}}
{{--                @endforeach--}}
            </div>
   @endif

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arka</h5>

                </div>
                <div class="modal-body">
                    <form class="text-md-left"  method="POST" action="{{route('arka.store')}}">
                        @csrf
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

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arka POS</h5>

                </div>
                <div class="modal-body">
                    <form class="text-md-left"  method="POST" action="{{route('pos.store')}}">
                        @csrf
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
                        </div>       <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Regjistro') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pazari Ditor</h5>

                </div>
                <div class="modal-body">
                    <form class="text-md-left"  method="POST" action="{{route('orders.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="input" class="col-md-4 col-form-label text-md-left">{{ __('Kuleta') }}</label>


                            <div class="col-md-12">
                                <input id="input" type="text" class="form-control @error('input') is-invalid @enderror" name="input" value="{{ old('input') }}" required autocomplete="input" autofocus>
                                @error('input')
                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                            <label for="pos" class="col-md-4 col-form-label text-md-left">{{ __('POS') }}</label>

                            <div class="col-md-12">
                                <input id="pos" type="text" class="form-control @error('pos') is-invalid @enderror" name="pos" value="{{ old('pos') }}" required autocomplete="pos" autofocus>
                                @error('pos')
                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                        </div>       <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Regjistro') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shpezimet</h5>
                </div>
                <div class="modal-body">
                    <form class="text-md-left"  method="POST" action="{{route('input.store')}}">
                        @csrf
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
                        </div>       <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Regjistro') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



{{--    <script type="text/javascript">--}}
{{--        $('#confirmInvoice1').prop('disabled',{{$status}});--}}
{{--    </script>--}}

@endsection
