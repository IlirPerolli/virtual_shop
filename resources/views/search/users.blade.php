@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; K&euml;rko p&euml;rdorues</title>
@endsection
@section('styles')
    <style>
        @media screen and (max-width: 960px) {

            .user-media{ /* Njerez qe mund ti njihni*/
                width:auto !important;
                display: flex;
                text-align: left;

            }
            .user-media-body{/* Njerez qe mund ti njihni*/
                margin: 0!important;
                width: 90% !important;
                margin-top: 25px !important;
                margin-left: 10px !important;
            }
        }

        body{
            background: #F9F9FF;
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
                            <input name="q" placeholder="K&euml;rko p&euml;rdorues" onfocus="this.placeholder = ''" onblur="this.placeholder = 'K&euml;rko p&euml;rdorues'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" autocomplete="off">
                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>

                        </div>
                    </form>

                </aside>

            </div>

            @if(isset($users))
                <div class="row">
                <div class="col-lg-9 col-12" >
                <h4>Rezultatet p&euml;r: {{$_GET['q']}}</h4>

            @foreach($users as $user)
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
                        {{$users->links()}}
                    </ul>
                </nav>
                </div>
                <div class="col-lg-3 col-12" >
                    <div class="card m-auto" style="width: 18rem; padding: 20px; background: #FCFCFC">
                        <h5 class="card-title text-center p-2">Njer&euml;z q&euml; mund t'i njihni</h5>
                        @if(count($users_user_may_know )>0)
                            @foreach($users_user_may_know as $user)
                                <div class="user-media media mb-4">
                                    <a href="{{route('user.show',$user->slug)}}"> <img class="align-self-start mr-3 rounded-circle user-avatar" src="{{$user->photo->photo}}" alt="{{$user->name . " ". $user->surname}}" width="50px" height="50px"></a>
                                    <div class="user-media-body media-body">

                                        <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">@if($user->is_business == 1)
                                                    {{$user->business_name}}
                                                @else {{$user->name . " ". $user->surname}}
                                                @endif</h5></a>
                                        <form action="{{route('user.follow',$user->id)}}" method="post">

                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-link" style="padding:0; margin:0; margin-top: -15px; cursor: pointer; text-decoration: none">Ndjek</button>
                                        </form>


                                    </div>

                                </div>

                            @endforeach
                        @else
                            <h4 style="margin-bottom: 20px; color:red" class="text-center">Nuk u gjet&euml;n p&euml;rdorues</h4>
                        @endif
                        <a href="{{route('search.users')}}"><h6 class="text-center">K&euml;rko p&euml;rdorues</h6></a>
                    </div>



                    <div class="card m-auto" style="width: 18rem; margin-top:24px !important; padding: 20px; background: #FCFCFC">
                        <a href="{{route('categories')}}"><h5 class="card-title text-center p-2">Eksploro kategori</h5></a>
                        <div style="display: inline-block" class="pb-4">

                            @foreach($categories as $category)
                                <a href="{{route('category.show',$category->slug)}}" style="padding: 5px">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                </div>

                    @endif
            @if(Session::has('user_not_found'))
                        <div class="alert alert-danger">{{session('user_not_found')}}</div>
                    @endif


            </div>



        </div>

    <!-- End Align Area -->
@endsection
