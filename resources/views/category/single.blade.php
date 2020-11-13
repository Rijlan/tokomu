@extends('layouts.main')

@section('content')
<div class="container mt-3">
    <div class="card">
        <h2>{{ $artikels->penulis }}</h2>
        <h1>{{ $artikels->tema }}</h1>
        <p>{{ $artikels->subjek }}</p>
        
        <div class="row col mb-2 mr-1">
            <a href="/artikel/{{ $artikels->id}}/edit" class="mr-1 btn btn-sm btn-success ">Edit</a>
            <form action="/artikel/{{$artikels->id}}" method="post">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="btn btn-sm btn-danger mr-1">Hapus</button>
            </form>
            <a href="/artikel" class="btn btn-sm btn-info"> << </a>
        </div>
    </div>
</div>
@endsection    