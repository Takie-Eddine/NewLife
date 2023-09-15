@extends('coach.layouts.coach')


@section('title', 'Coach')


@push('style')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('sidebar.messages')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('coach.dashboard')}}" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('coach.messages')}}" class="text-muted text-hover-primary">{{__('sidebar.inbox')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('admin.view & reply')}}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Inbox App - View & Reply -->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">
                                <!--begin::Title-->
                                <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <h2 class="fw-semibold me-3 my-1">{{$message->subject}}</h2>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Message accordion-->
                                <div data-kt-inbox-message="message_wrapper">
                                    <!--begin::Message header-->
                                    <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50 me-4">
                                                @if ($message->sender_type == 'coach')
                                                    <span class="symbol-label" style="background-image:url({{asset('images/coach/'.$sender->profile->photo)}});"></span>
                                                @endif
                                                @if ($message->sender_type == 'admin')
                                                    <span class="symbol-label" style="background-image:url({{asset('images/profile/'.$sender->profile->photo)}});"></span>
                                                @endif
                                                @if ($message->sender_type == 'user')
                                                    <span class="symbol-label" style="background-image:url({{asset('images/profile/'.$sender->profile->photo)}});"></span>
                                                @endif

                                            </div>
                                            <!--end::Avatar-->
                                            <div class="pe-5">
                                                <!--begin::Author details-->
                                                <div class="d-flex align-items-center flex-wrap gap-1">
                                                    <a href="#" class="fw-bold text-dark text-hover-primary">{{$sender->profile->first_name}} {{$sender->profile->last_name}}</a>
                                                    <i class="ki-duotone ki-abstract-8 fs-7 text-success mx-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <span class="text-muted fw-bold">{{$message->created_at->longAbsoluteDiffForHumans()}}</span>
                                                </div>
                                                <!--end::Author details-->
                                                <!--begin::Message details-->
                                                <div data-kt-inbox-message="details">
                                                    <span class="text-muted fw-semibold">{{__('user.to')}} {{$reciver->profile->first_name}} {{$sender->profile->last_name}}</span>
                                                    <!--begin::Menu toggle-->
                                                    <a href="#" class="me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                                        <i class="ki-duotone ki-down fs-5 m-0"></i>
                                                    </a>
                                                    <!--end::Menu toggle-->
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px p-4" data-kt-menu="true">
                                                        <!--begin::Table-->
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="w-75px text-muted">{{__('user.from')}}</td>
                                                                    <td>{{$sender->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">{{__('user.date')}}</td>
                                                                    <td>{{$message->created_at}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">{{__('user.to')}}</td>
                                                                    <td>{{$reciver->email}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="text-muted fw-semibold mw-450px d-none" data-kt-inbox-message="preview">{{$message->subject}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <span class="fw-semibold text-muted text-end me-3">{{$message->created_at}}</span>
                                        </div>
                                    </div>
                                    <div class="collapse fade show" data-kt-inbox-message="message">
                                        <div class="py-5">
                                            <p>{{$message->text}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









@endsection


@push('script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/inbox/compose.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/inbox/reply.js')}}"></script>
@endpush
