@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Terms Page') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('terms.store') }}">
                        <input name="_method" type="hidden" value="POST">
                        @csrf
                        @include('terms/_form', ['term'=>$term])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
