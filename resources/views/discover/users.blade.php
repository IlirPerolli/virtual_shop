@extends('layouts.index')
@section('title')
<title>Bufi &#8226; Eksploro njer&euml;z </title>
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

    </style>
@endsection
@section('content')


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 120px; margin-bottom: 120px;">
        <div class="container">



            <h3 class="text-center" style="margin-bottom: 50px;">Eksploro p&euml;rdorues</h3>
            <div class="row">
                @if(count($users)>0)
                    @foreach($users as $user)

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="border text-center" style="border-radius: 10px; border-color: #E3E3E3!important;">
                                <a href="{{route('user.show',$user->slug)}}"> <img id="special" class="rounded-circle img-fluid user_img" style="width: 120px; margin-top: 25px;" src="{{$user->photo->photo}}"></a>
                                <a href="{{route('user.show',$user->slug)}}" style="color: black"><h5 class="text-center mt-3 mb-4">{{Str::limit($user->name. " " . $user->surname,30)}}</h5></a>
                                <a href="{{route('user.show',$user->slug)}}" style="color: grey;"><h6 class="text-center mt-3 mb-4" style="margin-top: -25px!important;">{{"@".Str::limit($user->username,30)}}</h6></a>
                                <a href="{{route('followers',$user->slug)}}" style="color: black;"><h6 class="text-center mt-3 mb-4" style="margin-top: -15px!important;">{{$user->followers()->count()}} </h6></a>
                                <a href="{{route('followers',$user->slug)}}" style="color: grey;">  <h6 class="text-center mt-3 mb-4" style="margin-top: -27px!important; font-size: 12px !important;">Ndjek&euml;s</h6></a>
                            </div>


                        </div>

                    @endforeach
                @else
                    <h4 style="margin-bottom: 20px; color:red; margin:auto" class="text-center">Nuk u gjet asnj&euml; p&euml;rdorues</h4>
                @endif
            </div>



        </div>



    </div>

    <!-- End Align Area -->
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.user_img').width();
        $('.user_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection
