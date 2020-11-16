@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Shop</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Shop Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Owner</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                @foreach($shops as $key => $shop)
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ $shop->description }}</td>
                            <td><img src="{{ asset('uploads/shops') }}/{{ $shop->image }}" alt="{{ $shop->image }}" width="80px"></td>
                            <td>{{ $shop->shop_name }}</td>
                            <td class="center">
                                <form action="/shop/{{ $shop->id }}" style="display: inline-block;"
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
