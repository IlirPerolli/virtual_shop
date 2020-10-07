@extends('layouts.index')
<title>Bigfish &#8226; Edit Post </title>
@section('content')
    <div class="whole-wrap" style="margin-top:80px;">
        <div class="container">


            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('post_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('post_updated')}}
                            </div>
                        @endif
                            @if(session()->has('nothing_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{session('nothing_updated')}}
                                </div>
                            @endif
                            @error('title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('body')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('price')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        <h3 class="mb-30 title_color">Edit Post</h3>


                        <form action="{{route('post.update', $post->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-10">
                                <input type="text" class="single-input" name="title" placeholder="Title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Title'" value="{{$post->title}}"/>
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'">{{$post->body}}</textarea>
                            </div>
                            <div class="mt-10">
                                <input type="number" class="single-input" name="price" placeholder="Price" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Price'" value="{{ $post->price}}" step="0.01"/>
                            </div>
                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Edit <span class="lnr lnr-arrow-right"></span></button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
