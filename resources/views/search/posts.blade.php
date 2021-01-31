@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; K&euml;rko postime </title>
@endsection
@section('styles')
    <style>
        @media screen and (max-width: 960px){
            .search-select{
                margin-top: 16px !important;
                width: 100% !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .search-submit{
                display: block !important;
            }
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black !important;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: black !important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: black !important;
        }
        .container{
            margin-top: 10px!important;
        }
        .form-select .nice-select .list{
            height: 250px;
            overflow: auto;
        }

    </style>
@endsection
@section('content')


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 m-auto" style="margin-bottom: 50px !important;">
                <aside class="f_widget news_widget mt-5">
                    <h3>K&euml;rko postime</h3>
                    <form action="{{route('search.posts')}}" method="GET" role="search">

                        <div class="input-group d-flex flex-row ">
                            <div class="form-row col-12" style="width: 100% !important; padding:0 !important; margin:0 !important;">
                                <div class="col-lg-4 col-12">
                                    <input name="q" placeholder="K&euml;rko postime" onfocus="this.placeholder = ''" onblur="this.placeholder = 'K&euml;rko postime'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" value="@if(isset($_GET['q'])){{$_GET['q']}}@endif" autocomplete="off">
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="input-group-icon search-select">
                                        <div class="form-select" id="default-select">

                                            <div class="icon"> <i class="fa fa-list" aria-hidden="true" style="margin-top: 15px"></i></div>
                                            <select name="category" id="category">
                                                <option value="" selected>T&euml; gjitha kategorit&euml;</option>
                                                @foreach($allcategories as $category)
                                                    <option value="{{$category->slug}}" @if (isset($_GET['category'])){{$_GET['category'] == $category->slug ? 'selected' : ''}}@endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="input-group-icon search-select">
                                        <div class="form-select" id="default-select">

                                            <div class="icon"> <i class="fa fa-globe" aria-hidden="true" style="margin-top: 14px"></i></div>
                                            <select name="city" id="city">
                                                <option value="" selected>Gjith&euml; vendin</option>
                                                @foreach($cities as $city)

                                                    <option value="{{$city->slug}}" @if (isset($_GET['city'])){{$_GET['city'] == $city->slug ? 'selected' : ''}}@endif>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                <button class="genric-btn primary mt-3 search-submit" style="width:100%; display: none" type="submit" id="submit" >Krijo <span class="lnr lnr-arrow-right"></span></button>
                                </div>
                            </div>


{{--                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>--}}
                            </div>


                    </form>

                </aside>

            </div>

            @if(isset($posts))
                <div class="col-lg-9 col-12"><h4 class="text-left mt-4 ml-3">Rezultatet e kërkimit për: {{$_GET['q']}} <span style="color:#e65228;font-size: 15px"> ({{$posts_count}} postime)</span></h4></div><div class="col-3 d-none d-lg-block"></div>
                @include('includes.gallery_area')
            @endif
            @if(Session::has('min_length_input'))
                <div class="alert alert-danger">{{session('min_length_input')}}</div>
            @endif
        </div>



    </div>

    <!-- End Align Area -->
@endsection
