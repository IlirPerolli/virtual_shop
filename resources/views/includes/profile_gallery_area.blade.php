<style>
    @media screen and (max-width: 960px) {
        .media-list{

            margin-top: 40px !important;
        }
        .box{
            margin-right: 30px!important;
        }
        .box img{ width: 100% !important;}

        .media-list img{
            width: 100% !important;
        }

    }
    @media screen and (max-width: 640px) {
        .box{
            width: 100% !important;
        }

    }
    .media-list{
        width:100% !important;
      padding: 0;
    }
    .box {
    margin:auto;
        text-align: center;
    }
    .box img{
        margin:0 auto !important;
    }
    .product-body{
        padding:10px;
    }
</style>

<!--================Home Gallery Area =================-->
{{--<section class="home_gallery_area p_120" style="padding-top: 60px">--}}
{{--    <div class="container box_1620"> <h4 class="text-center" style="margin-bottom: 50px;">Gallery</h4>--}}
{{--        <div class="gallery_f_inner row imageGallery1">--}}

{{--            @foreach($posts as $post)--}}
{{--            <div class="col-lg-3 col-md-4 col-sm-6 ap">--}}
{{--                <div class="h_gallery_item">--}}
{{--                    @if (strpos($post->photo->photo,',') !== false)--}}
{{--                        @foreach(explode(',',$post->photo->photo) as $photo)--}}
{{--                            <img src="{{'/images/'.$photo}}" alt="">--}}
{{--                            @break--}}
{{--                        @endforeach--}}

{{--                    @else--}}
{{--                        <img src="{{$post->photo->photo}}" alt="">--}}
{{--                    @endif--}}
{{--                    <div class="hover">--}}
{{--                        @if($post->title)--}}
{{--                            <a href="{{route('post.show',$post->slug)}}"><h4>{{$post->title}}</h4></a>--}}
{{--                        @else--}}
{{--                            <a href="{{route('post.show',$post->slug)}}"><h4>(No description)</h4></a>--}}
{{--                        @endif--}}

{{--                            @if (strpos($post->photo->photo,',') !== false)--}}
{{--                                @foreach(explode(',',$post->photo->photo) as $photo)--}}
{{--                                    <a class="light" href="{{'/images/'.$photo}}"><i class="fa fa-expand"></i></a>--}}
{{--                                    @break--}}
{{--                                @endforeach--}}

{{--                            @else--}}
{{--                                <a class="light" href="{{$post->photo->photo}}"><i class="fa fa-expand"></i></a>--}}
{{--                            @endif--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endforeach--}}


{{--        </div>--}}



{{--    </div>--}}
{{--    <br>--}}

{{--    <nav aria-label="Pagination">--}}
{{--        <ul class="pagination justify-content-center">--}}
{{--            {{$posts->links()}}--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--</section>--}}

<div class="container d-flex justify-content-center" style="margin-top: 100px">

    <ul class="list-unstyled col-12">

        @foreach($posts as $post)

            <li class="media my-4 col-12 col-md-12 col-lg-12 media-list"  style="border: 0.5px solid #DFDFDF; border-radius: 0.25rem">
                <div class="box mr-3" style="width: 250px">
                    @if (strpos($post->photo->photo,',') !== false)
                        @foreach(explode(',',$post->photo->photo) as $photo)
                            <a href="{{route('post.show',$post->slug)}}"><img style="max-width: 250px; max-height: 250px;" class="rounded m-auto product-photo" src="{{'/images/'.$photo}}" alt="Generic placeholder image"></a>

                            @break
                        @endforeach

                    @else
                        <a href="{{route('post.show',$post->slug)}}">  <img style="max-width: 250px; max-height: 250px" class="rounded m-auto product-photo" src="{{$post->photo->photo}}" alt="Generic placeholder image"></a>
                    @endif

                </div>
                <div class="media-body product-body">
                    @if($post->title)
                        <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1"> {{Str::limit($post->title, 50)}}</h5></a>
                    @else
                        <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1">(No description)</h5></a>
                    @endif

                    {{Str::limit($post->body, 200)}}
                    <p class="font-weight-bold">Çmimi: {{$post->price}} &#8364;</p>
                </div>
            </li>
        @endforeach

    </ul>

</div>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        {{$posts->links()}}
    </ul>
</nav>

<!--================End Home Gallery Area =================-->
