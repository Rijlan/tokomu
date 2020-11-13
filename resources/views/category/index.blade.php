@extends('layouts.main')


@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <h4 class="center">Category</h4>
    <div class="row">
        <div class="col s12 m10 l8">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                @foreach($categories as $key => $category)
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category }}</td>
                            <td class="center">
                                <a href="#editCategory{{ $category->id }}" class="modal-trigger">
                                    <button><i class="material-icons">edit</i></button>
                                </a>
                                <form action="/category/{{ $category->id }}" style="display: inline-block;"
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

                    <div class="modal" id="editCategory{{ $category->id }}">
                        <div class="modal-content">
                            <h4>Edit Category</h4>
                            <form action="/category/{{ $category->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="category">Category</label>
                                <input type="text" name="category" id="category" required value="{{ $category->category }}" />
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

    <a href="#addCategory" class="btn green waves-effect waves-light modal-trigger">Add Category</a>

    <div class="modal" id="addCategory">
        <div class="modal-content">
            <h4>Add Category</h4>
            <form action="/category" method="post">
                @csrf
                <label for="category">Category</label>
                <input type="text" name="category" id="category" required />
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn green">Save</button>
            </form>
            <a href="#" class="modal-close btn orange">Close</a>
        </div>
    </div>
    @endsection
</div>
