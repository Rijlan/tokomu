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
                    <h2 class="my-2">Invoice</h2>
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
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
