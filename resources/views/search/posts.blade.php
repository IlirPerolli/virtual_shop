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
                width: 100% !important;
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
        #default-select .nice-select .list{
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
                                    <div class="input-group-icon search-select mt-3">
                                        <div class="form-select">

                                            <div class="icon"> <i class="fa fa-layer-group" aria-hidden="true" style="margin-top: 14px"></i></div>
                                            <select name="order_by_price" id="order_by_price">
                                                <option value="" selected>Rëndit sipas relevancës</option>
                                                    <option value="desc" @if (isset($_GET['order_by_price'])){{$_GET['order_by_price'] == 'desc' ? 'selected' : ''}}@endif>Rëndit sipas çmimit: të lartë deri tek të ulët</option>
                                                    <option value="asc" @if (isset($_GET['order_by_price'])){{$_GET['order_by_price'] == 'asc' ? 'selected' : ''}}@endif>Rëndit sipas çmimit: të ulët deri tek të lartë</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                <button class="genric-btn primary mt-3 search-submit" style="width:50%;" type="submit" id="submit" >Kërko</button>
                                </div>
                            </div>


{{--                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>--}}
                            </div>


                    </form>

                </aside>

            </div>

            @if(isset($posts))
                @if (isset($_GET['q']))
                @if ($_GET['q'] != '')
                <div class="col-lg-9 col-12"><h4 class="text-left mt-4 ml-3">Rezultatet e kërkimit për: {{$_GET['q']}} <span style="color:#e65228;font-size: 15px"> ({{$posts_count}} postime)</span></h4></div><div class="col-3 d-none d-lg-block"></div>
                    @else
                        {{--                    //nese ka q po eshte e zbrazet--}}
                        <div class="col-lg-9 col-12"><h4 class="text-left mt-4 ml-3">Rezultatet e kërkimit: <span style="color:#e65228;font-size: 15px"> ({{$posts_count}} postime)</span></h4></div><div class="col-3 d-none d-lg-block"></div>

                    @endif
                    @else
{{--                    //nese nuk ka q fare--}}
                        <div class="col-lg-9 col-12"><h4 class="text-left mt-4 ml-3">Rezultatet e kërkimit: <span style="color:#e65228;font-size: 15px"> ({{$posts_count}} postime)</span></h4></div><div class="col-3 d-none d-lg-block"></div>

                    @endif
            @if ($is_sentence_corrected == true)

                        <div class="col-lg-9 col-12" style="margin-top: -27px!important;"><h5 class="text-left mt-4 ml-3"><span style="color:red">Mos keni menduar për:</span> <i><a href="?q={{$corrected_sentence}}">{{$corrected_sentence}}</a></i> </h5></div><div class="col-3 d-none d-lg-block"></div>

                @endif
                    @include('includes.gallery_area')
            @endif
            @if(Session::has('min_length_input'))
                <div class="alert alert-danger">{{session('min_length_input')}}</div>
            @endif
        </div>



    </div>
@section('scripts')
    <script>
      $(document).ready(function(){
          $('#submit').click(function(){
              if ($('#category').val().length == 0){//mos te hyne ne get metode inputi nese nuk zgjidhet
                  $('#category').prop('disabled',true);
              }
              if ($('#city').val().length == 0){//mos te hyne ne get metode inputi nese nuk zgjidhet
                  $('#city').prop('disabled',true);
              }
              if ($('#order_by_price').val().length == 0){//mos te hyne ne get metode inputi nese nuk zgjidhet
                  $('#order_by_price').prop('disabled',true);
              }

          });
      });
    </script>

    @endsection
    <!-- End Align Area -->
@endsection
