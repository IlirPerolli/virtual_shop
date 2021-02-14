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


                        <h3 class="mb-30 title_color">Ndrysho Postimin</h3>


                        <form action="{{route('post.update', $post->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-10">
                                <input type="text" class="single-input" name="title" placeholder="Titulli" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Titulli'" value="{{$post->title}}"/>
                            </div>
                            @error('title')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="P&euml;rshkrimi" onfocus="this.placeholder = ''" onblur="this.placeholder = 'P&euml;rshkrimi'">{{$post->body}}</textarea>
                            </div>
                            @error('body')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="tel" class="single-input" name="mobile_number" id="mobile_number" placeholder="Numri i telefonit (04X123456) " pattern="[0-9]{9}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numri i telefonit (04X123456) '" value="{{ $post->mobile_number }}" required autocomplete="off"/>
                            </div>
                            @error('mobile_number')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                                <div class="mt-10">
                                <input type="number" class="single-input" name="price" placeholder="&Ccedil;mimi" onfocus="this.placeholder = ''" onblur="this.placeholder = '&Ccedil;mimi'" value="{{ $post->price}}" step="0.01"/>
                            </div>
                            @error('price')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
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
                            @error('category_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session()->has('category_error'))
                                <span style="color:red">{{session('category_error')}}</span>
                            @endif
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
                            @error('city_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session()->has('city_error'))
                                <span style="color:red">{{session('city_error')}}</span>
                            @endif
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
