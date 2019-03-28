@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Terms</div>
                <div class="card-body">

                    <div class="module-actions">
                        <div class="row">
                            <div class ="col-md-12">
                                <a class="btn btn-success" href="{{ route('terms.create') }}">
                                    {{ __('Add Term') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @if(Session::has('alert'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-{{Session::get('alert.class')}} alert-dismissible fade show" role="alert">
                                <strong>{{Session::get('alert.class')}}!</strong> {{Session::get('alert.message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publication</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="terms">
                            @foreach ($terms as $term)
                            <tr>
                                <th scope="row">{{ $term->id }}</th>
                                <td>{{ $term->name }}</td>
                                <td>{{ $term->getUserName() }}</td>
                                @if($term->published_at)
                                <td>{{ $term->published_at }}</td>
                                @else
                                <td>{{ __('Unpublished') }}</td>
                                @endif
                                <td><a class="btn btn-primary" href="{{ route('terms.edit', ['term' => $term->id ])}}">
                                        {{ __('Edit') }}</a>
                                    <a class="btn btn-danger delete-term" data-id="{{$term->id}}" data-token="{{csrf_token()}}" href="{{ route('terms.destroy', ['term' => $term->id ])}}">
                                        {{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
<script>
    $(document).ready(function () {

        // delete term
        $('.delete-term').click(function (e) {
            e.preventDefault();
            var row = $(this).parent().parent();
            var url = $(this).attr('href');
            var id = $(this).data("id");
            var token = $(this).data("token");
            $.ajax(
                    {
                        url: url,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function (resp)
                        {
                            if (resp == true) {
                                //var row = button.parentElement.parentElement;
                                row.fadeOut("normal", function () {
                                    $(this).remove();
                                });
                            }else{
                                window.location.reload()
                            }
                        }
                    });
        });//end delete term
    });
</script>
@endsection
