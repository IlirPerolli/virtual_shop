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
                 @include('includes.search_form')

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

                        <div class="col-lg-9 col-12" style="margin-top: -27px!important;"><h5 class="text-left mt-4 ml-3"><span style="color:red">Mos keni menduar për:</span> <i><a href="#" onclick="correctedSearch('{{$corrected_sentence}}')">{{$corrected_sentence}}</a></i> </h5></div><div class="col-3 d-none d-lg-block"></div>

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
<script>
    function correctedSearch(input) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        console.log(queryString);
        if ((urlParams.has('city')) && (urlParams.has('category')) && (urlParams.has('order_by_price'))) {
            const city = urlParams.get('city');
            const category = urlParams.get('category');
            const order_by_price = urlParams.get('order_by_price');
            window.location.href = '?q='+input+'&category='+category+'&city='+city+ '&order_by_price='+order_by_price;
        }
        else if ((urlParams.has('city')) && (urlParams.has('category'))) {
            const city = urlParams.get('city');
            const category = urlParams.get('category');
            window.location.href = '?q='+input+'&category='+category+'&city='+city;
        }
        else if (urlParams.has('city')) {
            const city = urlParams.get('city');
            window.location.href = '?q='+input+'&city='+city;

        } else if (urlParams.has('category')) {
            const category = urlParams.get('category')
            window.location.href = '?q='+input+'&category='+category;
        }
        else if (urlParams.has('order_by_price')) {
            const order_by_price = urlParams.get('order_by_price')
            window.location.href = '?q='+input+'&order_by_price='+order_by_price;
        }
        else{
            window.location.href = '?q='+input;
        }


    }

</script>
    @endsection
    <!-- End Align Area -->
@endsection
