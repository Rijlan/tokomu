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
                <div class="col-md-11">
                    <h4 class="my-2">Product</h4>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>category</th>
                                    <th>Stock</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($products as $key => $product)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->category->category }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td class="center">
                                            <a href="/product/{{ $product->id }}">
                                                <button class="btn black"><i class="fa fa-lg fa-eye mr-1"></i></button>
                                            </a>
                                            <form action="/product/{{ $product->id }}" style="display: inline-block;"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn red" onclick="return confirm('Anda Yakin ?');">
                                                    <i class="fa fa-lg fa-trash ml-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
