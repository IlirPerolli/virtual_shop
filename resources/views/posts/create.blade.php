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

                        <h3 class="mb-30 title_color">Krijo postim</h3>


                        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mt-10">
                                <input type="text" class="single-input" name="title" id="title" placeholder="Titulli" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Titulli'" value="{{ old('title') }}" autocomplete="off" required/>
                            </div>
                            @error('title')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" id="body" placeholder="P&euml;rshkrimi" onfocus="this.placeholder = ''" onblur="this.placeholder = 'P&euml;rshkrimi'" autocomplete="off" required>{{@old('body')}}</textarea>
                            </div>
                            @error('body')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="tel" class="single-input" name="mobile_number" id="mobile_number" placeholder="Numri i telefonit (04X123456) " pattern="[0-9]{9}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numri i telefonit (04X123456) '" value="{{ old('mobile_number') }}" required autocomplete="off"/>
                            </div>
                            @error('mobile_number')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="number" class="single-input" name="price" id="price" placeholder="&Ccedil;mimi" onfocus="this.placeholder = ''" onblur="this.placeholder = '&Ccedil;mimi'" value="{{ old('price') }}" required autocomplete="off" step="0.01" min="0"/>
                            </div>
                            @error('price')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
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
                            @error('category_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session()->has('category_error'))
                                <span style="color:red">{{session('category_error')}}</span>
                            @endif
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
                            @error('city_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session()->has('city_error'))
                                <span style="color:red">{{session('city_error')}}</span>
                            @endif
                            <div class="mt-10">
                                <span style="margin-left: 20px;">*Max 5 foto</span>
                                <input type="file" name="photo_id[]" accept='.jpeg,.jpg,.png,.svg' id="file" multiple class="single-input">

                            </div>
                            @error('photo_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @error('photo_id.*')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session()->has('max_photos'))
                                <span style="color:red">{{session('max_photos')}}</span>
                            @endif


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

