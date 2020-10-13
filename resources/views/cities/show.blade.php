@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; {{$city->name}} </title>
@endsection
@section('content')



    @include('includes.city_gallery_area')
@endsection
