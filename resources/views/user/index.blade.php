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
                <div class="col-md-10">
                    <h4 class="my-2">User</h4>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            @foreach($users as $key => $user)
                                <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="center">
                                            <a href="/user/{{ $user->id }}/edit" >
                                                <button><i class="fa fa-lg fa-pencil-square-o mr-1"></i></button>
                                            </a>
                                            <form action="/user/{{ $user->id }}" style="display: inline-block;"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('Anda Yakin ???');">
                                                    <i class="fa fa-lg fa-trash ml-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            <a href="/user/create" class="btn btn-success">Add User</a>
        </div>
    </div>
</div>
@endsection

