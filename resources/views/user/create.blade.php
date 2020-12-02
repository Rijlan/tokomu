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
            <div class="row m-t-30">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tambah User</h3>
                        </div>
                        <div class="card-body">
                            <form action="/user" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <select name="role" class="form-control">
                                        <option value="" disabled selected>Choose Your Options</option>
                                        <option value="999">Super Admin</option>
                                        <option value="2">Seller</option>
                                        <option value="3">Buyer</option>
                                      </select>
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

{{-- <form action="/user" method="POST">
    <h3>Tambah User</h3>
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" placeholder="Your Name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>createUser
        <input type="email" class="form-control" name="email" placeholder="username@example.com">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <select class="form-control">
        <option value="" disabled selected>Choose your option</option>
        <option value="999">Super Admin</option>
        <option value="2">Seller</option>
        <option value="3">Buyer</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Simpan</button>
</form> --}}