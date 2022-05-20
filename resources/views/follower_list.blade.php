@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                フォロワー({{ $followers->total() }})
            </div>
            <div class="card-body my-card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($followers as $follower)
                    <h2><a href="/others/{{$follower['id']}}" class="card-text">{{ $follower->name }}</a></h2>
                    <!-- フォロー取消用ボタンを表示 -->
                @if($follower->followers()->where('following_user_id', Auth::id())->exists())
                    <div class="text-center"><a href="{{ route('unfollowing', $follower) }}" class="btn btn-dark">フォローをはずす</a></div>
                @else
                    <!-- まだユーザーがフォローをしていなければ、フォローボタンを表示 -->
                    <div class="text-center"><a href="{{ route('following', $follower) }}" class="btn btn-primary">フォローする</a></div>
                @endif
                @endforeach
                </div>
                <div class='paginate mt-3'>
                    {{ $followers->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@if(true)
    <div class="col-md-3">
        @include('includes.profile', ['user' => $user])
    </div>
@endif
</div>
@endsection
