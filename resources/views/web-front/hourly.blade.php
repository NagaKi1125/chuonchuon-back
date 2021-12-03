@extends('layouts.frontpage')

@section('body')

<div class="hero" style="background-image: url({{ secure_asset('img/system/download.jpg') }})">
    <div class="container wrap-banner">
        <p class="title">THỜI TIẾT TRONG 48 GIỜ KẾ TIẾP</p>
    </div>
</div>


<div class="forecast-table">
    <div class="container">
        <div class="forecast-container row">
            @foreach ($hourly as $h)
            @if ($loop->index % 6 == 0)
            <div class="forecast col-sm">
                <div class="forecast-header">
                    <h5 class="dt">{{ $h->dt }}</h5>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                        <img src="{{ $h->weather_icon }}" alt="Icon">
                        <p class="description">{{ $h->weather_description }}</p>
                    <div class="degree">{{ round($h->temp) }}°C</div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<main class="container" id="accordion">
    <h2 class="daily-heading-title text-white text-center" style="font-size:20px;">Xem chi tiết</h2>
    @foreach ($hourly as $h)0
    {{--  xu li du lieu  --}}
    @php

        // check rain precition
        $pop = $h->pop * 100;
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
        $val = round((($h->wind_deg / 22.5) + 0.5),0);

        $wind_deg = $directions[($val % 16)];


        $uvi = $h->uvi;
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
     aria-expended="false" aria-controls="see-details{{ $loop->index }}">
        <div class="row">
            <div class="col-md weather">
                <div class="item">Vào lúc {{ $h->dt }}
                    <br>
                    <b>{{ round($h->temp,0) }}°C</b>
                </div>
                <div class="item"><img src="{{ $h->weather_icon }}" width="50px"></div>
                <div class="item">{{ $h->weather_description }}</div>

                <div class="item-right">{{ $h->wind_speed }} m/s</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/wind_speed.png') }}" width="30px"></div>
                <div class="item-right">{{ $wind_deg }}</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/wind_deg.png') }}" width="30px"></div>
                <div class="item-right">{{ $h->humidity }}%</div>
                <div class="item-right"><img src="{{ secure_asset('img/icons/humidity.png') }}" width="30px"></div>
            </div>
        </div>
    </div>

    <div class="accordion-body collapse in" id="see-details{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}">
        <div class="container">
            <div class="row hourly-detail">
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
                                {{ $h->humidity }} %
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/pressure.png') }}" alt="Áp suất" width="30px">
                                {{ $h->pressure }} hPa
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/dew_point.png') }}" alt="Điểm sương" width="30px">
                                {{ $h->dew_point }} °C
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/wind_speed.png') }}" alt="Xác suất mưa" width="30px">
                                {{ $pop_chance }}
                            </div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/cloudy.png') }}" alt="Độ che phủ" width="30px">
                                {{ $h->clouds }} %
                            </div>
                            <div class="w-100"></div>
                            <div class="d-flex p-2 col-md">
                                <img src="{{ secure_asset('img/icons/wind_deg.png') }}" alt="Tốc độ gió" width="30px">
                                {{ $h->wind_speed}} m/s
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
