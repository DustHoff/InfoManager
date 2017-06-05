@extends("layout.master")
@section("content")
    <div id="calendar"></div>
    <script>
        $(document).ready(function () {
            $("#calendar").fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,listDay'
                },
                events: '{{route("calendarFeed")}}',
                startParam: 'maintenance_start',
                endParam: 'maintenance_end',
                selectable: true,
                locale: '{{env("local")}}'
            });
        });
    </script>
@endsection