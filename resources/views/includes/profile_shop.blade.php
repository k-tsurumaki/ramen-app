<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        お店情報
    </div>
    <div class="card-body my-card-body">
        <div class="text-center">
            <h3>{{ $shop->name }}</h3>
            <br>
            <img src="{{ $shop['image'] }}" alt="お店の画像は登録されていません" class="img-thumbnail icon">
        </div>
    </div>
</div>
