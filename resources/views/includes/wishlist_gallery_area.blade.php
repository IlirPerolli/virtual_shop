<style>@media screen and (max-width: 960px){
        .media-body{
            width: 100% !important;
        }
        .user-avatar{
            margin-right: 0px !important;
            margin-top: 25px;
        }
        #remove_post_from_wishlist{
            position: relative !important;
            font-size: 17px !important;
        }
        #wishlist_title{
            margin-left: 0px !important;
        }
    }
    #remove_post_from_wishlist{
        right: 0;top: 0; position: absolute;cursor:pointer; font-size: 15px;color:red;
    }
    #remove_post_from_wishlist:hover{
        text-decoration: none;
    }
    .x-button{
        width: 15px;
        height: 15px;
        border: 1px solid #dc3545;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: #dc3545;
        color: white;
        font-size: 13px;
        margin-left: 3px;
        margin-top: 1px;
        padding-top: 1px;
    }
    .delete-post-container{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

</style>

<div class="container d-flex justify-content-center flex-wrap">

    @yield('gallery_title')
    <ul class="list-unstyled col-lg-9 col-12">
        @if(session('deleted_post'))
            <div class="alert alert-danger">{{session('deleted_post')}}</div>
        @endif

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
                            <form action="{{route('post.wishlist.destroy',$post->slug)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link" id="remove_post_from_wishlist" title="Largo nga lista e dëshirave"><div class="delete-post-container"><div>Largo</div> <div class="x-button" >&times;</div> </div></button>

                            </form>
                    </div>
                </li>
            @endforeach
        @else
            <h4 style="margin-bottom: 20px; margin-top: 30px; color:red" class="text-center">Lista e dëshirave është e zbrazët</h4>
        @endif

    </ul>
    @include('includes.sidebar')

</div>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        {{$posts->links()}}
    </ul>
</nav>

<!--================End Home Gallery Area =================-->

<!--================End Home Gallery Area =================-->
