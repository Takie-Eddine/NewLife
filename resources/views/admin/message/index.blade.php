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
                        <li class="breadcrumb-item text-muted">{{__('sidebar.inbox')}}</li>
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
                <!--begin::Inbox App - Messages -->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="d-none d-lg-flex flex-column flex-lg-row-auto w-100 w-lg-275px" data-kt-drawer="true" data-kt-drawer-name="inbox-aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_inbox_aside_toggle">
                        <!--begin::Sticky aside-->
                        <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '100px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                            <!--begin::Aside content-->
                            <div class="card-body">
                                <!--begin::Button-->
                                <a href="{{route('admin.messages.create')}}" class="btn btn-primary fw-bold w-100 mb-8">{{__('admin.new message')}}</a>
                                <!--end::Button-->
                                <!--begin::Menu-->
                                <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Inbox-->
                                        <a class="menu-link " href="{{route('admin.messages')}}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-sms fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">{{__('sidebar.inbox')}}</span>
                                        </a>
                                        {{-- <span class="menu-link active">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-sms fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Inbox</span>
                                        </span> --}}
                                        <!--end::Inbox-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item mb-3">
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
                                    </div> --}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item mb-3">
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
                                    </div> --}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <!--begin::Sent-->
                                        <a class="menu-link " href="{{route('admin.messages.send')}}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-send fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">{{__('sidebar.send')}}</span>
                                        </a>
                                        {{-- <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-send fs-2 me-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title fw-bold">Sent</span>
                                        </span> --}}
                                        <!--end::Sent-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item">
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
                                    </div> --}}
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Aside content-->
                        </div>
                        <!--end::Sticky aside-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Actions-->
                                <div class="d-flex flex-wrap gap-2">
                                    {{-- <!--begin::Checkbox-->
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-4 me-lg-7">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_inbox_listing .form-check-input" value="1" />
                                    </div>
                                    <!--end::Checkbox-->
                                    <!--begin::Reload-->
                                    <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Reload">
                                        <i class="ki-duotone ki-arrows-circle fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--end::Reload-->
                                    <!--begin::Archive-->
                                    <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Archive">
                                        <i class="ki-duotone ki-sms fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--end::Archive-->
                                    <!--begin::Delete-->
                                    <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Delete">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                    <!--end::Delete-->
                                    <!--begin::Filter-->
                                    <div>
                                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                            <i class="ki-duotone ki-down fs-2"></i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_all">All</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_read">Read</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_unread">Unread</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_starred">Starred</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_unstarred">Unstarred</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Filter-->
                                    <!--begin::Sort-->
                                    <span>
                                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Sort">
                                            <i class="ki-duotone ki-dots-square fs-3 m-0">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="filter_newest">Newest</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="filter_oldest">Oldest</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="filter_unread">Unread</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </span>
                                    <!--end::Sort--> --}}
                                </div>
                                <!--end::Actions-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative">
                                        <form action="{{URL::current()}}" method="GET">
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="{{__('admin.search inbox')}}" />
                                            </div>
                                        </form>
                                    </div>
                                    <!--end::Search-->
                                    <!--begin::Toggle-->
                                    {{-- <a href="#" class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Toggle inbox menu" id="kt_inbox_aside_toggle">
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
                                    </a> --}}
                                    <!--end::Toggle-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <div class="card-body p-0">
                                <!--begin::Table-->
                                <table class="table table-hover table-row-dashed fs-6 gy-5 my-0" >
                                    <thead class="d-none">
                                        <tr>
                                            <th class="min-w-5px">Actions</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($messages as $message)
                                            <tr>
                                                <td class="min-w-5px">
                                                    <!--begin::Star-->
                                                    <a href="{{route('admin.messages.view',$message->id)}}" class="btn btn-icon btn-color-gray-400 btn-active-color-primary w-35px h-35px" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">
                                                        <i class="ki-duotone ki-trash ">
                                                            <i class="path1"></i>
                                                            <i class="path2"></i>
                                                            <i class="path3"></i>
                                                            <i class="path4"></i>
                                                            <i class="path5"></i>
                                                        </i>
                                                    </a>
                                                    <!--end::Star-->
                                                </td>
                                                <td class="w-150px w-md-175px">
                                                    <a href="{{route('admin.messages.view',$message->id)}}" class="d-flex align-items-center text-dark">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px me-3">
                                                            <div class="symbol-label bg-light-danger">
                                                                <span class="text-danger">S</span>
                                                            </div>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Name-->
                                                        <span class="fw-semibold">{{$message->from}}</span>
                                                        <!--end::Name-->
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="text-dark gap-1 pt-2">
                                                        <!--begin::Heading-->
                                                        <a href="{{route('admin.messages.view',$message->id)}}" class="text-dark">
                                                            <span class="fw-bold">{{$message->subject}}</span>
                                                            <span class="fw-bold d-none d-md-inine">-</span>
                                                            {{-- <span class="d-none d-md-inine text-muted">Thank you for ordering UFC 240 Holloway vs Edgar Alternate camera angles...</span> --}}
                                                        </a>
                                                        <!--end::Heading-->
                                                    </div>
                                                    <!--begin::Badges-->
                                                    {{-- <div class="badge badge-light-primary">inbox</div>
                                                    <div class="badge badge-light-warning">task</div> --}}
                                                    <!--end::Badges-->
                                                </td>
                                                <td class="w-100px text-end fs-7 pe-9">
                                                    <span class="fw-semibold">{{$message->created_at->longAbsoluteDiffForHumans()}}</span>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">No messages defined.</td>
                                        </tr>
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
</div>

@endsection


@push('script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/inbox/listing.js')}}"></script>
@endpush
