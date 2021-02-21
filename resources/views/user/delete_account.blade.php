@extends('layouts.index')
@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Profili</title>
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
                        @if(session('password_changed'))
                            <div class="alert alert-success">{{session('password_changed')}}</div>
                        @endif
                        <h3 class="mb-30 title_color">Fshij profilin</h3>

                        <form action="{{route('user.destroy')}}" class = "deleteacc" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="mt-10">
                                <input type="password" name="current_password" placeholder="Fjal&euml;kalimi aktual" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fjal&euml;kalimi aktual'" class="single-input" required>
                            </div>
                            @if(session('invalid-current-password'))
                                <span style="color:red">{{ session('invalid-current-password') }}</span>
                            @endif
                            <div class="mt-10 float-right">
                                <button type="button" class="genric-btn danger-border circle" id="delete_account"  data-toggle="modal" data-target="#deleteAccountModal" style="margin-top: 5px">Fshij profilin</button>

                            </div>

                            <!-- Modal to delete account -->
                            <div id="deleteAccountModal" class="modal fade">
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

                                                <button class="btn btn-danger" type="submit" style="cursor: pointer">Fshij</button>
                                        </div>
                                    </div>
                                </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.deleteacc').keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    $('#delete_account').click();
                    return false;
                }
            });
        });
    </script>
@endsection
