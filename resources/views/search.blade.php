@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                検索結果({{ $search_results->total() }})
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
                            <span>
                                <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                                @if($search_result->likes()->where('user_id', Auth::id())->exists())
                                <!-- 「いいね」取消用ボタンを表示 -->
                                    <a href="{{ route('unlike', $search_result) }}"><i class="fa-solid fa-heart liked"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $search_result->likes->count() }}
                                @else
                                <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                    <a href="{{ route('like', $search_result) }}"><i class="fa-solid fa-heart like"></i></a>
                                    <!-- 「いいね」の数を表示 -->
                                    {{ $search_result->likes->count() }}
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
