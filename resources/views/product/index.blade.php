@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Product</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>category</th>
                        <th>shop</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                @foreach($products as $key => $product)
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category->category }}</td>
                            <td>{{ $product->shop->shop_name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td><img src="{{ $product->image }}" alt="{{ $product->image }}" width="80px"></td>
                            <td class="center">
                                <form action="/product/{{ $product->id }}" style="display: inline-block;"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn red" onclick="return confirm('Anda Yakin ?');">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    @endsection
</div>
