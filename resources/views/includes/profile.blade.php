<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        プロフィール
    @if($user->id == Auth::id())
        <a href="{{ route('edit_profile') }}"><i class="fa-solid fa-user-gear"></i></a>
    @endif
    </div>
    <div class="card-body my-card-body">
        <div class="text-center">
            <h3>{{ $user->name }}</h3>
            <br>
            <img src="{{ '/storage/'.$user['image'] }}" alt="ユーザーアイコン" class="img-thumbnail icon">
        </div>
    </div>
</div>
