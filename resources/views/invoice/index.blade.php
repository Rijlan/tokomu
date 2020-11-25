@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Invoice</h4>
    <div class="row">
        <div class="col s12 m12 l12">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction</th>
                        <th>Receipt</th>
                        <th>Delivery Service</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                @foreach($invoices as $key => $invoice)
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $invoice->transaction_id }}</td>
                            <td>{{ $invoice->receipt }}</td>
                            <td>{{ $invoice->delivery_service }}</td>
                            <td class="center">
                                <form action="/invoice/{{ $invoice->id }}" style="display: inline-block;"
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
