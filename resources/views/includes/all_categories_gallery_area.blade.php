<style>
    .first-card{
        margin-top: 0px !important;
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
<div class="container d-flex justify-content-center flex-wrap" >
    @yield('gallery_title')

    <div class="list-group col-lg-9 col-12">
        @foreach($allcategories as $category)
            <a href="{{route('category.show', $category->slug)}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
        @endforeach
    </div>

    @include('includes.sidebar')

</div>


<!--================End Home Gallery Area =================-->

<!--================End Home Gallery Area =================-->
