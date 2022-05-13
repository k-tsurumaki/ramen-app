@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                いいねした投稿
            </div>
            <div class="card-body my-card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($liked_posts as $liked_post)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ '/storage/'.$liked_post['image'] }}" class="card-img-top img" alt="ラーメン画像">
                        <div class="card-body">
                            <a href="/shop/{{ $liked_post['shop_id'] }}" class="card-title"><h5 class="card-title">{{ $liked_post->shop->name }}</h5></a>
                            <a href="/others/{{$liked_post['user_id']}}" class="card-text">{{ $liked_post->user->name }}</a>
                            <p class="card-text elipsis">{{ $liked_post['content'] }}</p>
                            <a href="/detail_post/{{ $liked_post['id'] }}" class="btn btn-primary">詳細を見る</a>
                            <span class="text-right">
                            <i class="fa-solid fa-heart like"></i>
                            
                            <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                            @if($liked_post->likes()->where('user_id', Auth::id())->exists())
                            <!-- 「いいね」取消用ボタンを表示 -->
                                <a href="{{ route('unlike', $liked_post) }}" class="btn btn-success btn-sm">
                                    いいね
                                    <!-- 「いいね」の数を表示 -->
                                    <span class="badge">
                                        {{ $liked_post->likes->count() }}
                                    </span>
                                </a>
                            @else
                            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                <a href="{{ route('like', $liked_post) }}" class="btn btn-secondary btn-sm">
                                    いいね
                                    <!-- 「いいね」の数を表示 -->
                                    <span class="badge">
                                        {{ $liked_post->likes->count() }}
                                    </span>
                                </a>
                            @endif
                            </span>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class='paginate mt-3'>
                    {{ $liked_posts->appends(request()->input())->links() }}
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
