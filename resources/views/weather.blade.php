@extends ('main')
@section ('content')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            @if($error!='')
                <div class="alert alert-danger" role="alert">{{  $error }}</div>
            @endif

            <div class="thumbnail weather">
                <h3>Погода в Брянске</h3>
                <img src="{{ $currentWeather['icon'] }}" alt="...">
                <div class="caption">
                    <p>{{ $currentWeather['desc'] }}</p>
                    <p>Температура: {{ $currentWeather['temp'] }}&deg;C</p>
                </div>
            </div>
        </div>
    </div>

@endsection