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
                    <h4 class="my-2">Shop Detail</h4>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Shop</th>
                                    <th>Nama Rekening</th>
                                    <th>No Rekening</th>
                                    <th>Nama Bank</th>
                                    <th>Kode Bank</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($shopDetails as $key => $shopDetail)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $shopDetail->shop_id }}</td>
                                        <td>{{ $shopDetail->nama_rekening }}</td>
                                        <td>{{ $shopDetail->no_rekening }}</td>
                                        <td>{{ $shopDetail->nama_bank }}</td>
                                        <td>{{ $shopDetail->kode_bank }}</td>
                                        <td class="center">
                                            <form action="/shopDetail/{{ $shopDetail->id }}" style="display: inline-block;"
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