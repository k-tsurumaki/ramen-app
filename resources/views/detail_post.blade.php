@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>
@endsection

@section('content')
<div class="card  mx-auto" style="width: 33%;">
    <div class="card-header d-flex justify-content-between">
        詳細
        <form id="edit-form" action="/edit/{{$detail['edit_post']['id']}}" method="GET">
            @csrf
            <input type="hidden" name="post_id" value="{{ $detail['edit_post']['id'] }}"/>
            @if($detail['edit_post']['user_id']==Auth::id())
            <button type="submit" class="btn btn-primary" onclick="editHandle(event);">編集</button>
            @endif
        </form>
    </div>
    <form class="card-body" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <img src="{{ '/storage/'.$detail['edit_post']['image'] }}" class='mb-3 mx-auto d-block img'/>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="shop" placeholder="店名" value="{{ $detail['shop_name'] }}" disabled/>
        </div>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="menu" placeholder="メニュー名" value="{{ $detail['menu_name'] }}" disabled/>
        </div>
        <div class="form-group mb-3" >
            <input type="number" class="form-control" name="price" placeholder="値段(円)" value="{{ $detail['edit_post']['price'] }}" disabled/>
        </div>
        <div class="form-group mb-3" >
            <textarea class="form-control" name="content" rows="3" placeholder="本文を入力" disabled>{{$detail['edit_post']['content']}}</textarea>
        </div>
        <select class="form-select mb-3" name="kind" aria-label="Default select example">
        @foreach ($detail['menu_kind_list'] as $kind_number => $kind_name)
            <option value={{$kind_number}} {{ ($kind_number === $detail['menu_kind_number']) ? 'selected' : '' }} disabled>{{$kind_name}}</option>
        @endforeach
        </select>
        <div>
            <h5>ラーメンについて</h5>
            <div class="mb-3 text-center">
                <p>味の濃さ</p>
                <p style="display:inline">あっさり</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="intensity" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['intensity']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="thickness" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['thickness']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="price_value" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['price_value']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="look" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['look']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="all" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['all']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="atmosphere" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['atmosphere']) ? 'checked' : '' }} disabled>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">にぎやか</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>提供スピード</p>
                <p style="display:inline">遅い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="speed" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['speed']) ? 'checked' : '' }} disabled>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">早い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>接客</p>
                <p style="display:inline">悪い</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hospitality" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['hospitality']) ? 'checked' : '' }} disabled>
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
                    <input class="form-check-input" type="radio" name="access" id="inlineRadio{{$i}}" value={{$i}} {{ ($i === $detail['edit_post']['access']) ? 'checked' : '' }} disabled>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>
    </form>
</div>
@endsection
