@extends('user.layouts.user')


@section('title', 'Specialist')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Coach</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Coaches</li>
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
                <!--begin::Heading-->
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Title-->
                    <h3 class="fw-bold my-2">Coaches
                    <span class="fs-6 fw-semibold ms-1">({{$coaches->count()}})</span></h3>
                    <!--end::Title-->
                    <!--begin::Controls-->
                    <div class="d-flex my-2">
                        <!--begin::Select-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <form action="{{URL::current()}}" method="GET">
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fs-5 fw-semibold mb-3">Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="type" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select Type" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                                    <option></option>
                                                    @forelse ($coaches as $coach)
                                                        <option value="{{$coach->type}}" {{ old('type', request()->input('type')) == $coach->type ? 'selected' : '' }}>{{$coach->type}}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
                                                <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                    </form>
                                    <!--end::Content-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-6 g-xl-9">
                    @forelse ($coaches as $coach)
                        <div class="col-md-6 col-xxl-4">
                            <div class="card">
                                <div class="card-body d-flex flex-center flex-column p-9">
                                    <div class="mb-5">
                                        <div class="symbol symbol-75px symbol-circle">
                                            @if ($coach->profile->photo)
                                                <img alt="Pic" src="{{asset('images/coach/'.$coach->profile->photo)}}" />
                                            @else
                                                <img alt="Pic" src="{{asset('images/no-image.png')}}" />
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{route('user.coaches.view',$coach->id)}}" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{$coach->profile->first_name.' '.$coach->profile->last_name }}</a>
                                    <div class="fw-semibold text-gray-400 mb-6">{{$coach->type}}</div>
                                    {{-- <div class="d-flex flex-center flex-wrap mb-5">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Avg. Earnings</div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 mx-3 px-4 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Total Sales</div>
                                        </div>
                                    </div> --}}
                                    {{-- <button class="btn btn-sm btn-light-primary fw-bold" data-kt-drawer-show="true" data-kt-drawer-target="#kt_drawer_chat">Send Message</button> --}}
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                {{-- <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">Showing 1 to 10 of 50 entries</div>
                    <!--begin::Pages-->
                    <ul class="pagination">
                        <li class="page-item previous">
                            <a href="#" class="page-link">
                                <i class="previous"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">6</a>
                        </li>
                        <li class="page-item next">
                            <a href="#" class="page-link">
                                <i class="next"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Pages-->
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/customers/list/export.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/customers/list/list.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/customers/add.js')}}"></script>
		<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>

@endpush
