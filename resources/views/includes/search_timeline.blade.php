<div class="card mb-3">
    <div class="card-header">
        検索
    </div>
    <div class="card-body my-card-body">
        <form class="mb-2 mt-4" method="POST" action="{{ route('search') }}">
            @csrf
            <input type="hidden" name="search_user_id" value=""/>
            <h5>店名で検索</h5>
            <div class="d-flex justify-content-center mb-4">
                <input type="search" class="form-control" name="search_shop" placeholder="店名を入力" value="@if (isset($search_shop)) {{ $search_shop }} @endif">
            </div>
            <h5>投稿文で検索</h5>
            <div class="d-flex justify-content-center mb-4">
                <input type="search" class="form-control" name="search_content" placeholder="キーワードを入力" value="@if (isset($search_content)) {{ $search_content }} @endif">
            </div>
            <h5>種類で検索</h5>
            <select class="form-select mb-4" name="search_kind" aria-label="Default select example">
                <option value='0'>設定しない</option>
            @foreach ($menu_kind_list as $kind_number => $kind_name)
                <option value={{$kind_number+1}}>{{$kind_name}}</option>
            @endforeach
            </select>
            <h5>ラーメンについて</h5>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">味の濃さ</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="intensity" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="intensity_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">麺の太さ</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="thickness" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="thickness_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">値段</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="price_value" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="price_value_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">見た目</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="look" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="look_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">総合評価</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="all" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="all_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <h5>店について</h5>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">雰囲気</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="atmosphere" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="atmosphere_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">提供スピード</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="speed" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="speed_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">接客</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="hospitality" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="hospitality_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-auto">
                    <p class="form-control-plaintext">アクセス</p>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="access" aria-label="Default select example">
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select mb-2" name="access_limit" aria-label="Default select example">
                        <option value='1'>以上</option>
                        <option value='2'>以下</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
