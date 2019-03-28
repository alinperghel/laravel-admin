@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">

                    <div class="module-actions">
                        <div class="row">
                            <div class ="col-md-6">
                                <a class="btn btn-success" href="{{ route('users.create') }}">
                                    {{ __('Add User') }}
                                </a>
                            </div>
                            <div class ="col-md-6">
                                <div class="form-group row">
                                    <label for="search" class="col-md-4 col-form-label text-md-right">{{ __('Live Search') }}</label>
                                    <div class="col-md-6">
                                        <input id="search" type="text" class="form-control" name="search" value="" autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users">
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td><a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user->id ])}}">
                                        {{ __('Edit') }}</a>
                                    <a class="btn btn-danger delete-user" data-id="{{$user->id}}" data-token="{{csrf_token()}}" href="{{ route('users.destroy', ['user' => $user->id ])}}">
                                        {{ __('Delete') }}</a>
                                    @if($user->email_verified_at)
                                    <a class="btn btn-warning unverify-user" href="{{ route('users.unverify', ['user' => $user->id ])}}">
                                        {{ __('Unverify') }}</a>
                                    @else
                                    <a class="btn btn-success verify-user" href="{{ route('users.verify', ['user' => $user->id ])}}">
                                        {{ __('Verify') }}</a>
                                    @endif
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

        // search
        $('#search').on('keyup', function () {
            var filter = $(this).val();
            var url = "{{ url('users/search') }}";
            
            $('#users').empty();
            $.get(url, {'filter': filter}, function (data) {
                //console.log(filter);
                if (data != 0) {
                    $('#users').append(data);
                }else{
                    $('#users').append("<tr><td colspan=\"4\">No users matching search filter</td></tr>");
                }

            });

        });

        // delete user
        $('.delete-user').click(function (e) {
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
                            }
                        }
                    });
        });//end delete user

        //verify user
        $(document).on('click', '.verify-user', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var button = $(this);
            var parent_object = $(this).parent();

            $.get(url, function (data) {
                button.hide();
                button.replaceWith("<a class=\"btn btn-warning unverify-user\" href=\"" + data + "\">{{ __('Unverify') }}</a>");
            });
        });

        //verify user
        $(document).on('click', '.unverify-user', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var button = $(this);
            var parent_object = $(this).parent();

            $.get(url, function (data) {
                button.hide();
                button.replaceWith("<a class=\"btn btn-success verify-user\" href=\"" + data + "\">{{ __('Verify') }}</a>");
            });
        });

    });
</script>
@endsection
