@extends('layouts.index')
@section('title')
<title>Bufi &#8226; Krijo postim </title>
@endsection
@section('styles')
    <style>
        .form-select .nice-select .list{
            height: 250px;
            overflow: auto;
        }
        #map-canvas{
            width: 450px;
            height: 350px;
        }
     </style>
@endsection
@section('content')

    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px">
        <div class="container">



                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('added_post'))
                            <div class="alert alert-success" role="alert">
                                {{session('added_post')}}
                            </div>
                        @endif
                            @if(session()->has('max_photos'))
                            <div class="alert alert-danger" role="alert">
                                {{session('max_photos')}}
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
                            @error('photo_id')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('photo_id.*')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        <h3 class="mb-30 title_color">Krijo postim</h3>


                        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mt-10">
                                <input type="text" class="single-input" name="title" id="title" placeholder="Titulli" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Titulli'" value="{{ old('title') }}" autocomplete="off" required/>
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" id="body" placeholder="P&euml;rshkrimi" onfocus="this.placeholder = ''" onblur="this.placeholder = 'P&euml;rshkrimi'" autocomplete="off" required>{{@old('body')}}</textarea>
                            </div>
                            <div class="mt-10">
                                <input type="number" class="single-input" name="mobile_number" id="mobile_number" placeholder="Numri i telefonit" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numri i telefonit'" value="{{ old('mobile_number') }}" required autocomplete="off" min="0"/>
                            </div>
                            <div class="mt-10">
                                <input type="number" class="single-input" name="price" id="price" placeholder="&Ccedil;mimi" onfocus="this.placeholder = ''" onblur="this.placeholder = '&Ccedil;mimi'" value="{{ old('price') }}" required autocomplete="off" step="0.01" min="0"/>
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="form-select" id="default-select">

                                    <div class="icon"> <i class="fa fa-list" aria-hidden="true" style="margin-top: 15px"></i></div>
                                    <select name="category_id" id="category">
                                        <option value="" selected>Kategoria</option>
                                       @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-group-icon mt-10">
                                <div class="form-select" id="default-select">

                                    <div class="icon"> <i class="fa fa-globe" aria-hidden="true" style="margin-top: 14px"></i></div>
                                    <select name="city_id" id="city">
                                        <option value="" selected>Qyteti</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{ old('city_id') == $city->id ? 'selected' : ''}} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-10">
                                <span style="margin-left: 20px;">*Max 5 foto</span>
                                <input type="file" name="photo_id[]" id="file" multiple class="single-input">

                            </div>


                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" id="submit" >Krijo <span class="lnr lnr-arrow-right"></span></button>

                            </div>
                            <div class="loader loader-default" data-text="Duke u postuar..."></div>

                        </form>
                    </div>

                </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                if (($('#title') .val().length !== 0) && ($('#body') .val().length !== 0) && ($('#price') .val().length !== 0) && ($('#mobile_number') .val().length !== 0) && ($('#category').val() != "") && ($('#city').val() != "") && ($('#city').val() != "") && ($('#file').val().length !== 0) ){
                    $( ".loader" ).addClass( "is-active" );
                }

            });
        });
    </script>
@endsection

