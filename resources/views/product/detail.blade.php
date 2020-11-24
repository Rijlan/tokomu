@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
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
@endsection
