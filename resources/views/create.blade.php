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
            <textarea class="form-control" name="content" rows="3" placeholder="本文を入力"></textarea>
        </div>
        <select class="form-select mb-3" aria-label="Default select example">
            <option selected>種類</option>
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
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">こってり</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>麺の太さ</p>
                <p style="display:inline">細い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">太い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>値段</p>
                <p style="display:inline">安い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">高い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>見た目</p>
                <p style="display:inline">微妙</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">きれい</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>総合評価</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5" id="inlineRadio5" value="option5">
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
                <p style="display:inline">きたない</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">きれい</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>接客</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
            <div class="mb-3 text-center">
                <p>アクセス</p>
                <p style="display:inline">悪い</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                </div>
                <p style="display:inline">良い</p>
            </div>
            <br>
        </div>

        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection
