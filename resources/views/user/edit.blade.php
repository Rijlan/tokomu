@extends('layouts.main')

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="container">
    <div class="row">
    <form class="col s6" action="/user/{{$users->id}}" method="POST">
            @csrf
            @method('PUT')
            <h3>Tambah User</h3>
            <div class="input-field col s12">
                <input id="name" type="text" class="validate" name="name" value="{{$users->name}}">
                <label for="name">Name</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="email" class="validate" name="email" value="{{$users->email}}">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" class="validate" name="password">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
                <select name="role">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="999">Super Admin</option>
                  <option value="2">Seller</option>
                  <option value="3">Buyer</option>
                </select>
            </div>
            <button type="submit" class="btn blue" name="submit">Kirim</button>
        </form>
    </div>
</div>
@endsection
