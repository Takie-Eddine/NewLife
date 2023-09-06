@extends('user.layouts.user')


@section('title', 'Contact')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('user.contact list')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('profile.home')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('user.contacts')}}</li>
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
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Contacts App- Getting Started-->
                <div class="row g-12">
                    <div class="col-lg-12 col-xl-12">
                        <!--begin::Contacts-->
                        <div class="card card-flush" id="kt_contacts_list">
                            <!--begin::Card header-->
                            <div class="card-header pt-7" id="kt_contacts_list_header">
                                <!--begin::Form-->

                                <form class="d-flex align-items-center position-relative w-100 m-0" action="{{URL::current()}}" method="GET">
                                    {{-- <div class="d-flex align-items-center position-relative my-1"> --}}
                                        <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-solid ps-13" placeholder="{{__('user.search contacts')}}" />
                                    {{-- </div> --}}
                                </form>
                                <!--end::Form-->
                            </div>
                            <div class="card-body pt-5" id="kt_contacts_list_body">
                                <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
                                    @forelse ($admins as $admin)
                                        <div class="d-flex flex-stack py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-40px symbol-circle">
                                                    <img alt="Pic" src="{{asset('images/profile/'.$admin->profile->photo)}}" />
                                                </div>
                                                <div class="ms-4">
                                                    <a href="{{route('user.contacts.view',$admin->id)}}" class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2">{{$admin->name}}</a>
                                                    <div class="fw-semibold fs-7 text-muted">{{$admin->email}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed d-none"></div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
</div>

@endsection


@push('script')


@endpush
