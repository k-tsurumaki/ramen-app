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
            <div class="card-body my-card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($search_results as $search_result)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ '/storage/'.$search_result['image'] }}" class="card-img-top img" alt="ラーメン画像">
                        <div class="card-body">
                            <a href="/shop/{{ $search_result['shop_id'] }}" class="card-title"><h5 class="card-title">{{ $search_result->shop->name }}</h5></a>
                            <a href="/others/{{$search_result['user_id']}}" class="card-text">{{ $search_result->user->name }}</a>
                            <p class="card-text elipsis">{{ $search_result['content'] }}</p>
                            <a href="/detail_post/{{ $search_result['id'] }}" class="btn btn-primary">詳細を見る</a>
                            <span class="text-right">
                            <i class="fa-solid fa-heart like"></i>
                            
                            <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                            @if($post->likes()->where('user_id', Auth::id())->exists())
                            <!-- 「いいね」取消用ボタンを表示 -->
                                <a href="{{ route('unlike', $post) }}" class="btn btn-success btn-sm">
                                    いいね
                                    <!-- 「いいね」の数を表示 -->
                                    <span class="badge">
                                        {{ $post->likes->count() }}
                                    </span>
                                </a>
                            @else
                            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                <a href="{{ route('like', $post) }}" class="btn btn-secondary btn-sm">
                                    いいね
                                    <!-- 「いいね」の数を表示 -->
                                    <span class="badge">
                                        {{ $post->likes->count() }}
                                    </span>
                                </a>
                            @endif
                            </span>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class='paginate mt-3'>
                    {{ $search_results->appends(request()->input())->links() }}
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
