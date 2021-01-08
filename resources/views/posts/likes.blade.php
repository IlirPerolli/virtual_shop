@extends('layouts.index')

@section('title')
    <title>{{$post->title}} &#8226; P&euml;lqimet </title>
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
        }</style>
@endsection
@section('content')
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">
            <h4 class="mb-4"><span style="color: #343a40;font-size: 22px">{{$post->title}}</span> P&euml;lqimet:</h4>
            @if(count($users)>0)
                @foreach($users as $user)

                    <div class="media">
                        <a href="{{route('user.show',$user->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$user->photo->photo}}" alt="{{$user->name . " ". $user->surname}}" width="50px" height="50px"></a>
                        <div class="media-body">
                            @if($user->bio)
                                <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif</h5></a>
                                <p style="margin-top: -5px">{{$follower->bio}}</p>
                            @else
                                <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">@if($user->is_business == 1){{$user->business_name}} @else {{$user->name . " ". $user->surname}}@endif</h5></a>
                                <p style="margin-top: -5px">(No bio available)</p>
                            @endif

                        </div>
                    </div>

                @endforeach
            @else
                <h5 class="text-center" style="color:red">Nuk u gjet asnj&euml; p&euml;lqim.</h5>
            @endif

        </div>


        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$users->links()}}
            </ul>
        </nav>
    </div>


    <!-- End Align Area -->
@endsection
