@extends('layouts.index')

@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Ndjek&euml;sit </title>
@endsection
@section('styles')
    <style>
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
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">

            <h4 class="mb-4"><span style="color: #343a40;font-size: 22px">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif's </span>Ndjek&euml;sit:</h4>
        @if(count($followers)>0)
            @foreach($followers as $follower)

                                    <div class="media">
                        <a href="{{route('user.show',$follower->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$follower->photo->photo}}" alt="{{$follower->name . " ". $follower->surname}}" width="50px" height="50px"></a>
                        <div class="media-body">
                            @if($follower->bio)
                                <a href="{{route('user.show',$follower->slug)}}"> <h5 class="mt-0">@if($follower->is_business == 1){{$follower->business_name}} @else {{$follower->name . " ". $follower->surname}}@endif</h5></a>
                                <p style="margin-top: -5px">{{$follower->bio}}</p>
                            @else
                                <a href="{{route('user.show',$follower->slug)}}"> <h5 class="mt-0">@if($follower->is_business == 1){{$follower->business_name}} @else {{$follower->name . " ". $follower->surname}}@endif</h5></a>
                                <p style="margin-top: -5px">(Nuk ka bio)</p>
                            @endif

                        </div>
                    </div>

                @endforeach
            @else
                <h5 class="text-center" style="color:red">Nuk u gjet asnj&euml; ndjekje.</h5>
                @endif

        </div>


        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$followers->links()}}
            </ul>
        </nav>
    </div>


    <!-- End Align Area -->
@endsection
