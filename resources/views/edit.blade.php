@extends('layouts.app')

@section('content')
<div class="card  mx-auto" style="width: 33%;">
    <div class="card-header">
        編集
    </div>
    <form class="card-body" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $edit_post['id'] }}"/>
        <img src="{{ '/storage/'.$edit_post['image'] }}" class='w-10 mb-3'/>
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
            <option value="1">醤油</option>
            <option value="2">塩</option>
            <option value="3">豚骨</option>
            <option value="4">味噌</option>
            <option value="5">鶏白湯</option>
            <option value="6">つけ麺</option>
            <option value="7">まぜそば・油そば</option>
            <option value="8">家系</option>
            <option value="9">二郎系</option>
            <option value="10">その他</option>
        </select>
        <div>
            <h5>ラーメンについて</h5>
            <div class="mb-3 text-center">
                <p>味の濃さ</p>
                <p style="display:inline">あっさり</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">こってり</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>麺の太さ</p>
                <p style="display:inline">細い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">太い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>値段</p>
                <p style="display:inline">安い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">高い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>見た目</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>総合評価</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>
        <div>
            <h5>店について</h5>
            <div class="mb-3 text-center">
                <p>雰囲気</p>
                <p style="display:inline">静か</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">にぎやか</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>接客</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>アクセス</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio4" value="4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio5" value="5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
