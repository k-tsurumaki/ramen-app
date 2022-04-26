@extends('layouts.app')

@section('content')
<div class="card  mx-auto" style="width: 33%;">
    <div class="card-header">
        編集
        <form class="card-body" action="{{ route('destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $edit_post['id'] }}"/>
            <button type="submit">削除</button>
        </form>
    </div>
    <form class="card-body" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $edit_post['id'] }}"/>
        <img src="{{ '/storage/'.$edit_post['image'] }}" class='img-fluid mb-3 mx-auto d-block'/>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="shop" placeholder="店名" value="{{ $shop_name }}"/>
        </div>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="menu" placeholder="メニュー名" value="{{ $menu_name }}"/>
        </div>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="price" placeholder="値段(円)" value="{{ $edit_post['price'] }}"/>
        </div>
        <div class="form-group mb-3" >
            <textarea class="form-control" name="content" rows="3" placeholder="本文を入力" >{{$edit_post['content']}}</textarea>
        </div>
        <select class="form-select mb-3" name="kind" aria-label="Default select example">
        @foreach ($menu_kind_list as $kind_number => $kind_name)
            <option value={{$kind_number}} {{ ($kind_number === $menu_kind_number) ? 'selected' : '' }}>{{$kind_name}}</option>
        @endforeach
        </select>
        <div>
            <h5>ラーメンについて</h5>
            <div class="mb-3 text-center">
                <p>味の濃さ</p>
                <p style="display:inline">あっさり</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="intensity" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['intensity']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">こってり</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>麺の太さ</p>
                <p style="display:inline">細い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thickness" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['thickness']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">太い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>値段</p>
                <p style="display:inline">安い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="price_value" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['price_value']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">高い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>見た目</p>
                <p style="display:inline">悪い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="look" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['look']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>総合評価</p>
                <p style="display:inline">悪い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="all" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['all']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>
        <div>
            <h5>店について</h5>
            <div class="mb-3 text-center">
                <p>雰囲気</p>
                <p style="display:inline">静か</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="atmosphere" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['atmosphere']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">にぎやか</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>接客</p>
                <p style="display:inline">悪い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hospitality" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['hospitality']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>アクセス</p>
                <p style="display:inline">悪い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="access" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $edit_post['access']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
