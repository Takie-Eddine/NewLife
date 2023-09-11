@extends('admin.layouts.admin')


@section('title', 'Task')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('admin.tasks')}}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{__('admin.task')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    @include('admin.layouts.alerts.flash')
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <form action="{{URL::current()}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="{{__('admin.search task')}}" />
                                </div>
                            </form>
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{__('admin.filter')}}
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-4 text-dark fw-bold">{{__('admin.filter option')}}</div>
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
                                                <label class="form-label fs-5 fw-semibold mb-3">{{__('admin.status')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="status" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{__('admin.select status')}}" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                                    <option></option>
                                                    <option value="Pending" {{ old('status', request()->input('status')) == 'Pending' ? 'selected' : '' }}>{{__('admin.pending')}}</option>
                                                    <option value="In Progress" {{ old('status', request()->input('status')) == 'In Progress' ? 'selected' : '' }}>{{__('admin.in progress')}}</option>
                                                    <option value="Completed" {{ old('status', request()->input('status')) == 'Completed' ? 'selected' : '' }}>{{__('admin.complete')}}</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">{{__('admin.reset')}}</button>
                                                <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">{{__('admin.apply')}}</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                    </form>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                <!--begin::Export-->
                                {{-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                                    <i class="ki-duotone ki-exit-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Export
                                </button> --}}
                                <!--end::Export-->
                                <!--begin::Add customer-->
                                <a  class="btn btn-primary"  href="{{route('admin.tasks.create')}}">{{__('admin.add task')}}</a>
                                <!--end::Add customer-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            {{-- <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                                    <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                            </div> --}}
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" >
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    {{-- <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                        </div>
                                    </th> --}}
                                    <th class="min-w-125px">{{__('admin.name')}} </th>
                                    <th class="min-w-125px">{{__('admin.description')}}</th>
                                    <th class="min-w-125px">{{__('admin.status')}}</th>
                                    <th class="min-w-125px">{{__('admin.admin')}}</th>
                                    <th class="min-w-125px">{{__('admin.created date')}}</th>
                                    <th class="text-end min-w-70px">{{__('admin.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse ($tasks as $task)
                                    <tr>
                                        {{-- <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td> --}}
                                        <td>
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$task->name}}</a>
                                        </td>
                                        <td>
                                                <a href="#" class="text-gray-600 text-hover-primary mb-1">{{$task->description}} <br> </a>
                                        </td>
                                        <td >
                                            @if ($task->status == 'Completed')
                                                <span class="badge py-3 px-4 fs-7 badge-light-success">{{$task->status}}</span>
                                            @endif
                                            @if ($task->status == 'Pending')
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">{{$task->status}}</span>
                                            @endif
                                            @if ($task->status == 'In Progress')
                                                <span class="badge py-3 px-4 fs-7 badge-light-info">{{$task->status}}</span>
                                            @endif


                                        </td>
                                        <td>
                                            <a href="{{route('admin.users.view',$task->admin->id)}}" class="text-gray-600 text-hover-primary mb-1">{{$task->admin->name}}<br> </a>
                                        </td>
                                        <td>{{$task->created_at}}</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{__('admin.actions')}}
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.tasks.edit',$task->id)}}" class="menu-link px-3"> {{__('admin.edit')}} </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.tasks.delete',$task->id)}}" class="menu-link px-3"> {{__('admin.delete')}} </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No tasks defined.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->

                <!--end::Modal - Customers - Add-->
                <!--begin::Modal - Adjust Balance-->
                <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Export Customers</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_customers_export_form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold form-label mb-5">Select Export Format:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                                            <option value="excell">Excel</option>
                                            <option value="pdf">PDF</option>
                                            <option value="cvs">CVS</option>
                                            <option value="zip">ZIP</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Row-->
                                    <div class="row fv-row mb-15">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold form-label mb-5">Payment Type:</label>
                                        <!--end::Label-->
                                        <!--begin::Radio group-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Radio button-->
                                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                <input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">All</span>
                                            </label>
                                            <!--end::Radio button-->
                                            <!--begin::Radio button-->
                                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                <input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">Visa</span>
                                            </label>
                                            <!--end::Radio button-->
                                            <!--begin::Radio button-->
                                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                <input class="form-check-input" type="checkbox" value="3" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">Mastercard</span>
                                            </label>
                                            <!--end::Radio button-->
                                            <!--begin::Radio button-->
                                            <label class="form-check form-check-custom form-check-sm form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="4" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">American Express</span>
                                            </label>
                                            <!--end::Radio button-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Actions-->
                                    <div class="text-center">
                                        <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard</button>
                                        <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - New Card-->
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
    </div>

</div>

@endsection


@push('script')
    <script src="{{asset('assets/js/custom/apps/user-management/roles/list/add.js')}}"></script>
	<script src="{{asset('assets/js/custom/apps/user-management/roles/list/update-role.js')}}"></script>
@endpush
