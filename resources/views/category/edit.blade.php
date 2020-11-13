@extends('layouts.main')

@section('content')
    <h3>Halaman Edit Kategori</h3>


    <form action="/category/{{$categories->id}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" class="form-control  @error('category') is-invalid @enderror" id="category"  placeholder="Nama category" name="category" value="{{ old('category') ? old('category') : $categories->category }}">
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim!</button>
    </form>

@endsection    
