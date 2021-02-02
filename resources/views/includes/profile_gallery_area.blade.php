<style>

    .people-you-may-know{
        margin-bottom: 50px !important;
    }
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


    }</style>
<div class="container d-flex justify-content-center flex-wrap" style="margin-top: 100px">

    <ul class="list-unstyled col-lg-9 col-12">
        @if(count($posts)>0)
        @foreach($posts as $post)

            <li class="media my-4 col-12 col-md-12 col-lg-12 media-list"  style="border: 0.5px solid #DFDFDF; border-radius: 0.25rem;word-break:break-all; word-break:break-word; ">
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
    @include('includes.sidebar')

</div>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        {{$posts->links()}}
    </ul>
</nav>

<!--================End Home Gallery Area =================-->
