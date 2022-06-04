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
            <img src="{{ $user['image'] }}" alt="アイコンは設定されていません" class="img-thumbnail icon">
        </div>
        <div class="mb-5 row text-center">
            <div class="dropdown col-sm-6 mb-3">
                <div class="text-right"><a href="{{ route('following_list', $user) }}" class="btn btn-secondary button">フォロー　{{ $user->follows->count() }}</a></div>
            </div>
            <div class="dropdown col-sm-6 mb-3">
                <div class="text-left"><a href="{{ route('follower_list', $user) }}" class="btn btn-secondary button">フォロワー　{{ $user->followers->count() }}</a></div>
            </div>            
        </div>
    @if($user->id == Auth::id() && $user->is_owner===1)
        <div class="text-center mb-3"><a href="/shop/{{ $user->shop->id }}"  class="btn btn-primary">お店のページ</a></div>
    @endif
    @if($user->id == Auth::id())
        <div class="text-center mb-3"><a href="{{ route('liked_posts') }}" class="btn btn-primary">いいねした投稿を見る</a></div>
    @elseif($user->followers()->where('following_user_id', Auth::id())->exists())
    <!-- フォロー取消用ボタンを表示 -->
        <div class="text-center mb-3"><a href="{{ route('unfollowing', $user) }}" class="btn btn-dark">フォローをはずす</a></div>
    @else
    <!-- まだユーザーがフォローをしていなければ、フォローボタンを表示 -->
        <div class="text-center mb-3"><a href="{{ route('following', $user) }}" class="btn btn-primary">フォローする</a></div>
    @endif
    </div>
</div>
