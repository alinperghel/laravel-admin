@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Update Term : ') . $term->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('terms.update', ['term'=>$term->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf
                        @include('terms/_form', ['term'=> $term])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection