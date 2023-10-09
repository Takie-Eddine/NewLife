@extends('admin.layouts.admin')


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
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$users->count()}}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-4 text-gray-400">{{__('admin.participants')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$coaches->count()}}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-4 text-gray-400">{{__('admin.coaches')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$admins->count()}}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-4 text-gray-400">{{__('admin.admins')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-xl-10">
                    <div class="card h-xl-100" id="">
                        <div class="card-header position-relative py-0 border-bottom-2">
                            <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                <li class="nav-item p-0 ms-0 me-8">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-color-muted active px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_1">
                                        <!--begin::Subtitle-->
                                        <span class="nav-text fw-semibold fs-4 mb-3">{{__('admin.task')}}</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Bullet-->
                                        <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="">
                                    <div class="table-responsive">
                                        <table class="table align-middle gs-0 gy-4">
                                            <thead>
                                                <tr>
                                                    <th class="p-0 w-10px"></th>
                                                    <th class="p-0 min-w-400px"></th>
                                                    <th class="p-0 min-w-100px"></th>
                                                    <th class="p-0 min-w-125px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tasks as $task)
                                                    <tr>
                                                        <td>
                                                            @if ($task->status == 'Pending')
                                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-warning"></span>
                                                            @endif
                                                            @if ($task->status == 'In Progress')
                                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-info"></span>
                                                            @endif
                                                            @if ($task->status == 'Completed')
                                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">{{$task->description}}</a>
                                                            <span class="text-gray-400 fw-bold fs-7 d-block">{{$task->name}}</span>
                                                        </td>
                                                        <td class="text-end">
                                                            @if ($task->status == 'Pending')
                                                                <span data-kt-element="status" class="badge badge-light-warning">{{$task->status}}</span>
                                                            @endif
                                                            @if ($task->status == 'In Progress')
                                                                <span data-kt-element="status" class="badge badge-light-info">{{$task->status}}</span>
                                                            @endif
                                                            @if ($task->status == 'Completed')
                                                                <span data-kt-element="status" class="badge badge-light-success">{{$task->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{route('admin.users.view',Auth::user()->id)}}" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                                    <i class="ki-duotone ki-exit-right">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
