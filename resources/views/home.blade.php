@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        @include('includes.search')
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                過去の投稿
                <a href="{{ route('create') }}"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
            @foreach($posts as $post)
                <a href="/edit/{{ $post['id'] }}" class="card-text d-block">{{ $post['content'] }}</a>
                <img src="{{ '/storage/'.$post['image'] }}" style="width:50%;" class='img-fluid mx-auto d-block mb-3'/>
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile')
    </div>
</div>
@endsection
