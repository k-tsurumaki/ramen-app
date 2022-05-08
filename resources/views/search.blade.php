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
                        <img src="{{ '/storage/'.$search_result['image'] }}" class="card-img-top img" alt="ラーメン画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $search_result['shop_name'] }}</h5>
                            <a href="/others/{{$search_result['user_id']}}" class="card-text">{{ $search_result['user_name'] }}</a>
                            <p class="card-text elipsis">{{ $search_result['content'] }}</p>
                            <a href="/detail_post/{{ $search_result['id'] }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@if(isset($search_user_result))
    <div class="col-md-3">
        @include('includes.profile', ['user' => $search_user_result])
    </div>
@endif
</div>
@endsection
