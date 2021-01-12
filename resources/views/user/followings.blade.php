@extends('layouts.index')
@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Njekjet </title>
@endsection

@section('styles')
    <style>body{
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
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">

           <h4 class="mb-4"><span style="color: #343a40;font-size: 22px">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif's </span>Ndjekjet:</h4>
            @if(count($followings)>0)
            @foreach($followings as $following)

                <div class="media">
                    <a href="{{route('user.show',$following->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$following->photo->photo}}" alt="{{$following->name . " ". $following->surname}}" width="50px" height="50px"></a>
                    <div class="media-body">
                        @if($following->bio)
                            <a href="{{route('user.show',$following->slug)}}"> <h5 class="mt-0">@if($following->is_business == 1){{$following->business_name}} @else {{$following->name . " ". $following->surname}}@endif</h5></a>
                            <p style="margin-top: -5px">{{$following->bio}}</p>
                        @else
                            <a href="{{route('user.show',$following->slug)}}"> <h5 class="mt-0">@if($following->is_business == 1){{$following->business_name}} @else {{$following->name . " ". $following->surname}}@endif</h5></a>
                            <p style="margin-top: -5px">(No bio available)</p>
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
                {{$followings->links()}}
            </ul>
        </nav>
    </div>

    <!-- End Align Area -->
@endsection
