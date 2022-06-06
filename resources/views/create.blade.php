@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
        <div class="card  mx-auto my-card-body">
            <div class="card-header">
                新規投稿
            </div>
            <form class="card-body" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="mb-3" type="file" name="image" value = "{{ old('image') }}">
                @error('image')
                    <div class="alert alert-danger">画像ファイルを選択してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <input type="text" class="form-control" name="shop" placeholder="店名" value = "{{ old('shop') }}">
                </div>
                @error('shop')
                    <div class="alert alert-danger">店名を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <input type="text" class="form-control" name="menu" placeholder="メニュー名" value = "{{ old('menu') }}">
                </div>
                @error('menu')
                    <div class="alert alert-danger">メニュー名を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <input type="number" class="form-control" name="price" placeholder="値段(円)" value = "{{ old('price') }}">
                </div>
                @error('price')
                    <div class="alert alert-danger">値段を入力してください</div>
                @enderror
                <div class="form-group mb-3" >
                    <textarea class="form-control" name="content" rows="3" placeholder="投稿文を入力">{{ old('content') }}</textarea>
                </div>
                @error('content')
                    <div class="alert alert-danger">投稿文を入力してください</div>
                @enderror
                <select class="form-select mb-3" name="kind" aria-label="Default select example">
                @foreach ($menu_kind_list as $kind_number => $kind_name)
                    <option value={{$kind_number}}>{{$kind_name}}</option>
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
                            <input class="form-check-input" type="radio" name="intensity" id="inlineRadio{{$i}}" value={{$i}} {{ old('intensity') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="thickness" id="inlineRadio{{$i}}" value={{$i}} {{ old('thickness') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="price_value" id="inlineRadio{{$i}}" value={{$i}} {{ old('price_value') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="look" id="inlineRadio{{$i}}" value={{$i}} {{ old('look') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="all" id="inlineRadio{{$i}}" value={{$i}} {{ old('all') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="atmosphere" id="inlineRadio{{$i}}" value={{$i}} {{ old('atmosphere') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="speed" id="inlineRadio{{$i}}" value={{$i}} {{ old('speed') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="hospitality" id="inlineRadio{{$i}}" value={{$i}} {{ old('hospitality') == $i ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" name="access" id="inlineRadio{{$i}}" value={{$i}} {{ old('access') == $i ? 'checked' : '' }}>
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

                <button type="submit" class="btn btn-primary">作成</button>
            </form>
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
@endsection
