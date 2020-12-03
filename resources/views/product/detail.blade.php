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
                                    <img src="{{$product->image}}" alt="{{$product->image}}">
                                </div>
                                <div class="card-content">
                                    <p>Product : {{$product->product_name}}</p>
                                    <p>Description : {{$product->description}}</p>
                                    <p>Price : {{$product->price}}</p>
                                    <p>Category : {{$product->category->category}}</p>
                                    <p>Shop : {{$product->shop->shop_name}}</p>
                                    <p>Stock : {{$product->stock}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
