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
                <div class="col-md-12">
                    <h4 class="my-2">Shop</h4>
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Shop</th>
                                    <th>Owner</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($shops as $key => $shop)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $shop->shop_name }}</td>
                                        <td>{{ $shop->owner->name }}</td>
                                        <td class="center">
                                            <a href="/shop/{{ $shop->id }}">
                                                <button><i class="fa fa-lg fa-eye mr-1"></i></button>
                                            </a>
                                            <form action="/shop/{{ $shop->id }}" style="display: inline-block;"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('Anda Yakin ???');">
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