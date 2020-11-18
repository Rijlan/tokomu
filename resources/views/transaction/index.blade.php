@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Transaction</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Buying</th>
                        <th>Buyer</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>status</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                @foreach($transactions as $key => $transaction)
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $transaction->product->product_name }}</td>
                            <td>{{ $transaction->buying->product_name }}</td>
                            <td>{{ $transaction->buyer->name}}</td>
                            <td>{{ $transaction->qty }}</td>
                            <td>{{ $transaction->total }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td class="center">
                                <form action="/transaction/{{ $transaction->id }}" style="display: inline-block;"
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