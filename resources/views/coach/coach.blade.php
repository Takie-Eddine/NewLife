@extends('coach.layouts.coach')


@section('title', 'Dashboard')


@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('style')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<link href="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10">
                <div class="col-xl-7 mb-5 mb-xl-10">
                    <div id="calendar">
                    </div>
                </div>
                @if ($food)
                    <div class="col-xl-5 mb-5 mb-xl-10">
                        <div class="card card-flush h-md-100">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{$food->date}}</h2>
                                </div>
                            </div>
                            @forelse ($food->types as $type)
                                <div class="card-body pt-1">
                                    <div class="fw-bold text-gray-600 mb-5">{{$type->type}}: </div>
                                    <div class="d-flex flex-column text-gray-600">
                                        @foreach ($type->meals as $meal)
                                            <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>{{$meal->name}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection


@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var booking = @json($events);

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'timeGridDay',

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay',
            },
            events: booking,
            navLinks: true,
            selectable: true,
            selectMirror: true,
            editable: true,


        });
        $("#kt_modal_add_event").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
        });

        calendar.render();
    });
</script>

<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
@endpush
