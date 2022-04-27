@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        @include('includes.search')
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                検索結果
            </div>
            <div class="card-body">
            @foreach($search_results as $search_result)
                <a href="/edit/{{ $search_result['id'] }}" class="card-text d-block">{{ $search_result['content'] }}</a>
                <img src="{{ '/storage/'.$search_result['image'] }}" style="width:50%;" class='img-fluid mx-auto d-block mb-3'/>
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile')
    </div>
</div>
@endsection
