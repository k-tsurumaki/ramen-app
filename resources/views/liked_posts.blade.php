@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                いいねした投稿({{ $liked_posts->total() }})
            </div>
            <div class="card-body my-card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($liked_posts as $liked_post)
                    <div class="card" style="width: 18.7rem;">
                        <img src="{{ $liked_post['image'] }}" class="card-img-top img" alt="ラーメン画像">
                        <div class="card-body">
                            <a href="/shop/{{ $liked_post['shop_id'] }}" class="card-title"><h5 class="card-title">{{ $liked_post->shop->name }}</h5></a>
                            <div class="row">
                            @if($liked_post['user_id']==Auth::user()->id)
                                <a href="/home" class="card-text col">{{ $liked_post->user->name }}</a>
                            @else
                                <a href="/others/{{$liked_post['user_id']}}" class="card-text col">{{ $liked_post->user->name }}</a>
                            @endif
                                <h6 class="col-7 mt-1">{{ $liked_post->created_at->format('Y年m月d日') }}</h6>
                            </div>
                            <p class="card-text elipsis">{{ $liked_post['content'] }}</p>
                            <a href="/detail_post/{{ $liked_post['id'] }}" class="btn btn-primary">詳細を見る</a>
                            <span>
                                <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                                @if($liked_post->likes()->where('user_id', Auth::id())->exists())
                                <!-- 「いいね」取消用ボタンを表示 -->
                                    <a href="{{ route('unlike', $liked_post) }}"><i class="fa-solid fa-heart liked"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $liked_post->likes->count() }}
                                @else
                                <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                    <a href="{{ route('like', $liked_post) }}"><i class="fa-solid fa-heart like"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $liked_post->likes->count() }}
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
@if(true)
    <div class="col-md-3">
        @include('includes.profile', ['user' => Auth::user()])
    </div>
@endif
</div>
@endsection
