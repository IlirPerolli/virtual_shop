

@if (auth()->check())
    <div class="container d-flex justify-content-center flex-wrap" style="margin-top: 150px">

        <div class="container">
            <h1 class="mb-5">NewsFeed</h1>

        </div>
        @if(auth()->user()->followings->count()>0)
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="#">
                                    @if (strpos($post->photo->photo,',') !== false)
                                        @foreach(explode(',',$post->photo->photo) as $photo)
                                            <img class="img" src="{{'/images/'.$photo}}">
                                            @break
                                        @endforeach

                                    @else
                                        <img class="img" src="{{$post->photo->photo}}">

                                    @endif

                                    <a href="{{route('post.show',$post->slug)}}"> <div class="card-caption"> {{$post->title}} </div></a>
                                </a>
                                <div class="ripple-cont"></div>
                            </div>
                            <div class="table">
                                <a href="{{route('user.show',$post->user->slug)}}" style="color:#777777;"> <h6 class="category text-info"><i class="fa fa-user" style="margin-right: 5px" aria-hidden="true"></i>@if($post->user->is_business == 1){{$post->user->business_name}} @else {{$post->user->name . " ". $post->user->surname}}@endif</h6></a>
                                <a href="{{route('post.show',$post->slug)}}"> <p class="card-description"> {{Str::limit($post->body,150)}} </p></a>
                            </div>
                        </div>

                    </div>



                @endforeach
            </div>
        @else

            <div class="container">

                <h4 class="text-center">No posts</h4>
                <h4 class="text-center" style="margin-bottom: 50px">How about following someone?</h4>

            </div>


        @endif

        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$posts->links()}}
            </ul>
        </nav>
    </div>

@endif
