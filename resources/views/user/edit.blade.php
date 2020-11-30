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
                <form class="col s6" action="/user/{{$users->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3>Edit User</h3>
                    <div class="form-group">
                        <input id="name" type="text" class="form-control" name="name" value="{{$users->name}}">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control" name="email" value="{{$users->email}}">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-md">
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
