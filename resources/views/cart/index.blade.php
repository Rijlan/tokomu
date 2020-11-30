@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="my-2">Cart</h4>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Owner</th>
                                    <th>Quantity</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($carts as $key => $cart)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $cart->product->product_name }}</td>
                                        <td>{{ $cart->user->name }}</td>
                                        <td>{{ $cart->qty }}</td>
                                        <td class="center">
                                            <form action="/cart/{{ $cart->id }}" style="display: inline-block;"
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