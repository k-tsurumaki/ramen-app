@extends('layouts.app')

@section('content')
<div class="row mx-3">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                検索
            </div>
            <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                タイムライン
            </div>
            <div class="card-body">
            @foreach($posts as $post)
                <a class="card-text d-block">{{ $post['content'] }}</a>
                <img src="{{ '/storage/'.$post['image'] }}" class='w-10 mb-3'/>
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                プロフィール
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h3>ユーザー名</h3>
                    <br>
                    <img src="..." alt="ユーザーアイコン" class="img-thumbnail">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
