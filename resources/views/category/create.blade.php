@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Halaman Tambah Kategori</h3>


    <form action="{{ url('/category') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" class="form-control  @error('category') is-invalid @enderror" id="category"  placeholder="Nama category" name="category" value="{{ old('category') }}">
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
       
        <button type="submit" class="btn btn-primary">Create!</button>
    </form>
</div>
@endsection    
