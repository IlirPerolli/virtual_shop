@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Eksploro postime </title>
@endsection
@section('content')

    <div class="whole-wrap" style="margin-top: 120px; margin-bottom: 120px;">
            @if(session('wishlist_item_deleted'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="z-index: 999;position: fixed; width: 100%; top: 0">
            <strong><b>Njoftim!</b></strong> {{session('wishlist_item_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            @endif
        <div class="container">


            <h3 class="text-left display-3" id="wishlist_title" style="color: black; font-size: 40px; margin-left: 30px">Lista e dëshirave</h3>


                @include('includes.wishlist_gallery_area')




        </div>



    </div>
    <div class="loader loader-default" data-text="Ju lutem prisni..."></div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#remove_post_from_wishlist').click(function(){
                $(".loader").addClass("is-active");
            });
        });
    </script>
@endsection
