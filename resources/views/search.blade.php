@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                検索結果
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($search_results as $search_result)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ '/storage/'.$search_result['image'] }}" class="card-img-top" alt="ラーメン画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $search_result['shop'] }}</h5>
                            <p class="card-text">{{ $search_result['content'] }}</p>
                            <a href="/detail_post/{{ $search_result['id'] }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile')
    </div>
</div>
@endsection
