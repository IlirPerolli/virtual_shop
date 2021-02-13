@extends('layouts.index')
@section('title')
<title>Bufi &#8226; Edito postimin </title>
@endsection
@section('styles')
    <style>
        .form-select .nice-select .list{
            height: 250px;
            overflow: auto;
        }
    </style>
@endsection
@section('content')
    <div class="whole-wrap" style="margin-top:80px;">
        <div class="container">


            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('post_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('post_updated')}}
                            </div>
                        @endif
                            @if(session()->has('nothing_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{session('nothing_updated')}}
                                </div>
                            @endif
                            @if(session()->has('category_error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('category_error')}}
                                </div>
                            @endif
                            @if(session()->has('city_error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('city_error')}}
                                </div>
                            @endif
                            @error('title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('body')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('mobile_number')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('price')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('category_id')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('city_id')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror


                        <h3 class="mb-30 title_color">Ndrysho Postimin</h3>


                        <form action="{{route('post.update', $post->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-10">
                                <input type="text" class="single-input" name="title" placeholder="Titulli" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Titulli'" value="{{$post->title}}"/>
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="P&euml;rshkrimi" onfocus="this.placeholder = ''" onblur="this.placeholder = 'P&euml;rshkrimi'">{{$post->body}}</textarea>
                            </div>
                            <div class="mt-10">
                                <input type="tel" class="single-input" name="mobile_number" id="mobile_number" placeholder="Numri i telefonit (04X123456) " pattern="[0-9]{9}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numri i telefonit (04X123456) '" value="{{ $post->mobile_number }}" required autocomplete="off"/>
                            </div>
                                <div class="mt-10">
                                <input type="number" class="single-input" name="price" placeholder="&Ccedil;mimi" onfocus="this.placeholder = ''" onblur="this.placeholder = '&Ccedil;mimi'" value="{{ $post->price}}" step="0.01"/>
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="form-select" id="default-select">

                                    <div class="icon"> <i class="fa fa-list" aria-hidden="true" style="margin-top: 15px"></i></div>
                                    <select name="category_id">
                                        <option value="" selected>Kategoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ $post->category->id == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-group-icon mt-10">
                                <div class="form-select" id="default-select">

                                    <div class="icon"> <i class="fa fa-globe" aria-hidden="true" style="margin-top: 14px"></i></div>
                                    <select name="city_id">
                                        <option value="" selected>Qyteti</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{ $post->city->id == $city->id ? 'selected' : ''}} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
