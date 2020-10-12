@extends('layouts.index')
<title>Bigfish &#8226; Create City </title>
@section('styles')
    <style>body{
            background: #F9F9FF;
        }
    </style>
@endsection
@section('content')

    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px">
        <div class="container">



            <div class="row">
                <div class="col-lg-8 col-md-8 m-auto">
                    @if(session()->has('added_city'))
                        <div class="alert alert-success" role="alert">
                            {{session('added_city')}}
                        </div>
                    @endif

                    @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror

                    <h3 class="mb-30 title_color">Qyteti</h3>


                    <form action="{{route('city.store')}}" method="POST" >
                        @csrf
                        @method('POST')
                        <div class="mt-10">
                            <input type="text" class="single-input" name="name" autofocus placeholder="Emri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Emri'" value="{{ old('name') }}"/>
                        </div>

                        <div class="mt-10 float-right">
                            <button class="genric-btn primary circle arrow" type="submit" >Krijo <span class="lnr lnr-arrow-right"></span></button>

                        </div>

                    </form>
                </div>

            </div>

            @if(session()->has('deleted_city'))
                <div class="alert alert-danger mt-4" role="alert">
                    {{session('deleted_city')}}
                </div>
            @endif
            <table class="table table-bordered" style="margin-top: 50px">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Qyteti</th>
                    <th scope="col">Opsionet</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <th scope="row">{{$city->id}}</th>
                        <td><a href="{{route('city.show',$city->slug)}}">{{$city->name}}</a></td>
                        <td>
                            <form action="{{route('city.destroy',$city->id)}}" method="post" style="float: right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" style="cursor: pointer">Fshij</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>

@endsection
