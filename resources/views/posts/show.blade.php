@extends('layouts.index')
@section('title')
<title>Bufi &#8226; {{$post->title}} </title>
@endsection
@section('styles')
    <style>
        @media screen and (max-width: 960px) {


            .media-body {
                width: 100% !important;
            }
            .carousel-photo-container{
                height: 350px !important;
            }
            .carousel-photo-container img{
                max-height: 350px !important;
            }

        }
            .similar-posts{
            font-size: 20px;
        }
        .product-photo{
            max-width: 100% !important;
            max-height: 100% !important;

        }


        @media screen and (max-width: 340px) {
            .author_img{
                width:100% !important;
            }
        }
        .carousel-photo-container{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 450px;
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            /*height: 100px;*/
            /*width: 100px;*/
            outline: black;
            background-size: 100%, 100%;
            background-image: none;
        }

        .carousel-control-next-icon:after
        {
            content: '>';
            font-size: 55px;
            color: black;
        }

        .carousel-control-prev-icon:after {
            content: '<';
            font-size: 55px;
            color: black;
        }
      </style>
@endsection
@section('content')
    @if(session('success_wishlist'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="z-index: 999; position: fixed; width: 100% ">
            <strong><b>Njoftim!</b></strong> {{session('success_wishlist')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('wishlist_failure'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert"  style="z-index: 999;position: fixed; width: 100% ">
            <strong><b>Njoftim!</b></strong> {{session('wishlist_failure')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<br><br>
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
{{--                                <img class="img-fluid" src="{{$post->photo->photo}}" alt="">--}}

                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @if (strpos($post->photo->photo,',') !== false)
                                            @foreach(explode(',',$post->photo->photo) as $photo)
                                                @if ($loop->index==0) @continue @endif
                                                {{--                                                Per te pare se ne cilin iterim eshte perdoret $loop --}}

                                                <li data-target="#carouselExampleIndicators" {{$loop->index == 1 ? 'class=active' : '' }}></li>
                                            @endforeach

                                        @else
                                            <li data-target="#carouselExampleIndicators" class="active"></li>

                                        @endif


                                    </ol>
                                    <div class="carousel-photo-container">


                                    <div class="carousel-inner">


                                        @if (strpos($post->photo->photo,',') !== false)
                                            @foreach(explode(',',$post->photo->photo) as $photo)

                                                @if ($loop->index==0) @continue @endif
{{--                                                Per te pare se ne cilin iterim eshte perdoret $loop --}}
                                                <div class="carousel-item {{$loop->index == 1 ? "active" : '' }}" style="max-height: 450px">
                                                <img class="d-block img-fluid" src="{{'/images/'.$photo}}" style="max-height: 450px; margin:auto" alt="First slide">
                                                </div>

                                            @endforeach

                                        @else
                                            <div class="carousel-item active" style="max-height: 450px">
                                            <img class="d-block img-fluid" src="{{$post->photo->photo}}"  style="max-height: 450px; margin:auto" alt="First slide">
                                            </div>
                                        @endif

                                    </div></div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">

                                <ul class="blog_meta list">
                                    <li><a href="{{route('user.show', $post->user->slug)}}">@if($post->user->is_business == 1){{$post->user->business_name}}@else {{$post->user->name . " ". $post->user->surname}}@endif<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}<i class="fa fa-list-alt" aria-hidden="true"></i></a></li>
                                    <li><a href="{{route('city.show', $post->city->slug)}}">{{$post->city->name}}<i class="fa fa-globe" aria-hidden="true"></i></a></li>
                                    <li><a href="#">{{$post->mobile_number}}<i class="fa fa-phone" aria-hidden="true"></i></a></li>
                                    <li><a href="#">{{$post->price}} &#8364;<i class="fa fa-money" aria-hidden="true"></i></a></li>
                                    <li><a href="#">{{$post->created_at->diffForHumans()}}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="{{route('post.likes',$post->slug)}}">{{$likes}} P&euml;lqime<i class="fa fa-heart" aria-hidden="true"></i></a> </li>
                                    <li><a href="#">{{$post->views}} Shikime<i class="lnr lnr-eye"></i></a></li>
                                   <li>
                                    @if(auth()->check())
                                    @if(auth()->user()->likes->contains($post))

                                            <form action="{{route('post.unlike',$post->id)}}" method="post" style="display: inline-block">
                                                @csrf


                                                <button type="submit" class="btn btn-danger" style="cursor:pointer;" id="unlike">E P&euml;lqyer <svg width="1em" height="1em" style="margin-bottom:-3px"  viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                    </svg> </button>



                                            </form>


                                        @else

                                            <form action="{{route('post.like',$post->id)}}" method="post" style="display: inline-block">
                                                @csrf


                                                <button type="submit" class="btn btn-outline-danger" id="like" style="cursor:pointer;">P&euml;lqe <svg width="1em" height="1em" style="margin-bottom:-3px" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg> </button>

                                            </form>

                                    @endif
                                    @else

                                            <form action="{{route('post.like',$post->id)}}" method="post" style="display: inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger" id="like" style="cursor:pointer;">P&euml;lqe <svg width="1em" height="1em" style="margin-bottom:-3px" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg> </button>

                                            </form>

                                    @endif

                                        <form action="{{route('post.wishlist.add',$post->slug)}}" method="post" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger" id="add_post_to_wishlist" title="Shto në listën e dëshirave" style="cursor:pointer;" ><i class="fa fa-heart" aria-hidden="true"></i></button>

                                        </form>
                                        </li>


                                    <li><a href="#comments-area" style="margin-top: 15px">{{$comments->count()}} Komente<i class="lnr lnr-bubble"></i></a></li>
                                    <li>

                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{$post->title}}</h2>
                            <p class="excert"><pre style="font-size: 14px;font-family: Poppins, sans-serif;font-weight: 300;color: #777777; white-space: pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;">{{$post->body}}</pre></p>
                            @if(auth()->check())
                            @if(auth()->user()->id == $post->user_id)

                                        <a href="{{route('post.edit',$post->slug)}}" class="genric-btn info-border circle">Ndrysho postimin</a>

                            <form action="{{route('post.destroy', $post->id)}}" method="POST" style="display: inline-block;margin:5px">
                                @csrf
                                @method('delete')
                                <button class="genric-btn danger-border circle" type="submit" >Fshij postimin</button>
                            </form>
                                @endif
                            @endif
                        </div>

                    </div>
                    <div class="comments-area" id="comments-area">
                        @if(session('deleted_comment'))
                            <div class="alert alert-danger">{{session('deleted_comment')}}</div>
                            @endif
                        @if(session('deleted_reply'))
                            <div class="alert alert-danger">{{session('deleted_reply')}}</div>
                            @endif
                            @error('body')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        <h4>{{$comments->count()}} Komente</h4>
                        @if(count($comments)>0)
                            @foreach($comments as $comment)
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <a href="{{route('user.show',$comment->user->slug)}}">  <img src="{{$comment->user->photo->photo}}" alt="" style="width:50px"></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="{{route('user.show', $comment->user->slug)}}">@if($comment->user->is_business == 1){{$comment->user->business_name}} @else {{$comment->user->name . " ". $comment->user->surname}}@endif</a></h5>
                                        <p class="date">{{$comment->created_at->diffForHumans()}} </p>
                                        <p class="comment">
                                            {{$comment->body}}@if(auth()->check())  @if(auth()->user()->id == $comment->user->id) <a href="{{route('comment.edit',$comment->slug)}}"><img src="{{asset('img/edit.png')}}" style="width: 15px; margin-left:5px;" title="Edit comment"></a>@endif @endif
                                        </p>
                                    </div>
                                </div>
{{--                                Delete comment--}}
                                @if(auth()->check())
                                @if(auth()->user()->id == $comment->user->id || auth()->user()->id == $comment->post->user->id)
                                <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete-btn">
                                        <button type="submit" class="genric-btn danger-border radius medium">Fshij</button>
                                    </div>
                                </form>
                                @endif
                                @endif
                            </div>
                            <form action="{{route('reply.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <div class="mt-10">
                                <input type="text" name="body" style="border: 1px solid lightgrey" placeholder="Shkruaj nj&euml; p&euml;rgjigje" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Shkruaj nj&euml; p&euml;rgjigje'" class="single-input" required="" autocomplete="off">
                            </div>
                                <div class="mt-10" style="display:none">
                                    <button type="submit" class="btn-reply text-uppercase" style="cursor:pointer;">P&euml;rgjigju</button>
                                </div>
                            </form>
                        </div>
{{--                        Reply--}}
                                @if(count($comment->replies)>0)
                                    @foreach($comment->replies as $reply)
                        <div class="comment-list left-padding">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <a href="{{route('user.show',$reply->user->slug)}}"> <img src="{{$reply->user->photo->photo}}" style="width:50px" alt=""></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="{{route('user.show',$reply->user->slug)}}">@if($reply->user->is_business == 1){{$reply->user->business_name}} @else {{$reply->user->name . " ". $reply->user->surname}}@endif</a></h5>
                                        <p class="date">{{$reply->created_at->diffForHumans()}} </p>
                                        <p class="comment">
                                            {{$reply->body}}@if(auth()->check())  @if(auth()->user()->id == $reply->user->id) <a href="{{route('reply.edit',$reply->slug)}}"><img src="{{asset('img/edit.png')}}" style="width: 15px; margin-left:5px;" title="Edit reply"></a>@endif @endif
                                        </p>
                                    </div>
                                </div>
{{--                                Delete reply--}}
                                @if(auth()->check())
                                @if(auth()->user()->id == $reply->user->id || auth()->user()->id == $reply->comment->post->user->id || auth()->user()->id == $reply->comment->user_id)
                                    <form action="{{route('reply.destroy',$reply->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="delete-btn">
                                            <button type="submit" class="genric-btn danger-border radius medium">Fshij</button>
                                        </div>
                                    </form>
                                @endif
                                @endif
                            </div>
                        </div>
                                    @endforeach
                                @else
                                    <h4 class="text-center">No Replies</h4>
                        @endif
                        @endforeach
                        @else
                            <h4 class="text-center">Ju mund t&euml; jeni i pari q&euml; komentoni, k&euml;shtu q&euml; vazhdoni!</h4>
                        @endif
                    </div>
                    <div class="comment-form">
                        <h4>L&euml;je nj&euml; koment</h4>
                        <form action="{{route('comment.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="body" placeholder="Shkruaj komentin" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Shkruaj komentin'" required="" autocomplete="off"></textarea>
                            </div>
                            <button type="submit" class="primary-btn button_hover" style="cursor:pointer;">Posto komentin</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
{{--                        <aside class="single_sidebar_widget search_widget">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="Search Posts">--}}
{{--                                <span class="input-group-btn">--}}
{{--                                        <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>--}}
{{--                                    </span>--}}
{{--                            </div><!-- /input-group -->--}}
{{--                            <div class="br"></div>--}}
{{--                        </aside>--}}
                        <aside class="single_sidebar_widget author_widget">
                            <a href="{{route('user.show', $post->user->slug)}}"><img class="author_img rounded-circle" src="{{$post->user->photo->photo}}" alt="" style="width:250px; height: 250px"></a>
                            <a href="{{route('user.show', $post->user->slug)}}"><h4>@if($post->user->is_business == 1)
                                        {{$post->user->business_name}}
                                    @else {{$post->user->name . " ". $post->user->surname}}
                                    @endif</h4></a>
                            <p style="width:100%; word-break: break-all; word-break: break-word">{{$post->user->bio}}</p>

                            <h6 style="color:black; text-align: center; margin-top:15px">Postime {{$user_posts}} | <a href="{{route('followings',$post->user->slug)}}" style="color:black">Ndjekje {{$followings}}</a> | <a href="{{route('followers',$post->user->slug)}}" style="color:black">Ndjek&euml;s {{$followers}}</a></h6>
                            <div class="br"></div>
                            @if(auth()->check() && auth()->user()->id != $post->user->id)

                            @if (auth()->user()->followings->contains($post->user->id))
                                <form action="{{route('user.unfollow',$post->user->id)}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="genric-btn primary radius" type="submit">Ndjekur</button>
                                </form>

{{--                                    @if(session('success_follow'))--}}
{{--                                        <div class="alert alert-success">{{session('success_follow')}}</div>--}}
{{--                                    @endif--}}

                                    @if(session('user_error'))
                                        <div class="alert alert-danger">{{session('user_error')}}</div>
                                    @endif
                            @else
                                <form action="{{route('user.follow',$post->user->id)}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="genric-btn primary radius" type="submit">Ndjek</button>
                                </form>

{{--                                @if(session('success_unfollow'))--}}
{{--                                <div class="alert alert-success">{{session('success_unfollow')}}</div>--}}
{{--                                    @endif--}}
                                    @if(session('user_error'))
                                        <div class="alert alert-danger">{{session('user_error')}}</div>
                                    @endif

                            @endIf

                            @endIf
                            @if(auth()->guest())
                                <form action="{{route('user.follow',$post->user->id)}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="genric-btn primary radius" type="submit">Ndjek</button>
                                </form>
                                @endif

                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
<div class="container d-flex justify-content-center flex-wrap">
    <div class="similar-posts">Postime t&euml; ngjashme</div>
    <ul class="list-unstyled col-lg-12 col-12 m-auto" style="margin-bottom: 50px !important;">
        @if(count($posts)>0)
            @foreach($posts as $post)

                <li class="media my-4 col-12 col-md-12 col-lg-12 media-list"  style="border: 0.5px solid #DFDFDF; border-radius: 0.25rem; word-break:break-all; word-break:break-word; ">
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
                            <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1"> {{Str::limit($post->title, 150)}}</h5></a>
                        @else
                            <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1">(Ska p&euml;rshkrim)</h5></a>
                        @endif

                        {{Str::limit($post->body, 200)}}
                        <p class="font-weight-bold">Çmimi: {{$post->price}} &#8364;</p>
                    </div>
                </li>
            @endforeach
        @else
            <h4 style="margin-bottom: 20px; margin-top:20px;color:red" class="text-center">Nuk u gjet&euml;n postime</h4>
        @endif

    </ul>

</div>
    <div class="loader loader-default" data-text="Ju lutem prisni..."></div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var cw = $('.author_img').width();
        $('.author_img').css({
            'height': cw + 'px'
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#like').click(function(){
                    $(".loader").addClass("is-active");
            });
            $('#unlike').click(function(){
                $(".loader").addClass("is-active");
            });
            $('#add_post_to_wishlist').click(function(){
                $(".loader").addClass("is-active");
            });
        });
    </script>
@endsection
