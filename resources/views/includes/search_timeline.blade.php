<div class="card mb-3">
    <div class="card-header">
        検索
    </div>
    <div class="card-body my-card-body">
        <form class="mb-2 mt-4" method="POST" action="{{ route('search') }}">
            @csrf
            <input type="hidden" name="search_user_id" value=""/>
            <h5>店名で検索</h5>
            <div class="d-flex justify-content-center mb-3">
                <input type="search" class="form-control" name="search_shop" placeholder="店名を入力" value="@if (isset($search_shop)) {{ $search_shop }} @endif">
            </div>
            <h5>投稿文で検索</h5>
            <div class="d-flex justify-content-center mb-3">
                <input type="search" class="form-control" name="search_content" placeholder="キーワードを入力" value="@if (isset($search_content)) {{ $search_content }} @endif">
            </div>
            <h5>種類で検索</h5>
            <select class="form-select mb-3" name="search_kind" aria-label="Default select example">
                <option value='0'>設定しない</option>
            @foreach ($menu_kind_list as $kind_number => $kind_name)
                <option value={{$kind_number+1}}>{{$kind_name}}</option>
            @endforeach
            </select>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
