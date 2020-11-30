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
                <form class="col s6" action="/user" method="POST">
                    @csrf
                    <h3>Tambah User</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="username@example.com" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                    <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
