@extends('admin.layouts.admin')


@section('title', 'Chat')


@push('style')
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> {{__('sidebar.chat')}}</h1>
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
                        <li class="breadcrumb-item text-muted">{{__('sidebar.chat')}}</li>
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                        <!--begin::Contacts-->
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header pt-7" id="kt_chat_contacts_header">
                                <!--begin::Form-->
                                <form action="{{URL::current()}}" method="GET">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="{{__('admin.search person')}}" />
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-5" id="kt_chat_contacts_body">
                                <!--begin::List-->
                                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
                                    @forelse ($users as $user)
                                        <div class="d-flex flex-stack py-4">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px symbol-circle">
                                                    <img class="symbol-label bg-light-danger text-danger fs-6 fw-bolder" src="{{asset('images/participant/'.$user->profile->photo)}}" alt="">
                                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="{{route('admin.chats.create_user',$user->id)}}" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{$user->name}}</a>
                                                    <div class="fw-semibold text-muted">{{$user->email}}</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Lat seen-->
                                            <div class="d-flex flex-column align-items-end ms-2">
                                                <span class="text-muted fs-7 mb-1">2 weeks</span>
                                                <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                            </div>
                                            <!--end::Lat seen-->
                                        </div>
                                        <div class="separator separator-dashed d-none"></div>
                                    @empty
                                    @endforelse
                                    @forelse ($admins as $admin)
                                        <div class="d-flex flex-stack py-4">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px symbol-circle">
                                                    <img class="symbol-label bg-light-danger text-danger fs-6 fw-bolder" src="{{asset('images/profile/'.$admin->profile->photo)}}" alt="">
                                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="{{route('admin.chats.create_admin',$admin->id)}}" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{$admin->name}}</a>
                                                    <div class="fw-semibold text-muted">{{$admin->email}}</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Lat seen-->
                                            <div class="d-flex flex-column align-items-end ms-2">
                                                <span class="text-muted fs-7 mb-1">2 weeks</span>
                                                <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                            </div>
                                            <!--end::Lat seen-->
                                        </div>
                                        <div class="separator separator-dashed d-none"></div>
                                    @empty
                                    @endforelse
                                    @forelse ($coaches as $coach)
                                        <div class="d-flex flex-stack py-4">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px symbol-circle">
                                                    <img class="symbol-label bg-light-danger text-danger fs-6 fw-bolder" src="{{asset('images/coach/'.$coach->profile->photo)}}" alt="">
                                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="{{route('admin.chats.create_coach',$coach->id)}}" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{$coach->name}}</a>
                                                    <div class="fw-semibold text-muted">{{$coach->email}}</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Lat seen-->
                                            <div class="d-flex flex-column align-items-end ms-2">
                                                <span class="text-muted fs-7 mb-1">2 weeks</span>
                                                <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                            </div>
                                            <!--end::Lat seen-->
                                        </div>
                                        <div class="separator separator-dashed d-none"></div>
                                    @empty
                                    @endforelse
                                </div>
                                <!--end::List-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Contacts-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->

                    <!--end::Content-->
                </div>
                <!--end::Layout-->
                <!--begin::Modals-->
                <!--begin::Modal - View Users-->

                <!--end::Modal - View Users-->
                <!--begin::Modal - Users Search-->

                <!--end::Modal - Users Search-->
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</div>


@endsection


@push('script')
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
@endpush
