@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Terms of Service') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{$term->content}}
                            <hr>
                            Published date: {{$term->published_at}}
                            @if(count($old_terms)> 0)
                            <hr>
                            Terms History:<br>
                            @foreach($old_terms as $old_term)
                            <a href="{{route('tos.history', ['{id}'=> $old_term->id])}}"> {{$old_term->published_at}} </a> <br>
                            @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
