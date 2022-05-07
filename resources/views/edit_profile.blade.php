@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-card-body">
                <div class="card-header">プロフィール変更</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ユーザー名</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="ユーザー名" value = "{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger">ユーザー名を入力してください</div>
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
