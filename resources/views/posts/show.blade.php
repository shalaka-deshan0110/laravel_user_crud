@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Posts</h2>
                </div>
                <div class="card-body">
                    <div class="row">

                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                        <table class="table table-bordered px-2">
                            @foreach ($post as $key=>$val)
                            <tr>
                                <td>{{$key}}</td><td>{{$val}}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
