@extends("layout.master")
@section("content")
    <calendar events="{{route('calendarFeed')}}"/>
@endsection