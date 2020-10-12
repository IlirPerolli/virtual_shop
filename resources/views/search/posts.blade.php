@extends('layouts.index')
@section('title')
    <title>Bigfish &#8226; Search </title>
@endsection
@section('styles')
    <style>body{
            background: #F9F9FF;
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

    </style>
@endsection
@section('content')


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">
            <div class="col-lg-5 col-sm-6 m-auto" style="margin-bottom: 50px !important;">
                <aside class="f_widget news_widget mt-5">
                    <h3>K&euml;rko postime</h3>
                    <form action="{{route('search.posts')}}" method="GET" role="search">

                        <div class="input-group d-flex flex-row">
                            <input name="q" placeholder="K&euml;rko postime" onfocus="this.placeholder = ''" onblur="this.placeholder = 'K&euml;rko postime'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" autocomplete="off">
                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>

                        </div>
                    </form>

                </aside>

            </div>

            @if(isset($posts))
                <div class="col-9"><h3 class="text-left mt-4 ml-3">Search results for: {{$_GET['q']}}</h3></div><div class="col-3 d-none d-lg-block"></div>
                @include('includes.gallery_area')
            @endif
            @if(Session::has('post_not_found'))
                <div class="alert alert-danger">{{session('post_not_found')}}</div>
            @endif
        </div>



    </div>

    <!-- End Align Area -->
@endsection
