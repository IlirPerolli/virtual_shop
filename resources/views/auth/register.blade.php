@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Regjistrohu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Emri</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Mbiemri</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="name" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>

                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline" >
                                    <input type="radio" id="is_business1" name="is_business" {{ old('is_business') == 0 ? 'checked' : ''}} class="custom-control-input" value="0" onclick="hideCompany()">
                                    <label class="custom-control-label" for="is_business1">Individ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="is_business2" name="is_business" {{ old('is_business') == 1 ? 'checked' : ''}} class="custom-control-input" value="1" onclick="showCompany()">
                                    <label class="custom-control-label" for="is_business2">Kompani</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                        <div class="col-md-4"></div>

                        <div class="col-md-6">
                        @error('is_business')
                        <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div></div>
                        <div class="form-group row" id="business">
                            <label for="business_name" class="col-md-4 col-form-label text-md-right">Emri i kompanis&euml;</label>

                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}" autocomplete="business_name" >



                            </div> <div class="col-md-4"></div>
                            <div class="col-md-6">
                                @error('business_name')
                                <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-4"></div>

                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline" >
                                    <input type="radio" id="gender" name="gender" {{ old('gender') == 0 ? 'checked' : ''}} class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="gender">Femer</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender1" name="gender" {{ old('gender') == 1 ? 'checked' : ''}} class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="gender1">Mashkull</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>

                            <div class="col-md-6">
                                @error('gender')
                                <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div></div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail adresa</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Fjal&euml;kalimi</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Ri-shkruaj fjal&euml;kalimin</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Regjistrohu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script>


        function hideCompany(){
            document.getElementById('business').style.display = "none";
        }
        function showCompany(){
            document.getElementById('business').style.display = "flex";
        }
        if(document.getElementById("is_business1").checked){
            document.getElementById('business').style.display = "none";
        }

    </script>
@endsection

@endsection
