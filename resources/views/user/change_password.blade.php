@extends('layouts.index')
@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Profili</title>
@endsection
@section('styles')
    <style>

        .author_img{
            width:100% !important;
        }

    </style>
@endsection
@section('content')

{{--    @include('includes.profile_banner_area')--}}


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 100px">
        <div class="container">


            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        @if(session('password_changed'))
                            <div class="alert alert-success">{{session('password_changed')}}</div>
                        @endif
                        <h3 class="mb-30 title_color">Ndrysho fjal&euml;kalimin</h3>

                        <form action="{{route('user.password.update')}}" method="POST" >
                            @csrf
                            @method('PATCH')

                            <div class="mt-10">
                                <input type="password" name="current_password" placeholder="Fjal&euml;kalimi aktual" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fjal&euml;kalimi aktual'" class="single-input">
                            </div>
                            @error('current_password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if(session('invalid-current-password'))
                                <span style="color:red">{{ session('invalid-current-password') }}</span>
                                @endif
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Fjal&euml;kalimi i ri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fjal&euml;kalimi i ri'" class="single-input">
                            </div>
                            @error('password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="password" name="password_confirmation" placeholder="Ri-shkruaj fjal&euml;kalimin e ri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ri-shkruaj fjal&euml;kalimin e ri'" class="single-input">
                            </div>
                            @error('password_confirmation')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>

                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 mt-sm-30 element-wrap">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="{{$user->photo->photo}}" alt="" style="width:250px; height: 250px">
                                <h4>{{$user->name . " ". $user->surname}}</h4>
                                <p style="width:100%; word-break: break-all; word-break: break-word">{{$user->bio}}</p>

                                <h6 style="color:black; margin-top: 15px">Postime {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Ndjekje {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Ndjek&euml;s {{$followers}}</a></h6>
                                <p>{{$user->about}}</p>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- End Align Area -->
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.author_img').width();
        $('.author_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection
