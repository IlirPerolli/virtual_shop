@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Ndrysho p&euml;rgjigjen </title>
@endsection
@section('content')
    <div class="whole-wrap" style="margin-top:80px;">
        <div class="container">


            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('reply_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('reply_updated')}}
                            </div>
                        @endif
                        @if(session()->has('nothing_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('nothing_updated')}}
                            </div>
                        @endif
                        <h3 class="mb-30 title_color">Ndrysho p&euml;rgjigjen</h3>


                        <form action="{{route('reply.update', $reply->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="P&euml;rgjigjja" onfocus="this.placeholder = ''" onblur="this.placeholder = 'P&euml;rgjigjja'">{{$reply->body}}</textarea>
                            </div>
                            @error('body')
                            <span style="color:red">{{ $message }}</span>
                            @enderror

                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
