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
                    <h2 class="my-2">Payment Proof</h2>
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaction</th>
                                    <th>Image</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($paymentProofs as $key => $paymentProof)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $paymentProof->transaction_id }}</td>
                                        <td><img src="{{ $paymentProof->image }}" alt="{{ $paymentProof->image }}" width="80px"></td>
                                        <td class="center">
                                            <form action="/paymentProof/{{ $paymentProof->id }}" style="display: inline-block;"
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
