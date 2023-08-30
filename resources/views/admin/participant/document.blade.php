@extends('admin.layouts.admin')


@section('title', 'Participant')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Participant</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.participants')}}" class="text-muted text-hover-primary">Participants</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">View Participant</li>
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
                <!--begin::Navbar-->
                @include('admin.participant.header')
                <!--end::Navbar-->
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Title-->
                    <h3 class="fw-bold my-2">My Documents
                    <span class="fs-6 text-gray-400 fw-semibold ms-1">{{$files->count()}}</span></h3>
                    <!--end::Title-->
                    <!--begin::Controls-->
                    <div class="d-flex my-2">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <form action="{{URL::current()}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search File" />
                                </div>
                            </form>
                        </div>
                        <a href="{{route('admin.tests.create')}}" class="btn btn-primary btn-sm">Upload Document</a>
                    </div>
                </div>
                <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                    @forelse ($files as $file)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <a href="{{route('admin.tests.download',$file->id)}}" class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="{{asset('assets/media/svg/files/doc.svg')}}" class="theme-light-show" alt="" />
                                            <img src="{{asset('assets/media/svg/files/doc-dark.svg')}}" class="theme-dark-show" alt="" />
                                        </div>
                                        <div class="fs-5 fw-bold mb-2">{{$file->name}}</div>
                                    </a>
                                    <div class="fs-7 fw-semibold text-gray-400">{{ $file->created_at->longAbsoluteDiffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@push('script')

<script src="{{asset('assets/js/custom/pages/user-profile/general.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/type.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/details.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/finance.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/complete.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/main.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
@endpush
