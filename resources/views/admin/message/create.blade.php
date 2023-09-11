@extends('admin.layouts.admin')


@section('title', 'Participant')


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
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.messages')}}" class="text-muted text-hover-primary">{{__('sidebar.inbox')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('admin.compose')}}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Inbox App - Compose -->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    {{-- <div class="d-none d-lg-flex flex-column flex-lg-row-auto w-100 w-lg-275px" data-kt-drawer="true" data-kt-drawer-name="inbox-aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_inbox_aside_toggle">
                        <!--begin::Sticky aside-->
                        <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '100px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                            <!--begin::Aside content-->
                            <div class="card-body">
                                <!--begin::Button-->
                                <a href="../../demo1/dist/apps/inbox/compose.html" class="btn btn-primary fw-bold w-100 mb-8">New Message</a>
                                <!--end::Button-->
                                <!--begin::Menu-->
                                <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Inbox-->
                                        <span class="menu-link active">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-sms fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Inbox</span>
                                            <span class="badge badge-light-success">3</span>
                                        </span>
                                        <!--end::Inbox-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Marked-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-abstract-23 fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Marked</span>
                                        </span>
                                        <!--end::Marked-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Draft-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-file fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Draft</span>
                                            <span class="badge badge-light-warning">5</span>
                                        </span>
                                        <!--end::Draft-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Sent-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-send fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Sent</span>
                                        </span>
                                        <!--end::Sent-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <!--begin::Trash-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-trash fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Trash</span>
                                        </span>
                                        <!--end::Trash-->
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--begin::Menu-->
                                <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary">
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Custom work-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-abstract-8 fs-5 text-danger me-3 lh-0">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-semibold">Custom Work</span>
                                            <span class="badge badge-light-danger">6</span>
                                        </span>
                                        <!--end::Custom work-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Partnership-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-abstract-8 fs-5 text-success me-3 lh-0">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-semibold">Partnership</span>
                                        </span>
                                        <!--end::Partnership-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::In progress-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-abstract-8 fs-5 text-info me-3 lh-0">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-semibold">In Progress</span>
                                        </span>
                                        <!--end::In progress-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <!--begin::Add label-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-plus fs-2 me-3 lh-0"></i>
                                            </span>
                                            <span class="menu-title fw-semibold">Add Label</span>
                                        </span>
                                        <!--end::Add label-->
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Aside content-->
                        </div>
                        <!--end::Sticky aside-->
                    </div> --}}
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h2 class="card-title m-0">{{__('admin.compose message')}}</h2>


                                <!--begin::Toggle-->
                                <a href="#" class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Toggle inbox menu" id="kt_inbox_aside_toggle">
                                    <i class="ki-duotone ki-burger-menu-2 fs-3 m-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </a>
                                <!--end::Toggle-->

                            </div>
                            @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <h5>Error Occured!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="card-body p-0">
                                <!--begin::Form-->
                                <form id="kt_inbox_compose_form" action="{{route('admin.messages.store')}}" method="POST">
                                    @csrf
                                    <!--begin::Body-->
                                    <div class="d-block">
                                        <!--begin::To-->
                                        <input type="hidden" name="from" value="{{Auth::user('admin')->email}}">
                                        <div class="d-flex align-items-center border-bottom px-8 min-h-50px">
                                            <label class="text-dark fw-bold w-75px">
                                                <span class="required">{{__('admin.to')}} </span>
                                                <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                                </span>
                                            </label>

                                                <select name="to[]" multiple aria-label="Select a Person" data-control="select2" data-placeholder="{{__('admin.select a person')}}" onchange="console.log($(this).val())" class="form-select form-select-solid form-select-lg fw-semibold">
                                                    <option value=""> {{__('admin.select a person')}}</option>
                                                    @forelse ($coaches as $coach)
                                                    <option value="{{$coach->email}}"  @selected( (old('to')) == $coach->id ) > {{$coach->email}} </option>
                                                    @empty
                                                    @endforelse
                                                    @forelse ($admins as $admin)
                                                    <option value="{{$admin->email}}"  @selected( (old('to')) == $admin->id ) > {{$admin->email}} </option>
                                                    @empty
                                                    @endforelse
                                                </select>

                                            <!--begin::CC & BCC buttons-->
                                            {{-- <div class="ms-auto w-75px text-end">
                                                <span class="text-muted fs-bold cursor-pointer text-hover-primary me-2" data-kt-inbox-form="cc_button">Cc</span>
                                                <span class="text-muted fs-bold cursor-pointer text-hover-primary" data-kt-inbox-form="bcc_button">Bcc</span>
                                            </div> --}}
                                            <!--end::CC & BCC buttons-->
                                        </div>
                                        <div class="border-bottom">
                                            <input class="form-control form-control-transparent border-0 px-8 min-h-45px" name="subject" value="{{old('subject')}}" placeholder="{{__('admin.subject')}}" />
                                        </div>

                                        <div class="border-bottom">
                                            <textarea name="text" placeholder="{{__('admin.enter your message')}}" class="form-control form-control-transparent border-0 px-8 min-h-45px"  cols="30" rows="10">{{old('text')}}</textarea>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center me-3">
                                            <!--begin::Send-->
                                            <div class="btn-group me-4">
                                                <!--begin::Submit-->
                                                <button type="submit" class="btn btn-primary fs-bold px-6" data-kt-inbox-form="send">
                                                    <span  class="indicator-label">{{__('sidebar.send')}}</span>
                                                </button>
                                                <!--end::Submit-->
                                                <!--begin::Send options-->
                                                <!--end::Send options-->
                                            </div>
                                            <!--end::Send-->
                                            <!--begin::Upload attachement-->
                                            <!--end::Upload attachement-->
                                            <!--begin::Pin-->
                                            <!--end::Pin-->
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Toolbar-->
                                        <div class="d-flex align-items-center">

                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Inbox App - Compose -->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>

@endsection


@push('script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/inbox/compose.js')}}"></script>
@endpush
