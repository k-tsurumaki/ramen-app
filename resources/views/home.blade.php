@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        @include('includes.search')
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                過去の投稿
            </div>
            <div class="card-body">
            @foreach($posts as $post)
                <a href="/edit/{{ $post['id'] }}" class="card-text d-block">{{ $post['content'] }}</a>
                <img src="{{ '/storage/'.$post['image'] }}" class='w-10 mb-3'/>
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile')
    </div>
</div>
@endsection
