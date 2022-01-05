@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card" style="">
            <div class="card-header">
                <h2>Add User</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb me-4">
                    <div class="float-end mt-2 me-4">
                        <a class="btn btn-success" href="{{ route('users.index') }}"> Back to list</a>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
                class="form-inline col-12 mx-auto px-2 ps-4 mt-5">
                @csrf
                <div class="row">
                    <div class="row mb-3">

                        <label class="col-sm-2 col-form-label" for="name"><strong>Name:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control"
                                placeholder="Name">
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="email"><strong>Email:</strong></label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control"
                                placeholder="Email">
                            @error('email')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <br>
                <br>
                <div class="col-lg-12 margin-tb">
                    <div class="float-end">
                        <button type="submit" class="btn btn-success float-end px-4 mb-2 me-4 ">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
