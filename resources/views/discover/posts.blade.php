@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Eksploro postime </title>
@endsection
@section('content')


    <div class="container" style="margin-top: 120px">
        <aside class="f_widget news_widget mt-5">
            @include('includes.search_form')

        </aside>
    </div>
    @include('includes.discover_gallery_area')
@endsection
