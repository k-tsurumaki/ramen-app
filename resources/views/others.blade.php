@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        @include('includes.search_home', ['user_id' => $user_id])
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                過去の投稿
                <a href="{{ route('create') }}"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($posts as $post)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ '/storage/'.$post['image'] }}" class="card-img-top" alt="ラーメン画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post['shop_name'] }}</h5>
                            <p class="card-text">{{ $post['content'] }}</p>
                            <a href="/edit/{{ $post['id'] }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile', ['user_id' => $user_id])
    </div>
</div>
@endsection
