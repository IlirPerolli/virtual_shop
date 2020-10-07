@if (auth()->check())
<!--================Home Gallery Area =================-->
<section class="home_gallery_area p_120">
    <div class="container box_1620"><h3 class="text-center" style="margin-bottom: 50px;">Newsfeed</h3>
        @if(auth()->user()->followings->count()>0)
       <div class="gallery_f_inner row imageGallery1">

                @foreach($posts as $post)

                    <div class="col-lg-3 col-md-4 col-sm-6 ap">
                        <div style="text-align: left"><a href="{{route('user.show',$post->user->slug)}}" style="color:#777777;">{{"@".$post->user->username}}</a></div>
                        <div class="h_gallery_item" >
                            @if (strpos($post->photo->photo,',') !== false)
                                @foreach(explode(',',$post->photo->photo) as $photo)
                                    <img src="{{'/images/'.$photo}}" alt="">
                                    @break
                                @endforeach

                            @else
                                <img src="{{$post->photo->photo}}" alt="">
                            @endif
                            <div class="hover">
                                @if($post->title)
                                <a href="{{route('post.show',$post->slug)}}"><h4>{{$post->title}}</h4></a>
                                @else
                                    <a href="{{route('post.show',$post->slug)}}"><h4>(No description)</h4></a>
                                @endif

                                    @if (strpos($post->photo->photo,',') !== false)
                                        @foreach(explode(',',$post->photo->photo) as $photo)
                                            <a class="light" href="{{'/images/'.$photo}}"><i class="fa fa-expand"></i></a>
                                            @break
                                        @endforeach

                                    @else
                                        <a class="light" href="{{$post->photo->photo}}"><i class="fa fa-expand"></i></a>
                                    @endif
                            </div>

                        </div>

                    </div>
                @endforeach


        </div>
        @else

                <h3 class="text-center">No posts:(</h3>
            <h4 class="text-center"> How about following someone?</h4>
        @endif
        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$posts->links()}}
            </ul>
        </nav>
    </div>
</section>
<!--================End Home Gallery Area =================-->

@endif

