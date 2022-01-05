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
                        <tr>
                            <th>User ID</th>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->userId }}</td>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                                <td>
                                    <a class="btn btn-warning" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal"
                                            data-attr="{{ route('posts.show', $post->id) }}"
                                            title="show">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{-- {!! $posts->links('pagination::bootstrap-4') !!} --}}
                </div>
            </div>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true" class="opacity-20 bg-success modal-overlay" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="
            background: rgba(0, 0, 0, .5);color:white;">
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: href,
                    type: 'GET',
                    headers: {
                    'Access-Control-Allow-Origin': 'http://localhost'
                    },
                    "_token": "{{ csrf_token() }}",
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    dataType: "json",
                    cache: false,
                    crossDomain: false,
                    // return the result
                    success: function(result) {

                        var resultHtml ='<h1>'+result["title"]+'</h1><hr/>'+
                        '<table class="table table-dark table-bordered table-striped table-hover">'+
                            '<tr><td>'+'User ID'+'</td><td>'+result["userId"]+'</td></tr>'+
                            '<tr><td>'+'Post ID'+'</td><td>'+result["id"]+'</td></tr>'+
                            '<tr><td>'+'Title'+'</td><td>'+result["title"]+'</td></tr>'+
                            '<tr><td>'+'Body'+'</td><td>'+result["body"]+'</td></tr>'+
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
