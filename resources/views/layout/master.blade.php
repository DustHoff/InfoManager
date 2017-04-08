<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Infomanager</title>

    <!-- Bootstrap core CSS -->
    <link type="text/css" href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/angular.min.js"></script>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-tagsinput.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/fullcalendar.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <link type="text/css" href="/css/app.css" rel="stylesheet">
    <link type="text/css" href="/css/bootstrap-tagsinput.css" rel="stylesheet">
    <link type="text/css" href="/css/fullcalendar.min.css" rel="stylesheet">
    <link type="text/css" href="/css/fullcalendar.print.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

@include("layout.nav")

<div class="container">

@yield("content")

</div>
@yield("footer")
</body>
</html>
