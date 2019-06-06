<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sunny days</title>

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Sunny days</h1>

            <form>
                <div class="form-group">
                    <label for="cities">City</label>
                    <select class="form-control" id="sel-city">
                        <option value="0">-- select --</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="panel panel-default">
                <div class="panel-heading">Results</div>
                <div class="panel-body">
                    <div id="res-info">
                        Select city...
                    </div>
                    <div id="res" style="display: none;">
                        <p>Historical longest period of sunny days: <span id="res-his"></span></p>
                        <p>Longest period in current month: <span id="res-month"></span></p>
                        <p>Length of current period of sunshine: <span id="res-curr"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var csrf_token = '{{ csrf_token() }}';
        </script>
        <script src="{{ mix('/js/app.js') }}"></script>
        <script src="{{ asset('/js/jquery.cookie.js') }}"></script>
        <script src="{{ mix('/js/home/script.js') }}"></script>
    </body>
</html>
