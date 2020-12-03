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
                    <form action="/user" method="POST">
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
                            <select name="role" class="form-control">
                            <option value="" disabled selected>Choose your option</option>
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
@endsection
                                            