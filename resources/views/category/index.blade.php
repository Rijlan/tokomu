@extends('layouts.main')


@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container mt-4">
    <div class="jumbotron  mb-2 bg-success text-dark">
    <h1 class="d-flex justify-content-center">Halaman Katogeri</h1>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col card mb-1 ml-1 mr-1">
                    <div class="card-body">
                        <h4><strong>{{ $category->category }}</strong></h4>
                        <a href="/category/{{ $category->category }}" class="btn btn-warning btn-sm stretched-link">Baca</a>
                    </div>
                </div>
            @endforeach
        </div>
@endsection