@extends('admin.layouts.admin')


@section('title', 'Specialist')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('style')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>


@endpush

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('user.calendar')}}</h1>
                    <!--end::Title-->
                </div>
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="" class="app-content flex-column-fluid">
            <div id="" class="app-container container-xxl">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title fw-bold">{{__('user.calendar')}}</h2>
                        <div class="card-toolbar">
                            <button class="btn btn-flex btn-primary" data-bs-toggle="modal" data-kt-calendar="add" data-bs-target="#kt_modal_add_event">
                            <i class="ki-duotone ki-plus fs-2"></i>{{__('user.add event')}}</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <form class="form" action="#" id="kt_modal_add_event_form">
                                @csrf
                                <div class="modal-header">
                                    <h2 class="fw-bold" data-kt-calendar="title">{{__('user.add event')}}</h2>
                                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>
                                <div class="modal-body py-10 px-lg-17">
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold required mb-2">{{__('user.event name')}}</label>
                                        <input type="text" id="title" class="form-control form-control-solid" placeholder="{{__('user.event name')}}" name="title" />
                                        <span id="titleError" class="text-danger"></span>
                                    </div>
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold mb-2">{{__('user.event description')}}</label>
                                        <input type="text" id="description" class="form-control form-control-solid" placeholder="{{__('user.event description')}}" name="description" />
                                        <span id="descriptionError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">{{__('admin.cancel')}}</button>
                                    <button type="button" id="saveBtn" class="btn btn-primary">
                                        <span class="indicator-label">{{__('user.add event')}}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        var booking = @json($events);

        // $('#calendar').fullCalendar({
        //     header: {
        //         left: 'prev,next,today',
        //         center: 'title',
        //         right :'month, agendaWeek, agendaDay'
        //     },
        //     events: booking,
        //     selectable: true,
        //     selectHelper: true,
        //     select: function(start, end, allDays){

        //     }
        // })
    });
</script> --}}
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

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            events: booking,
            navLinks: true,
            selectable: true,
            selectMirror: true,

            eventClick: function(info){
                alert(info.event.title)
            },

            // select: function(selectionInfo){

            //     let formatted_start_date = selectionInfo.start.getFullYear() + '-' + (selectionInfo.start.getMonth()+1) + '-' + selectionInfo.start.getDate() + " " + selectionInfo.start.getHours() + ':' + selectionInfo.start.getMinutes() + ':' + selectionInfo.start.getSeconds();
            //     let formatted_end_date = selectionInfo.end.getFullYear() + '-' + (selectionInfo.end.getMonth()+1) + '-' + selectionInfo.end.getDate() + " " + selectionInfo.end.getHours() + ':' + selectionInfo.end.getMinutes() + ':' + selectionInfo.end.getSeconds();
            //     alert(formatted_start_date);
            // },

            select: function(selectionInfo){
                $('#kt_modal_add_event').modal('toggle');

                $('#saveBtn').click(function(){
                    var title = $('#title').val();
                    var description = $('#description').val();
                    var start_date = moment(selectionInfo.start).format('YYYY-MM-DD'+' '+'HH:mm:ss');
                    var end_date = moment(selectionInfo.end).format('YYYY-MM-DD'+' '+'HH:mm:ss');

                    $.ajax({
                        url:"{{route('admin.calenders.store')}}",
                        type:"POST",
                        dataType:'json',
                        data:{title , description, start_date, end_date },
                        success:function(response)
                        {
                            $('#kt_modal_add_event').modal('hide');
                            calendar.addEvent({
                                title: response.title,
                                description: response.description,
                                start: response.start_date,
                                end: response.end_date
                            });
                            toastr.success('Event Created!', 'Congrats', {timeOut: 5000})
                            calendar.render();
                        },
                        error:function(error)
                        {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title)
                            }
                            if (error.responseJSON.errors) {
                                $('#descriptionError').html(error.responseJSON.errors.description)
                            }
                        }
                    })
                });
            },
            editable: true,
            eventDrop:function(arg){
                var id = arg.event.id;
                var start_date = moment(arg.event.start).format('YYYY-MM-DD'+' '+'HH:mm:ss');
                var end_date = moment(arg.event.start).format('YYYY-MM-DD'+' '+'HH:mm:ss');
                $.ajax({
                        url:"{{route('admin.calenders.update','')}}"+'/'+id,
                        type:"PATCH",
                        dataType:'json',
                        data:{ start_date, end_date },
                        success:function(response)
                        {
                            toastr.success('Event Updated!', 'Congrats', {timeOut: 5000})
                            calendar.render();
                        },
                        error:function(error)
                        {
                            console.log(error)
                        }
                })
            },
            eventResize:function(arg){
                var id = arg.event.id;
                var start_date = moment(arg.event.start).format('YYYY-MM-DD'+' '+'HH:mm:ss');
                var end_date = moment(arg.event.end).format('YYYY-MM-DD'+' '+'HH:mm:ss');
                $.ajax({
                        url:"{{route('admin.calenders.update','')}}"+'/'+id,
                        type:"PATCH",
                        dataType:'json',
                        data:{ start_date, end_date },
                        success:function(response)
                        {
                            toastr.success('Event Updated!', 'Congrats', {timeOut: 5000})
                            calendar.render();
                        },
                        error:function(error)
                        {
                            console.log(error)
                        }
                })
            },
            eventClick:function(arg){
                var id = arg.event.id;
                if (confirm('Are you sure want to remove it')) {
                    $.ajax({
                        url:"{{route('admin.calenders.destroy','')}}"+'/'+id,
                        type:"DELETE",
                        dataType:'json',
                        success:function(response)
                        {
                            calendar.getEventById(response).remove();
                            toastr.success('Event Deleted!', 'Congrats', {timeOut: 5000});
                        },
                        error:function(error)
                        {
                            console.log(error)
                        }
                })
                }

            },
            // selectAllow: function(arg){
            //     return moment(arg.start).utcOffset(false).isSame(moment(arg.end).subtract(1,'second').utcOffset(false), 'day');
            // },

        });
        $("#kt_modal_add_event").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
        });

        calendar.render();
    });
</script>
@endpush
