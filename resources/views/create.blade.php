@extends('layouts.app')

@section('content')
<div class="card  mx-auto" style="width: 33%;">
    <div class="card-header">
        新規投稿
    </div>
    <form class="card-body" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="mb-3" type="file" name="image">
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="shop" placeholder="店名">
        </div>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="menu" placeholder="メニュー名">
        </div>
        <div class="form-group mb-3" >
            <input type="text" class="form-control" name="price" placeholder="値段(円)">
        </div>
        <div class="form-group mb-3" >
            <textarea class="form-control" name="content" rows="3" placeholder="本文を入力"></textarea>
        </div>
        <select class="form-select mb-3" name="kind" aria-label="Default select example">
        @foreach ($menu_kind_list as $kind_number => $kind_name)
            <option value={{$kind_number}}>{{$kind_name}}</option>
        @endforeach
        </select>
        <div>
            <h5>ラーメンについて</h5>
            <div class="mb-3 text-center">
                <p>味の濃さ</p>
                <p style="display:inline">あっさり</p>
            @for ($i = 1; $i < 6; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="intensity" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="thickness" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="price_value" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="look" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="all" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="atmosphere" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="hospitality" id="inlineRadio{{$i}}" value={{$i}}>
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
                    <input class="form-check-input" type="radio" name="access" id="inlineRadio{{$i}}" value={{$i}}>
                    <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                </div>
            @endfor
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>

        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection
