<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0, shrink-to-fit=no">
    <meta property="og:image" content="img/avatar.jpg" />
    <meta name="description" content="Bufi, platforma per shitblerje" />
    <meta name="keywords" content="bufi, postime, perdorues, kompani, produkte, shitblerje" />
    <link rel="icon" href="{{asset('img/bufi.png')}}" type="image/png">
    <meta property="og:image" content="{{asset('img/bufi.png')}}" />
    <meta name="theme-color" content="#FF9666">
    <meta name="msapplication-navbutton-color" content="#FF9666">
    <meta name="apple-mobile-web-app-status-bar-style" content="#FF9666">
    @yield('title')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('vendors/linericon/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/lightbox/simpleLightbox.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/nice-select/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/animate-css/animate.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/gallery-style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/css-loader.css')}}">
    @yield('styles')
</head>
<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="{{route('home')}}"><img src="{{asset('img/bufi.png')}}" alt="" style="width: 45px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    @if(auth()->check())
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Ballina</a></li>

                    @endif
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eksploro</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('discover.posts')}}">Eksploro Postime</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('discover.users')}}">Eksploro Perdorues</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('discover.companies')}}">Eksploro Kompani</a></li>
                            </ul>


                    @if(auth()->check())
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Posto</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{route('post.create')}}">Krijo postim</a></li>
                            </ul>
                        </li>

                    @endif
                    @if(auth()->check())
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @if (auth()->user()->is_business == 1){{auth()->user()->business_name}}@else{{auth()->user()->name . " ". auth()->user()->surname}}@endif
                               </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{route('user.show',auth()->user()->slug)}}">Shfaq profilin</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.edit',auth()->user()->slug)}}">Ndrysho profilin</a></li>
                            </ul>
                        </li>

                    @endif
                    @if(!auth()->check())
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Kyçu</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Shkyqu</a></li>
                    @endif

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="{{route('search.posts')}}" class="search"><i class="lnr lnr-magnifier"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--================Header Menu Area =================-->
