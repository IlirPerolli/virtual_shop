@extends('layouts.index')

@section('title')
    <title>@if($user->is_business == 1)
               {{$user->business_name}}
        @else {{$user->name . " ". $user->surname}}
               @endif
        &#8226; Profili</title>
@endsection
@section('content')
<div class="col-lg-6 col-12 m-auto" style="margin-top: 140px!important;">
    <div class="media m-auto user-media-on-profile" style=" width: 500px">
    <img class="align-self-center mr-3 rounded-circle author_img" src="{{$user->photo->photo}}" alt="Generic placeholder image rounded-circle" alt="{{$user->name . " ". $user->surname}}" width="200px" height="200px">

        <div class="media-body ml-2">
        <h5 class="mt-0">{{"@".$user->username}}</h5>

        <h6 style="color:black;">Postime {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Ndjek {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Ndjek&euml;s {{$followers}}</a></h6>
        <h5 class="mt-0">@if($user->is_business == 1){{$user->business_name}}@else {{$user->name . " ". $user->surname}}@endif</h5>
        <p style="width:100%; word-break: break-all; word-break: break-word">{{$user->bio}}</p>
        <div style="margin:auto 0; margin-top:20px" class="follow-form">
            @if(auth()->check() && auth()->user()->id != $user->id)

                @if (auth()->user()->followings->contains($user->id))
                    <form action="{{route('user.unfollow',$user->id)}}" method="post">

                        @csrf
                        @method('post')
                        <button class="genric-btn primary radius" type="submit">Ndjekur</button>
                    </form>
                    <br>
                    {{--                                    @if(session('success_follow'))--}}
                    {{--                                        <div class="alert alert-success">{{session('success_follow')}}</div>--}}
                    {{--                                    @endif--}}

                    @if(session('user_error'))
                        <div class="alert alert-danger">{{session('user_error')}}</div>
                    @endif
                @else
                    <form action="{{route('user.follow',$user->id)}}" method="post">

                        @csrf
                        @method('post')
                        <button class="genric-btn primary radius" type="submit">Ndjek</button>
                    </form>
                    <br>
                    @if(session('user_error'))
                        <div class="alert alert-danger">{{session('user_error')}}</div>
                    @endif

                @endIf

            @endIf
            @if(auth()->guest())
                <form action="{{route('user.follow',$user->id)}}" method="post">

                    @csrf
                    @method('post')
                    <button class="genric-btn primary radius" type="submit">Ndjek</button>
                </form>
            @endif
                @if(auth()->check() && auth()->user()->id == $user->id)
                <a href="{{route('user.edit')}}" class="btn btn-outline-primary btn-sm" style="cursor: pointer">Ndrysho profilin</a>
                @endif
        </div>
    </div>

</div>

</div>

    <div class="col-lg-6 m-auto">
        @if(session()->has('deleted_post'))<br>
        <div class="alert alert-danger" role="alert">
            {{session('deleted_post')}}
        </div>
        @endif
    </div>



@include('includes.profile_gallery_area')
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.author_img').width();
        $('.author_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection
