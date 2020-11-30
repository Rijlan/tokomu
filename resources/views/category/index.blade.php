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
                <div class="col-md-6">
                    <h2 class="my-2">Category</h2>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($categories as $key => $category)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td class="center">
                                            <a href="/category/{{ $category->id }}/edit">
                                                <button><i class="fa fa-lg fa-pencil-square-o mr-1"></i></button>
                                            </a>
                                            <form action="/category/{{ $category->id }}" style="display: inline-block;"
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
                    <a href="/category/create">
                        <button class="btn btn-success">Tambah</button>
                    </a>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection