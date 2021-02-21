@extends('layouts.index')
@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Profili </title>
@endsection
@section('styles')
    <style>

            .author_img{
                width:100% !important;
            }
            @media screen and (max-width: 640px){
                .modal-confirm {
                    width: 95% !important;
                    margin:auto;
                    margin-top: 20px;
                    margin-bottom: 20px;
                }
            }
            .modal-confirm {
                color: #636363;
                width: 400px;
            }
            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
                text-align: center;
                font-size: 14px;

            }
            .modal-confirm .modal-header {
                border-bottom: none;
                position: relative;

            }
            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -10px;
            }
            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -2px;
            }
            .modal-confirm .modal-body {
                color: #999;
            }
            .modal-confirm .modal-footer {
                border: none;
                text-align: center;
                border-radius: 5px;
                font-size: 13px;
                padding: 10px 15px 25px;
            }
            .modal-confirm .modal-footer a {
                color: #999;
            }
            .modal-confirm .icon-box {
                width: 80px;
                height: 80px;
                margin: 0 auto;
                border-radius: 50%;
                z-index: 9;
                text-align: center;
                border: 3px solid #f15e5e;
            }
            .modal-confirm .icon-box i {
                color: #f15e5e;
                font-size: 46px;
                display: inline-block;
                margin-top: 13px;
            }
            .modal-confirm .btn, .modal-confirm .btn:active {
                color: #fff;
                border-radius: 4px;
                background: #60c7c1;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                min-width: 120px;
                border: none;
                min-height: 40px;
                border-radius: 3px;
                margin: 0 5px;
            }
            .modal-confirm .btn-secondary {
                background: #c1c1c1;
            }
            .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
                background: #a8a8a8;
            }
            .modal-confirm .btn-danger {
                background: #f15e5e;
            }
            .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
                background: #ee3535;
            }
            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
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
                        @if(session()->has('updated_user'))
                            <div class="alert alert-success" role="alert">
                                {{session('updated_user')}}
                            </div>
                        @endif
                            @if(session()->has('username_changed'))<br>
                            <div class="alert alert-success" role="alert">
                                {{session('username_changed')}}
                            </div>
                            @endif
                        <h3 class="mb-30 title_color">Ndrysho profilin</h3>


                        <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mt-10">
                                <input type="text" name="name" placeholder="Emri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Emri'"  class="single-input" required value="{{$user->name}}">
                            </div>
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="text" name="surname" placeholder="Mbiemri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mbiemri'" class="single-input" required value="{{$user->surname}}">
                            </div>
                            @error('surname')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="email" name="email" placeholder="Email-adresa" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email-adresa'" required class="single-input" value="{{$user->email}}">
                            </div>
                            @error('email')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            @if($user->is_business == 1)
                                <div class="mt-10">
                                    <input type="text" name="business_name" placeholder="Emri i biznesit" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Emri i biznesit'" class="single-input" value="{{$user->business_name}}">
                                </div>
                                @error('business_name')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                                @endif


                            <div class="mt-10">
                                <textarea class="single-textarea" placeholder="Bio" name="bio" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Bio'">{{$user->bio}}</textarea>
                            </div>
                            @error('bio')
                            <span style="color:red">{{ $message }}</span>
                            @enderror

                            @error('photo_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
{{--                            <div class="mt-10">--}}
{{--                                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="single-input">--}}
{{--                            </div>--}}
                            <div class="mt-10 text-center">
                                <a href="{{route('user.username.edit')}}">Ndrysho username</a> |
                                <a href="{{route('user.password.edit')}}">Ndrysho fjal&euml;kalimin</a>

                            </div>

                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>

                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 mt-sm-30 element-wrap">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="{{$user->photo->photo}}" alt="" style="width:200px; height: 200px">
                                    <a href="{{route('user.photo.edit')}}">Ndrysho foton</a>
                                <h4 style="margin-top: 10px!important;">@if($user->is_business == 1){{$user->business_name}}@else {{$user->name . " ". $user->surname}}@endif</h4>
                                <p style="width:100%; word-break: break-all; word-break: break-word">{{$user->bio}}</p>

                                <h6 style="color:black; text-align: center; margin-top: 15px">Postime {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Ndjekje {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Ndjek&euml;s {{$followers}}</a></h6>
                                <p>{{$user->about}}</p>

                                    <a class="genric-btn danger-border circle" href="#myModal" style="margin-top: 5px" data-toggle="modal">Fshij profilin</a>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal to delete account -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">A jeni i sigurtë?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" style="text-align: left">
                <p>Na vjen keq duke ju parë që ju shkoni!
                    Me këtë veprim ju do të fshini llogarinë përgjithmonë!
                    <strong><b>Ju lutemi vini re:</b></strong><br>

                    Fshirja e llogarisë suaj dhe të dhënat personale janë të përhershme dhe nuk mund të zhbëhen. Bufi nuk do të jetë në gjendje të rikuperojë llogarinë tuaj pasi të dhënat të jenë fshirë. Gjithashtu me këtë veprim do të fshihen të gjitha në lidhje me ju duke përfshirë: postimet, foto e profilit.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer">Mbyll</button>
                <form action="{{route('user.destroy', $user->slug)}}" method="POST" style="display: inline-block;margin:5px">
                    @csrf
                    @method('delete')

                <button class="btn btn-danger" type="submit" style="cursor: pointer">Fshij</button> </form>
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
