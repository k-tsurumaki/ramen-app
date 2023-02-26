<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        お店情報
    @if( ($shop->user_id == Auth::id()) | (Auth::id() == 1))
        <a href="/edit_shop_profile/{{$shop->id}}"><i class="fa-solid fa-user-gear"></i></a>
    @endif
    </div>
    <div class="card-body my-card-body">
        <div class="text-center">
            <h3>{{ $shop->name }}</h3>
            <br>
            <img src="{{ '/storage/'.$shop['image'] }}" alt="お店の画像は登録されていません" class="img-thumbnail icon mb-5">
            <br>
            <div class="row  mb-3">
                <i class="fa-solid fa-location-dot col-2 mt-1"></i>
            @if(isset($shop->address))
                <h5 class="col-auto">{{ $shop->address }}</h5>
            @else
                <h5 class="col-auto">情報がありません</h5>
            @endif
            </div>
            <div class="row mb-3">
                <i class="fa-solid fa-train-subway col-2 mt-1"></i>
            @if(isset($shop->station))
                <h5 class="col-auto">{{ $shop->station }}</h5>
            @else
                <h5 class="col-auto">情報がありません</h5>
            @endif
            </div>
            <div class="row mb-3">
                <div style="text-align: center;" class="col-12">
                    <i class="fa-solid fa-map-location-dot"></i>
                    ※住所情報がない場合正確な場所でない可能性があります
                @if(isset($shop->address))
                    <iframe frameborder="0" class="map" style="width:280px; height:200px; border: 1px solid" src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google.google_api_key') }}&q={{ $shop->address }}"
                        allowfullscreen>
                    </iframe>
                @else
                    <iframe frameborder="0" class="map" style="width:280px; height:200px; border: 1px solid" src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google.google_api_key') }}&q={{ $shop->name }}"
                        allowfullscreen>
                    </iframe>
                @endif
                </div> 
            </div>
        </div>
    </div>
</div>
