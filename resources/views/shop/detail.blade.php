@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="main-content">
    <div class="section__content section__content --p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive m-b-40">
                        <div class="card">
                            <div class="container">
                                <div class="card-image">
                                    <img src="{{$shop->image}}" alt="{{$shop->image}}">
                                </div>
                                <div class="card-content">
                                    <p>Shop         : {{$shop->shop_name}}</p>
                                    <p>Owner        : {{$shop->owner->name}}</p>
                                    <p>Description  : {{$shop->description}}</p>
                                </div>
                            </div>
                        </div>
                        @foreach ($shop->products as $product)
                        
                        <div class="card" style="width: 18rem;">
                            <img src="{{$product->image}}" class="card-img-top" alt="{{$product->image}}">
                            <div class="card-body">
                              <h5 class="card-title">{{ $product->product_name }}</h5>
                              <p class="card-text">{{$product->price}}</p>
                              <a href="/product/{{$product->id}}" class="btn btn-primary">Detail</a>
                            </div>
                          </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
