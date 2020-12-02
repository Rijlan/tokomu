@extends('layouts.main')


@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tambah Kategori</h3>
                        </div>
                        <div class="card-body">
                            <form action="/category" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" name="category" id="category" required>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection