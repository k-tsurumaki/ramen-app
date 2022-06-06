@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>
@endsection

@section('content')
<div class="row mx-3">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
        <div class="card  mx-auto my-card-body">
            <div class="card-header d-flex justify-content-between">
                編集
                <form id="delete-form" action="{{ route('destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $detail['edit_post']['id'] }}"/>
                    <i class="fas fa-trash mx-3" onclick="deleteHandle(event);"></i>
                </form>
            </div>
            <form class="card-body" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{  $detail['edit_post']['id'] }}"/>
                <img src="{{ $detail['edit_post']['image'] }}" class='img-fluid mb-3 mx-auto d-block'/>
                <div class="form-group mb-3" >
                    <input type="text" class="form-control" name="shop" placeholder="店名" value="{{ $detail['shop_name'] }}"/>
                </div>
                @error('shop')
                    <div class="alert alert-danger">店名を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <input type="text" class="form-control" name="menu" placeholder="メニュー名" value="{{ $detail['menu_name'] }}"/>
                </div>
                @error('menu')
                    <div class="alert alert-danger">メニュー名を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <input type="number" class="form-control" name="price" placeholder="値段(円)" value="{{  $detail['edit_post']['price'] }}"/>
                </div>
                @error('price')
                    <div class="alert alert-danger">値段を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <textarea class="form-control" name="content" rows="3" placeholder="投稿文を入力" >{{ $detail['edit_post']['content']}}</textarea>
                </div>
                @error('content')
                    <div class="alert alert-danger">投稿文を入力してください</div>
                @enderror
                <select class="form-select mb-3" name="kind" aria-label="Default select example">
                @foreach ($detail['menu_kind_list'] as $kind_number => $kind_name)
                    <option value={{$kind_number}} {{ ($kind_number === $detail['menu_kind_number']) ? 'selected' : '' }}>{{$kind_name}}</option>
                @endforeach
                </select>
                @error('kind')
                    <div class="alert alert-danger">種類を選択してください</div>
                @enderror
                <div>
                    <h5>ラーメンについて</h5>
                    <div class="mb-3 text-center">
                        <p>味の濃さ</p>
                        <p style="display:inline">あっさり</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="intensity" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['intensity']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">こってり</p>
                    </div>
                    @error('intensity')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>麺の太さ</p>
                        <p style="display:inline">細い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="thickness" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['thickness']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">太い</p>
                    </div>
                    @error('thickness')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>値段</p>
                        <p style="display:inline">安い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="price_value" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['price_value']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">高い</p>
                    </div>
                    @error('price_value')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>見た目</p>
                        <p style="display:inline">悪い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="look" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['look']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">良い</p>
                    </div>
                    @error('look')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>総合評価</p>
                        <p style="display:inline">悪い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="all" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['all']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">良い</p>
                    </div>
                    @error('all')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                </div>
                <div>
                    <h5>店について</h5>
                    <div class="mb-3 text-center">
                        <p>雰囲気</p>
                        <p style="display:inline">静か</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="atmosphere" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['atmosphere']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">にぎやか</p>
                    </div>
                    @error('atmosphere')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>提供スピード</p>
                        <p style="display:inline">遅い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="speed" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['speed']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">早い</p>
                    </div>
                    @error('speed')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>接客</p>
                        <p style="display:inline">悪い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hospitality" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['hospitality']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">良い</p>
                    </div>
                    @error('hospitality')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                    <div class="mb-3 text-center">
                        <p>アクセス</p>
                        <p style="display:inline">悪い</p>
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="access" id="inlineRadio{{$i}}" value={{$i}} {{ ($i ===  $detail['edit_post']['access']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                        <p style="display:inline">良い</p>
                    </div>
                    @error('access')
                        <div class="alert alert-danger">選択してください</div>
                    @enderror
                    <br>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
@endsection
