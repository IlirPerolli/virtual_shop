@extends('layouts.index')
<title>Bigfish &#8226; Discover Companies </title>
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



            <h3 class="text-center" style="margin-bottom: 50px;">Discover Companies</h3>
            <div class="row">
                @if(count($users)>0)
                    @foreach($users as $user)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="border text-center">
                                <a href="{{route('user.show',$user->slug)}}"> <img id="special" class="rounded-circle img-fluid user_img" style="width: 140px; margin-top: 25px;" src="{{$user->photo->photo}}"></a>
                                <a href="{{route('user.show',$user->slug)}}"><h5 class="text-center mt-3 mb-4">{{Str::limit($user->business_name,30)}}</h5></a>
                            </div>


                        </div>

                    @endforeach
                @else
                    <h4 style="margin-bottom: 20px; color:red; margin:auto" class="text-center">No companies found</h4>
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
