<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        お店情報
    @if($shop->user_id == Auth::id())
        <a href="/edit_shop_profile/{{$shop->id}}"><i class="fa-solid fa-user-gear"></i></a>
    @endif
    </div>
    <div class="card-body my-card-body">
        <div class="text-center">
            <h3>{{ $shop->name }}</h3>
            <br>
            <img src="{{ $shop['image'] }}" alt="お店の画像は登録されていません" class="img-thumbnail icon mb-5">
            <br>
            <div class="row  mb-3">
                <i class="fa-solid fa-location-dot col-2 mt-1"></i>
            @if(isset($shop->address))
                <h5 class="col-auto">{{ $shop->address }}</h5>
            @else
                <h5 class="col-auto">情報がありません</h5>
            @endif
            </div>
            <div class="row">
                <i class="fa-solid fa-train-subway col-2 mt-1"></i>
            @if(isset($shop->station))
                <h5 class="col-auto">{{ $shop->station }}</h5>
            @else
                <h5 class="col-auto">情報がありません</h5>
            @endif
            </div>
        </div>
    </div>
</div>
