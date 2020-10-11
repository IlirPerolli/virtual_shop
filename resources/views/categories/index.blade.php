@extends('layouts.index')
@section('title')
    <title>Bigfish &#8226; Category </title>
@endsection
@section('content')


    <div class="whole-wrap" style="margin-top: 120px; margin-bottom: 120px;">
        <div class="container">



            <h3 class="text-left display-3" style="margin-bottom: 50px;color: black">Kategoritë</h3>
            <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-6">
                    <div class="card text-white mb-5">
                        <img src="{{$category->photo->photo}}" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <a href="{{route('category.show',$category->slug)}}" style="color: white !important;"> <h5 class="card-title display-4" style="font-size: 45px">{{$category->name}}</h5></a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>

            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    {{$categories->links()}}
                </ul>
            </nav>


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




