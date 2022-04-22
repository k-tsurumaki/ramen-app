@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        新規投稿
    </div>
    <form class="card-body">
        <div class="mb-3" action="/store" method="POST">
            @csrf
            <div class="form-group mb-3" >
                <input type="text" class="form-control" name="shop" placeholder="店名">
            </div>
            <div class="form-group mb-3" >
                <input type="text" class="form-control" name="menu" placeholder="メニュー名">
            </div>
            <div class="form-group mb-3" >
                <textarea class="form-control" name="content" rows="3" placeholder="本文を入力"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>
</div>
@endsection
