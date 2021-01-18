<style>

    @media screen and (max-width: 960px){
        .media-body{
            width: 100% !important;
        }
        .user-avatar{
            margin-right: 0px !important;
            margin-top: 25px;
        }
        .product-photo{
            max-width: 100% !important;
            max-height: 100% !important;

        }
        @media screen and (max-width: 960px){
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
            .people-you-may-know{
                margin-top: 30px!important;
            }
        }
    }</style>
<div class="container d-flex justify-content-center flex-wrap">
    @yield('gallery_title')

    <div class="list-group col-lg-9 col-12">
        @foreach($allcategories as $category)
            <a href="{{route('category.show', $category->slug)}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
        @endforeach
    </div>

    <div class="col-lg-3 col-12 people-you-may-know" >
        <div class="card m-auto" style="width: 18rem; padding: 20px; background: #FCFCFC">
            <h5 class="card-title text-center p-2">Njer&euml;z q&euml; mund t'i njihni</h5>
            @if(count($users)>0)
                @foreach($users as $user)
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
            <a href="{{route('search.users')}}"><h6 class="text-center mt-3">K&euml;rko p&euml;rdorues</h6></a>
        </div>


        <div class="card m-auto" style="width: 18rem; margin-top:24px !important; padding: 20px; background: #FCFCFC">
            <a href="{{route('categories')}}"><h5 class="card-title text-center p-2">Eksploro kategori</h5></a>
            <div style="display: inline-block" class="pb-4">

                @foreach($categories as $category)
                    <a href="{{route('category.show',$category->slug)}}" style="padding: 5px">{{$category->name}}</a>
                @endforeach
            </div></div>



    </div>

</div>


<!--================End Home Gallery Area =================-->

<!--================End Home Gallery Area =================-->
