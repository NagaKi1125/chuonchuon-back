@extends('layouts.frontpage')

@section('body')

@php

        function check_pop($pop){
            $pop = $pop * 100;
            if($pop < 20){
                $pop_text = "Không có mưa";
            }else if($pop >=20 && $pop < 30){
                $pop_text = "Khả năng thấp";
            }else if($pop >= 30 && $pop < 50){
                $pop_text = "Có thể có mưa";
            }else{
                $pop_text = "Mưa";
            }
           return $pop.'% - '.$pop_text;
        }


        function get_wind_direction($deg){
            $directions = ["N - Bắc", "NNE - Bắc Đông Bắc", "NE - Đông Bắc", "ENE - Đông Đông Bắc", "E - Đông",
            "ESE - Đông Đông Nam", "SE - Đông Nam", "SSE - Nam Đông Nam", "S - Nam", "SSW - Nam Tây Nam",
            "SW - Tây Nam", "WSW - Tây Tây Nam", "W - Tây", "WNW - Tây Tây Bắc",
            "NW - Tây Bắc", "NNW - Bắc Tây Bắc"];
            $val = round((($deg / 22.5) + 0.5),0);

            return $directions[($val % 16)];
        }

        function get_uvi_result($uvi){
            if($uvi >= 0 && $uvi <= 2){
                $uv_text = "Thấp";
            }else if($uvi >= 8 && $uvi <= 10){
                $uv_text = "Gây hại";
            }else if($uvi >= 11){
                $uv_text = "Rất nguy hiểm";
            }else{
                $uv_text = "Bình thường";
            }
            return $uvi.' - '.$uv_text;
        }

@endphp

<div class="hero text-center" style="background-image: url({{ secure_asset('img/system/download.jpg') }})">
    <p class="title">CHUỒN CHUỒN - DỰ BÁO THỜI TIẾT</p>
    <form action="{{ route('search') }}" method="GET">
        @csrf

        <select name="select" class="selectpicker" data-live-search="true" required>
            @foreach ($cities as $c)
            <option value="{{ $c->country }}, {{ $c->city }}-{{ $c->lat }}-{{ $c->lng }}">
                {{ $c->country }}, {{ $c->city }}
            </option>
            @endforeach
        </select>
        <input type="submit" value="Find">
    </form>

</div>


<div class="forecast-table">
    <div class="container">
        <div class="forecast-container">
            <div class="today forecast">
                <div class="forecast-header">
                    <div class="day">{{ $current->dt }}</div>
                    {{-- <div class="date">6 Oct</div> --}}
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="degree row">
                        <div class="num col-md">
                            <div class="location" style="font-size:25px;">
                                @if ($location)
                                {{ $location[2] }}
                                @else
                                Quảng Ngãi
                                @endif

                            </div>
                            {{ round($current->temp,0) }}°C
                        </div>
                        <div calass="col-md">
                            <img src="{{ $current->weather_icon }}" alt="" width=70>
                            <div>{{ $current->weather_description }}</div>
                        </div>
                    </div>

                    <div class="d-flex p-2 justify-content-between">
                        <div class="d-flex p-2"><img src="{{ secure_asset('img/icons/humidity.png') }}" alt="" width="20px">{{ $current->humidity }}%</div>
                        <div class="d-flex p-2"><img src="{{ secure_asset('img/icons/wind_speed.png') }}" alt="" width="20px">{{ $current->wind_speed }} m/s</div>
                    </div>
                    <div class="d-flex p-2"><img src="{{ secure_asset('img/icons/wind_deg.png') }}" alt="" width="20px">{{ get_wind_direction($current->wind_deg) }}</div>

                </div>
            </div>

            @foreach ($daily as $d)
            @if ($loop->index == 0)

            @else
            <div class="forecast">
                <div class="forecast-header">
                    <div class="day">{{ $d->dt }}</div>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="forecast-icon text-center">
                        <img src="{{ $d->weather_icon }}" alt="" width=50>

                        {{ $d->weather_description }}

                    </div>
                    <div class="degree" style="font-size:16px;">{{ round($d->temp_max,0) }}°C</div>
                    <small style="font-size:13px;">{{ round($d->temp_min,0) }}°C</small>
                </div>
            </div>
            @endif

            @endforeach

        </div>
    </div>
</div>
<div class="widget-container container">
    <div class="row">
        <div class="bottom-left col-md-3 d-flex p-2">
            <h1 id="temperature">{{ round($current->temp,0) }}°C</h1>
            <h2 id="temp-divider">/</h2>
            <div id="fahrenheit">
                <p style="font-size:10px;">Cảm giác như</p>
                <h2>{{ round($current->feels_like,0) }}&degC</h2>
            </div>

        </div>
        <div class="container col-md-9">
            <div class="row">
                <div class="col-md"><img src="{{ secure_asset('img/icons/wind_speed.png') }}" alt=""width="30px" >Wind Speed:<br> {{ $current->wind_speed }}m/s</div>
                <div class="col-md"><img src="{{ secure_asset('img/icons/uv.png') }}" alt=""width="30px" >UV index:<br> {{  get_uvi_result($current->uvi) }}</div>
                <div class="col-md"><img src="{{ secure_asset('img/icons/pressure.png') }}" alt=""width="30px" >Pressure:<br> {{ $current->pressure }}hPa</div>
                <div class="col-md"><img src="{{ secure_asset('img/icons/dew_point.png') }}" alt=""width="30px" >Dew Point:<br> {{ $current->dew_point }}°C</div>
                <div class="col-md"><img src="{{ secure_asset('img/icons/visibility.png') }}" alt=""width="30px" >Visibility:<br> {{ $current->visibility }}m</div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="hourly container">
    <h2>Hàng giờ</h2>
    <div class="abc row">
        @foreach ($hourly as $h)
        @if ($loop->index % 6 == 0)
        <div class="card-day col-md text-center">
            <div class="container-day">
                <h3><b>{{ $h->dt }}</b></h3>
                <img src="{{ $h->weather_icon }}" alt="" width=30 >
                <h2>{{ $h->temp }}°C</h2>
                <p>{{ $h->pop*100 }}%</p>
            </div>
        </div>
        @endif

        @endforeach

    </div>
</div>



@endsection

@section('js')
<script>
    $(document).ready(function (){
        $('.search_select_box select').selectpicker('refresh');
    });

<script>
@endsection
