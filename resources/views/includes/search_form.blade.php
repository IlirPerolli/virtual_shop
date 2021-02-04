@section('styles')
    <style>
        @media screen and (max-width: 960px){
            #search-container{
                margin-top: 100px !important;
            }
            .search-select{
                margin-top: 16px !important;
                width: 100% !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .search-submit{
                width: 100% !important;
            }
            .search-submit{
                display: block !important;
            }
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black !important;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: black !important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: black !important;
        }

        #default-select .nice-select .list{
            height: 250px;
            overflow: auto;
        }
    </style>
@endsection
<form action="{{route('search.posts')}}" method="GET" role="search">

    <div class="input-group d-flex flex-row ">
        <div class="form-row col-12" style="width: 100% !important; padding:0 !important; margin:0 !important;">
            <div class="col-lg-4 col-12">
                <input name="q" id="q" placeholder="K&euml;rko postime" onfocus="this.placeholder = ''" onblur="this.placeholder = 'K&euml;rko postime'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" value="@if(isset($_GET['q'])){{$_GET['q']}}@endif" autocomplete="off" >
            </div>
            <div class="col-lg-4 col-12">
                <div class="input-group-icon search-select">
                    <div class="form-select" id="default-select">

                        <div class="icon"> <i class="fa fa-list" aria-hidden="true" style="margin-top: 15px"></i></div>
                        <select name="category" id="category">
                            <option value="" selected>T&euml; gjitha kategorit&euml;</option>
                            @foreach($allcategories as $category)
                                <option value="{{$category->slug}}" @if (isset($_GET['category'])){{$_GET['category'] == $category->slug ? 'selected' : ''}}@endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="input-group-icon search-select">
                    <div class="form-select" id="default-select">

                        <div class="icon"> <i class="fa fa-globe" aria-hidden="true" style="margin-top: 14px"></i></div>
                        <select name="city" id="city">
                            <option value="" selected>Gjith&euml; vendin</option>
                            @foreach($cities as $city)

                                <option value="{{$city->slug}}" @if (isset($_GET['city'])){{$_GET['city'] == $city->slug ? 'selected' : ''}}@endif>{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="input-group-icon search-select mt-3">
                    <div class="form-select">

                        <div class="icon"> <i class="fa fa-layer-group" aria-hidden="true" style="margin-top: 14px"></i></div>
                        <select name="order_by_price" id="order_by_price">
                            <option value="" selected>Rëndit sipas relevancës</option>
                            <option value="desc" @if (isset($_GET['order_by_price'])){{$_GET['order_by_price'] == 'desc' ? 'selected' : ''}}@endif>Rëndit sipas çmimit: të lartë deri tek të ulët</option>
                            <option value="asc" @if (isset($_GET['order_by_price'])){{$_GET['order_by_price'] == 'asc' ? 'selected' : ''}}@endif>Rëndit sipas çmimit: të ulët deri tek të lartë</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <button class="genric-btn primary mt-3 search-submit" style="width:50%;" type="submit" id="submit">Kërko</button>
            </div>
        </div>


        {{--                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>--}}
    </div>


</form>

