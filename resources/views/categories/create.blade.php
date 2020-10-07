@extends('layouts.index')
<title>Bigfish &#8226; Create Category </title>
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
                    @if(session()->has('added_category'))
                        <div class="alert alert-success" role="alert">
                            {{session('added_category')}}
                        </div>
                    @endif

                    @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror

                    <h3 class="mb-30 title_color">Add Category</h3>


                    <form action="{{route('category.store')}}" method="POST" >
                        @csrf
                        @method('POST')
                        <div class="mt-10">
                            <input type="text" class="single-input" name="name" autofocus placeholder="Title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Title'" value="{{ old('title') }}"/>
                        </div>

                        <div class="mt-10 float-right">
                            <button class="genric-btn primary circle arrow" type="submit" >Create <span class="lnr lnr-arrow-right"></span></button>

                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

@endsection
