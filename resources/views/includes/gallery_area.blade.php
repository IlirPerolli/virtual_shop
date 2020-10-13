
<div class="container d-flex justify-content-center flex-wrap" style="margin-top: 100px">
    @yield('gallery_title')
    <ul class="list-unstyled col-lg-9 col-12">
        @if(count($posts)>0)
            @foreach($posts as $post)

                <li class="media my-4 col-12 col-md-12 col-lg-12 media-list"  style="border: 0.5px solid #DFDFDF; border-radius: 0.25rem; word-break:break-all; word-break:break-word; ">
                    <div class="box mr-3" style="width: 250px">
                        @if (strpos($post->photo->photo,',') !== false)
                            @foreach(explode(',',$post->photo->photo) as $photo)
                                <a href="{{route('post.show',$post->slug)}}"><img style="max-width: 250px; max-height: 250px;" class="rounded m-auto product-photo" src="{{'/images/'.$photo}}" alt="Generic placeholder image"></a>

                                @break
                            @endforeach

                        @else
                            <a href="{{route('post.show',$post->slug)}}">  <img style="max-width: 250px; max-height: 250px" class="rounded m-auto product-photo" src="{{$post->photo->photo}}" alt="Generic placeholder image"></a>
                        @endif

                    </div>
                    <div class="media-body product-body">
                        @if($post->title)
                            <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1"> {{Str::limit($post->title, 50)}}</h5></a>
                        @else
                            <a href="{{route('post.show',$post->slug)}}">  <h5 class="mt-0 mb-1">(Ska p&euml;rshkrim)</h5></a>
                        @endif

                        {{Str::limit($post->body, 200)}}
                        <p class="font-weight-bold">Çmimi: {{$post->price}} &#8364;</p>
                    </div>
                </li>
            @endforeach
        @else
            <h4 style="margin-bottom: 20px; color:red" class="text-center">Nuk u gjet&euml;n postime</h4>
        @endif

    </ul>
    <div class="col-lg-3 col-12" >
        <div class="card" style="width: 18rem; margin-top:24px; padding: 20px; background: #FCFCFC">
            <h5 class="card-title text-center p-2">Njer&euml;z q&euml; mund t'i njihni</h5>
            @if(count($users)>0)
                @foreach($users as $user)
                    <div class="media mb-4">
                        <a href="{{route('user.show',$user->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$user->photo->photo}}" alt="{{$user->name . " ". $user->surname}}" width="50px" height="50px"></a>
                        <div class="media-body">

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


        <div class="card" style="width: 18rem; margin-top:24px; padding: 20px; background: #FCFCFC">
            <a href="{{route('categories')}}"><h5 class="card-title text-center p-2">Eksploro kategori</h5></a>
            <div style="display: inline-block" class="pb-4">

                @foreach($categories as $category)
                    <a href="{{route('category.show',$category->slug)}}" style="padding: 5px">{{$category->name}}</a>
                @endforeach
            </div></div>



    </div>

</div>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        {{$posts->links()}}
    </ul>
</nav>

<!--================End Home Gallery Area =================-->

<!--================End Home Gallery Area =================-->
