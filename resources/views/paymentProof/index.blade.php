@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Payment Proof</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
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
