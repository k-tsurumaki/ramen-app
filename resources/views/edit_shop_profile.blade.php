@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-card-body">
                <div class="card-header">プロフィール変更</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_shop_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $shop->id }}"/>
                        <div class="row mb-3">
                            <label for="shop" class="col-md-4 col-form-label text-md-end">店名</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="shop" placeholder="店名" value = "{{ $shop->name }}">
                            @error('shop')
                                <div class="alert alert-danger">店名を入力してください</div>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">アイコン画像</label>

                            <div class="col-md-6">
                                <input class="mb-3" type="file" name="image" value = "{{ old('image') }}">

                            @error('image')
                                <div class="alert alert-danger">画像ファイルを選択してください</div>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">住所</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" placeholder="住所" value = "{{ $shop->address }}">
                            @error('address')
                                <div class="alert alert-danger">住所を入力してください</div>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="station" class="col-md-4 col-form-label text-md-end">最寄り駅</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="station" placeholder="最寄り駅" value = "{{ $shop->station }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    変更
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
