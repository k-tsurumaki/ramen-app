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
                    <input type="text" id="addressInput2" value="{{ $shop['name']}}" style="width: 250px">
                    <input type="button" value="場所を表示" onclick="getIdoKeidoMap();" class="mb-1">
                    <br />
                    ※うまく表示されない場合は住所を入力してください
                    <br /><br />
                    <div id="mapArea" style="width:410px; height:350px; border: 1px solid"></div>
                    </div>

                    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('services.google.google_api_key') }}"></script>

                    <script type="text/javascript">
                        //地図の初期表示
                        new google.maps.Map(document.getElementById("mapArea"), {
                        zoom: 5,
                        center: new google.maps.LatLng(36,138),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                    function getIdoKeidoMap() {

                        var addressInput = document.getElementById('addressInput2').value;
                        var geocoder = new google.maps.Geocoder();

                        geocoder.geocode({
                            address: addressInput
                        }, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {

                            //Mapクラスのインスタンスを生成します。
                            var map = new google.maps.Map(
                                document.getElementById("mapArea"),
                                {
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                                }
                            );
                            
                            //表示範囲クラスのインスタンスを生成します。
                            var bounds = new google.maps.LatLngBounds();
                            
                            for (var i in results) {
                                if (results[i].geometry) {

                                //緯度・経度情報を取得します。
                                var latlng = results[i].geometry.location;

                                //住所を取得します。
                                var address = results[i].formatted_address;

                                //取得した緯度・経度で表示範囲を拡張します。
                                bounds.extend(latlng);

                                //地図上に緯度・経度、住所の情報を表示します。
                                new google.maps.InfoWindow(
                                    {
                                    content: "(緯度, 経度) = " + latlng.toString() +
                                            "<br />" + address
                                    }
                                ).open(
                                    map,
                                    new google.maps.Marker(
                                    {
                                        position: latlng,
                                        map: map
                                    }
                                    )
                                );
                                }
                            }

                            //表示範囲に移動します。
                            map.fitBounds(bounds);
                            //地図のズームを設定します。
                            map.setZoom(15);

                            } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                            alert("住所が見つかりませんでした。");
                            } else if (status == google.maps.GeocoderStatus.ERROR) {
                            alert("サーバ接続に失敗しました。");
                            } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
                            alert("リクエストが無効でした。");
                            } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                            alert("リクエストの制限回数を超えました。");
                            } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
                            alert("サービスが使えない状態でした。");
                            } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
                            alert("原因不明のエラーが発生しました。");
                            }
                        });
                    }
                    </script>   
                </div> 
            </div>
        </div>
    </div>
</div>
