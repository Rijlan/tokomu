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
                    <h4 class="my-2">Transaction</h4>
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
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