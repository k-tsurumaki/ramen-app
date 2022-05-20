<div class="card mb-3">
    <div class="card-header">
        検索
    </div>
    <div class="card-body my-card-body">
        <form class="mb-2 mt-4" method="POST" action="{{ route('search_in_shop_page') }}">
            @csrf
            <input type="hidden" name="search_shop_id" value="{{ $shop['id'] }}"/>
            <h5>メニュー検索</h5>
            <div class="d-flex justify-content-center mb-3">
                <input type="search" class="form-control" name="search_menu" placeholder="メニュー名を入力" value="@if (isset($search_menu)) {{ $search_menu }} @endif">
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
