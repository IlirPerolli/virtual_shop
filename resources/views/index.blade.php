@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Ballina </title>
    @endsection
@section('styles')

@endsection
@section('content')
    @if(@auth()->guest())
    <div class="container" style="margin-top: 150px;">
        <h1>Postimet</h1>

            <h4 class="text-center" style="margin-bottom: 50px">Duhet t&euml; kyçeni të shihni postimet</h4>

    </div>
    @endif
    <div class="container" style="margin-top: 120px">
    <aside class="f_widget news_widget mt-5">
        @include('includes.search_form')

    </aside>
    </div>
@include('includes.home_gallery_area')

@endsection
