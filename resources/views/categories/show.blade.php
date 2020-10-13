@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; {{$category->name}} </title>
@endsection
@section('content')



    @include('includes.category_gallery_area')
@endsection
