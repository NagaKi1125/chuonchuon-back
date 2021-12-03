@extends('layouts.frontpage')

@section('body')

<div class="hero" style="background-image: url({{ secure_asset('img/system/download.jpg') }})">
    <div class="container wrap-banner">
        <p class="title">THỜI TIẾT 7 NGÀY TỚI</p>
    </div>
</div>


<div class="forecast-table">
    <div class="container">
        <div class="forecast-container row">
            @foreach ($daily as $d)
            <div class="forecast col-sm">
                <div class="forecast-header">
                    <h5 class="dt">{{ $d->dt }}</h5>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                        <img src="{{ $d->weather_icon }}" alt="Icon">
                        <p class="description">{{ $d->weather_description }}</p>
                    <div class="degree">{{ round($d->temp_max,0) }}°C</div>
                    <small class="tmin">{{round($d->temp_min,0) }}°C</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<main class="container" id="accordion">
    <h2 class="daily-heading-title text-white text-center" style="font-size:20px;">Xem chi tiết</h2>
    @foreach ($daily as $d)
    {{--  xu li du lieu  --}}
    @php
        // check moonphase
        $phase = $d->moon_phase;
        if ($phase == 0 && $phase == 1){
            $text = "Trăng non (sóc)";
        } else if($phase == 0.25) {
            $text = "Bán nguyệt thượng huyền";
        } else if($phase == 0.5) {
            $text = "Trăng vọng";
        }else if($phase == 0.75) {
            $text = "Trăng cuối quý";
        }else if($phase > 0 && $phase < 0.25) {
            $text = "Lưỡi liềm hạ huyền";
        }else if($phase > 0.25 && $phase < 0.5) {
            $text = "Trăng khuyết hạ huyền";
        }else if($phase > 0.5 && $phase < 0.75) {
            $text = "Trăng khuyết thượng huyền";
        }else if($phase > 0.75 && $phase < 1) {
            $text = "Lưỡi liềm thượng huyền";
        }
        $moonphase = $text;

        // check rain precition
        $pop = $d->pop * 100;
        if($pop < 20){
            $pop_text = "Không có mưa";
        }else if($pop >=20 && $pop < 30){
            $pop_text = "Khả năng thấp";
        }else if($pop >= 30 && $pop < 50){
            $pop_text = "Có thể có mưa";
        }else{
            $pop_text = "Mưa";
        }
        $pop_chance = $pop.'% - '.$pop_text;


        $directions = ["N - Bắc", "NNE - Bắc Đông Bắc", "NE - Đông Bắc", "ENE - Đông Đông Bắc", "E - Đông",
        "ESE - Đông Đông Nam", "SE - Đông Nam", "SSE - Nam Đông Nam", "S - Nam", "SSW - Nam Tây Nam",
        "SW - Tây Nam", "WSW - Tây Tây Nam", "W - Tây", "WNW - Tây Tây Bắc",
        "NW - Tây Bắc", "NNW - Bắc Tây Bắc"];
        $val = round((($d->wind_deg / 22.5) + 0.5),0);

        $wind_deg = $directions[($val % 16)];


        $uvi = $d->uvi;
        if($uvi >= 0 && $uvi <= 2){
            $uv_text = "Thấp";
        }else if($uvi >= 8 && $uvi <= 10){
            $uv_text = "Gây hại";
        }else if($uvi >= 11){
            $uv_text = "Rất nguy hiểm";
        }else{
            $uv_text = "Bình thường";
        }
        $uv_result = $uvi.' - '.$uv_text;


    @endphp
    {{--  end xu li du lieu  --}}
    <div class="container first-show" role="button" data-toggle="collapse" data-target="#see-details{{ $loop->index }}" heading="heading{{ $loop->index }}"
    @if ($loop->first) aria-expended="true" @else aria-expended="false" @endif
    aria-controls="see-details{{ $loop->index }}">
        <div class="row">
            <div class="col-md weather">
                <div class="item">Ngày {{ $d->dt }}
                    <br>
                    <b>{{ round($d->temp_max,0) }}</b>/<small>{{round($d->temp_min,0) }}°C</small>
                </div>
                <div class="item"><img src="{{ $d->weather_icon }}" width="50px"></div>
                <div class="item">{{ $d->weather_description }}</div>

                <div class="item-right">{{ $d->wind_speed }} m/s</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/wind_speed.png') }}" width="30px"></div>
                <div class="item-right">{{ $wind_deg }}</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/wind_deg.png') }}" width="30px"></div>
                <div class="item-right">{{ $d->humidity }}%</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/humidity.png') }}" width="30px"></div>
            </div>
        </div>
    </div>

    <div class="collapse" id="see-details{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}">
        <div class="container">
            <div class="row d-flex justify-content-around">
                <div class="temp temp_morn">
                    Buổi sáng: {{ round($d->temp_morn) }}°C
                </div>
                <div class="temp temp_day">
                    Trong ngày: {{ round($d->temp_day) }}°C
                </div>
                <div class="temp temp_eve">
                    Chiều tối: {{ round($d->temp_eve) }}°C
                </div>
                <div class="temp temp_night">
                    Đêm khuya: {{ round($d->temp_night) }}°C
                </div>
            </div>
            <br>
            <div class="row daily-detail">
                <div class="col-md">
                    <h4>Thiên văn</h4>
                    <div class="details sun-moon">
                        <div class="row sun d-flex justify-content-between">
                            <div class="d-flex p-2 align-middle">
                                <img src="{{ secure_asset('img/icons/sunrise.png') }}" width="30px">
                                {{ $d->sunrise }}
                            </div>
                            <div class="d-flex p-2 align-middle">
                                <img src="{{ secure_asset('img/icons/sunset.png') }}" width="30px">
                                {{ $d->sunset }}
                            </div>
                        </div>
                        <div class="row moon d-flex justify-content-between">
                            <div class="d-flex p-2 align-middle">
                                <img src="{{ secure_asset('img/icons/moonrise.png') }}" width="30px">
                                {{ $d->moonrise }}
                            </div>
                            <div class="d-flex p-2 align-middle">
                                <img src="{{ secure_asset('img/icons/moonset.png') }}" width="30px">
                                {{ $d->moonset }}
                            </div>
                        </div>
                        <div class="row moon d-flex justify-content-between">
                            <div class="d-flex p-2 align-middle">
                                <img src="{{ secure_asset('img/icons/moon_phase.png') }}" width="30px">
                                {{ $moonphase }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <h4>Chỉ số cuộc sống</h4>
                    <div class="details life">
                        <div class="row text-center">
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/uv.png') }}" alt="Tia Uv" width="30px">
                                {{ $uv_result }}
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/humidity.png') }}" alt="Độ ẩm" width="30px">
                                {{ $d->humidity }} %
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/pressure.png') }}" alt="Áp suất" width="30px">
                                {{ $d->pressure }} hPa
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/dew_point.png') }}" alt="Điểm sương" width="30px">
                                {{ $d->dew_point }} °C
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/wind_speed.png') }}" alt="Xác suất mưa" width="30px">
                                {{ $pop_chance }}
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/cloudy.png') }}" alt="Độ che phủ" width="30px">
                                {{ $d->clouds }} %
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/wind_deg.png') }}" alt="Tốc độ gió" width="30px">
                                {{ $d->wind_speed}} m/s
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/wind_deg.png') }}" alt="Hướng gió" width="30px">
                                {{ $wind_deg }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</main> <!-- .main-content -->



@endsection
