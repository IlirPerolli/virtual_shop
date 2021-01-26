@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Ballina </title>
    @endsection
@section('content')
    @if(@auth()->guest())
    <div class="container" style="margin-top: 150px;">
        <h1>Postimet</h1>

            <h4 class="text-center" style="margin-bottom: 50px">Duhet t&euml; kyçeni të shihni postimet</h4>

    </div>
    @endif
@include('includes.home_gallery_area')

@endsection
