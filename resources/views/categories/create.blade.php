@extends('layouts.index')
@section('title')
    <title>Bufi &#8226; Krijo kategori </title>
@endsection
@section('content')

    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px">
        <div class="container">



            <div class="row">
                <div class="col-lg-8 col-md-8 m-auto">
                    @if(session()->has('added_category'))
                        <div class="alert alert-success" role="alert">
                            {{session('added_category')}}
                        </div>
                    @endif


                    <h3 class="mb-30 title_color">Krijo kategori</h3>


                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('POST')
                        <div class="mt-10">
                            <input type="text" class="single-input" name="name" autocomplete="off" autofocus placeholder="Emri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Emri'" value="{{ old('name') }}"/>
                        </div>
                        @error('name')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mt-10 float-right">
                            <button class="genric-btn primary circle arrow" type="submit" >Create <span class="lnr lnr-arrow-right"></span></button>

                        </div>

                    </form>
                </div>

            </div>
            @if(session()->has('deleted_category'))
                <div class="alert alert-danger mt-4" role="alert">
                    {{session('deleted_category')}}
                </div>
            @endif
            <table class="table table-bordered" style="margin-top: 50px">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td><a href="{{route('category.show',$category->slug)}}">{{$category->name}}</a></td>
                    <td>
                        <form action="{{route('category.destroy',$category->id)}}" method="post" style="float: right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" style="cursor: pointer">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
