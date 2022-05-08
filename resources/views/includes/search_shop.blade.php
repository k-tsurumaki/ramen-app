<div class="card mb-3">
    <div class="card-header">
        検索
    </div>
    <div class="card-body my-card-body">
        <form class="mb-2 mt-4" method="POST" action="{{ route('search_by_user_id') }}">
            @csrf
            <input type="hidden" name="search_user_id" value="{{ $shop_id }}"/>
            <h5>メニュー検索</h5>
            <div class="d-flex justify-content-center mb-3">
                <input type="search" class="form-control" name="search_shop" placeholder="メニュー名を入力" value="@if (isset($search_shop)) {{ $search_shop }} @endif">
            </div>
            <h5>投稿文検索</h5>
            <div class="d-flex justify-content-center mb-3">
                <input type="search" class="form-control" name="search_content" placeholder="キーワードを入力" value="@if (isset($search_content)) {{ $search_content }} @endif">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
