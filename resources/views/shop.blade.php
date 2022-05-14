@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        @include('includes.search_shop', ['shop_id' => $shop->id ])
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                過去の投稿
            </div>
            <div class="card-body my-card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($posts as $post)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ '/storage/'.$post['image'] }}" class="card-img-top img" alt="ラーメン画像">
                        <div class="card-body">
                            <a href="/others/{{$post['user_id']}}" class="card-text">{{ $post->user->name }}</a>
                            <p class="card-text elipsis">{{ $post['content'] }}</p>
                            <a href="/detail_post/{{ $post['id'] }}" class="btn btn-primary">詳細を見る</a>
                            <span>
                                <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                                @if($post->likes()->where('user_id', Auth::id())->exists())
                                <!-- 「いいね」取消用ボタンを表示 -->
                                    <a href="{{ route('unlike', $post) }}"><i class="fa-solid fa-heart liked"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $post->likes->count() }}
                                @else
                                <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                    <a href="{{ route('like', $post) }}"><i class="fa-solid fa-heart like"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $post->likes->count() }}
                                @endif
                            </span>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class='paginate mt-3'>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('includes.profile_shop', ['shop' => $shop])
    </div>
</div>
@endsection
