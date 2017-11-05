<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Infomanager</title>

    <link type="text/css" href="{{asset("css/app.css")}}" rel="stylesheet">
</head>

<body>

<div id="app">
    @include("layout.nav")

    <div class="container">

        @yield("content")

    </div>
    @yield("footer")
</div>
<script src="{{asset("js/app.js")}}"></script>
<script>
    moment.locale('{{App::getLocale()}}');
    axios.get('{{route("i18n")}}').then(response => {
        window.i18n = response.data
    });
</script>
@yield("scripts")
</body>
</html>
