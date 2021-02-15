@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; K&euml;rko p&euml;rdorues</title>
@endsection
@section('styles')
    <style>
        .first-card{
            margin-top: 0px !important;
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black !important;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: black !important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: black !important;
        }
        @media screen and (max-width: 640px){
            .media{
                width:auto !important;
                display: flex;
                text-align: left;
            }
            .media-body{
                margin: 0!important;
                width: 90% !important;
            }


        }
        @media screen and (max-width: 960px) {
            .users_user_may_know{
                margin-top: 30px!important;
            }
            .user-media{ /* Njerez qe mund ti njihni*/
                width:auto !important;
                display: flex;
                text-align: left;
                margin-top:25px !important;

            }
            .user-media-body{/* Njerez qe mund ti njihni*/
                margin: 0!important;
                width: 90% !important;

                margin-left: 10px !important;
            }
        }
    </style>
@endsection
@section('content')


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">
            <div class="col-lg-5 col-sm-6 m-auto" style="margin-bottom: 50px !important;">
                <aside class="f_widget news_widget mt-5">
                    <h3>K&euml;rko p&euml;rdorues</h3>
                    <form action="{{route('search.users')}}" method="GET" role="search">

                        <div class="input-group d-flex flex-row">
                            <input name="q" placeholder="K&euml;rko p&euml;rdorues" onfocus="this.placeholder = ''" onblur="this.placeholder = 'K&euml;rko p&euml;rdorues'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" value="@if(isset($_GET['q'])){{$_GET['q']}}@endif" autocomplete="off">
                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>

                        </div>
                    </form>

                </aside>

            </div>

            @if(isset($users))
                <div class="row">
                <div class="col-lg-9 col-12" >
                <h4>Rezultatet p&euml;r: {{$_GET['q']}} <span style="color:#e65228;font-size: 15px">({{$users_count}} p&euml;rdorues)</span></h4>
            @if (count($users_from_search)>0)
            @foreach($users_from_search as $user)
            <div class="media">
                <a href="{{route('user.show',$user->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$user->photo->photo}}" alt="{{$user->name . " ". $user->surname}}" width="50px" height="50px"></a>
                <div class="media-body">
                    @if($user->bio)
                        <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif</h5></a>
                        <p style="margin-top: -5px">{{$user->bio}}</p>
                        @else
                        <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif</h5></a>
                        <p style="margin-top: -5px">(Nuk ka bio)</p>
                    @endif

                </div>
            </div>

            @endforeach


                <nav aria-label="Pagination">
                    <ul class="pagination justify-content-center">
                        {{$users_from_search->links()}}
                    </ul>
                </nav>
                    @else
                        <h4 style="margin-bottom: 20px; margin-top:20px; color:red" class="text-center">Nuk u gjet&euml;n p&euml;rdorues</h4>
                    @endif
                </div>

               @include('includes.sidebar')
                </div>



            @endif
            @if(Session::has('user_not_found'))
                        <div class="alert alert-danger">{{session('user_not_found')}}</div>
                    @endif
            @if(Session::has('min_length_input'))
                <div class="alert alert-danger">{{session('min_length_input')}}</div>
            @endif


            </div>



        </div>

    <!-- End Align Area -->
@endsection
