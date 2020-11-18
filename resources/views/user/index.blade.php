@extends('layouts.main')

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="container">
    <h4 class="center">User</h4>
    <div class="row">
        <div class="col s12 m10 l8">
            <table>
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
                                    <button><i class="material-icons">edit</i></button>
                                </a>
                                <form action="/user/{{ $user->id }}" style="display: inline-block;"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>

                    <div class="modal" id="editUser{{ $user->id }}">
                        <div class="modal-content">
                            <h4>Edit</h4>
                            <form action="/edit/{{ $user->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="user">User</label>
                                <input type="text" name="user" id="user" required value="{{ $user->user }}" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn green">Update</button>
                            </form>
                            <a href="#" class="modal-close btn orange">Close</a>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
    </div>

    <a href="/user/create" class="btn green waves-effect waves-light">Add User</a>
</div>
@endsection
