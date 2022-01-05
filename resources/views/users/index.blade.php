@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Users</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right mb-2 mt-2">
                                <a class="btn btn-success" href="{{ route('users.create') }}"> Add New</a>
                            </div>

                        </div>

                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered px-2">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                        method="Post">
                                        <a class="btn btn-warning" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal"
                                            data-attr="{{ route('users.show', $user->id) }}"
                                            title="show">Show</a>
                                        <a class="btn btn-primary"
                                            href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true" class="opacity-5 bg-success modal-overlay" >
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="
            background: rgba(0, 0, 0, .2);color:white;">
                <div >
                    <button type="button" class="btn-close float-end btn-danger" data-bs-dismiss="modal" aria-label="Close" style="color: #fff!important;background-color: #dc3545!important;border-color: #dc3545!important;opacity: 0.5!important;">

                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
        <script  type="text/javascript">
            // display a modal (medium modal)
            $(document).on('click', '#mediumButton', function(event) {

                event.preventDefault();
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    // return the result
                    success: function(result) {

                        console.log(result);
                        var json = JSON.parse(result);

                        var resultHtml ='<h1>'+json["name"]+'</h1><hr/>'+
                        '<table class="table table-dark table-bordered table-striped table-hover">'+
                            '<tr><td>'+'ID'+'</td><td>'+json["id"]+'</td></tr>'+
                            '<tr><td>'+'Name'+'</td><td>'+json["name"]+'</td></tr>'+
                            '<tr><td>'+'Email'+'</td><td>'+json["email"]+'</td></tr>'+
                        '</table>';
                        $('#mediumModal').modal("show");
                        $('#mediumBody').html(resultHtml).show();
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });
        </script>
    @endpush

@endsection
