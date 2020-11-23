@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Shop Detail</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
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
