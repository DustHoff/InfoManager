@extends("layout.master")
@section("content")
    <div class="list-group">
        @foreach($maintenances as $maintenance)
             @include("info.maintenance.item")
        @endforeach
        @if($maintenances->isEmpty())
            <div class="list-group-item">No active Maintenaces/Incidents</div>
        @endif
    </div>
@endsection