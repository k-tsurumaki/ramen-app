<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        プロフィール
    @if($user->id == Auth::id())
        <a href="{{ route('edit_profile') }}"><i class="fa-solid fa-user-gear"></i></a>
    @endif
    </div>
    <div class="card-body my-card-body">
        <div class="text-center mb-3">
            <h3>{{ $user->name }}</h3>
            <br>
            <img src="{{ '/storage/'.$user['image'] }}" alt="ユーザーアイコン" class="img-thumbnail icon">
        </div>
    @if($user->id == Auth::id())
        <div class="text-center"><a href="{{ route('liked_posts') }}" class="btn btn-primary">いいねした投稿を見る</a></div>
    @elseif($user->followers()->where('following_user_id', Auth::id())->exists())
    <!-- フォロー取消用ボタンを表示 -->
        <div class="text-center"><a href="{{ route('unfollowing', $user) }}" class="btn btn-dark">フォローをはずす</a></div>
    @else
    <!-- まだユーザーがフォローをしていなければ、「いいね」ボタンを表示 -->
        <div class="text-center"><a href="{{ route('following', $user) }}" class="btn btn-primary">フォローする</a></div>
    @endif
    </div>
</div>
