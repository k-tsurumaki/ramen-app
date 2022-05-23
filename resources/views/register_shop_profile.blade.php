@extends('layouts.app_register')

@section('content')
<div class="card  mx-auto my-card-body" style="width: 33%;">
    <div class="card-header">
        お店情報の登録
    </div>
    <form class="card-body" action="{{ route('store_shop') }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" class="form-control" name="address" placeholder="住所" value = "{{ old('address') }}">
        </div>
        @error('address')
            <div class="alert alert-danger">住所を入力してください</div>
        @enderror

        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection
