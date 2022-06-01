@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスの認証') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('あなたのメールアドレスに新しい認証リンクが送信されました') }}
                        </div>
                    @endif

                    {{ __('送信する前にメールアドレスが正しく入力されているか確認してください') }}
                    {{ __('メールが届かなかった方はこちら') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('別のリクエストはこちら') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
