@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Kategorit&euml; </title>
@endsection


@section('content')
    <div class="whole-wrap" style="margin-top: 120px; margin-bottom: 120px;">
        <div class="container">


            <h3 class="text-left display-3" style="margin-bottom: 50px;color: black; font-size: 50px;">Qytetet</h3>
            <div class="row">


                @include('includes.all_cities_gallery_area')

            </div>




        </div>



    </div>

    <!-- End Align Area -->
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.user_img').width();
        $('.user_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection




