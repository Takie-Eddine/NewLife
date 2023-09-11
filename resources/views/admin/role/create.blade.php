@extends('admin.layouts.admin')


@section('title', 'Role')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('admin.role')}}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roles')}}" class="text-muted text-hover-primary">{{__('admin.roles')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{__('admin.add role')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                    <div >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">{{__('admin.add role')}}</h2>
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
                            <div >
                                <form action="{{route('admin.roles.store')}}" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7"   data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-10">
                                            <label class="fs-5 fw-bold form-label mb-2">
                                                <span class="required">{{__('admin.role name')}}</span>
                                            </label>
                                            <input class="form-control form-control-solid" placeholder="{{__('admin.enter a role name')}}" name="name" value="{{old('name')}}" />
                                        </div>
                                        <div class="fv-row">
                                            <label class="fs-5 fw-bold form-label mb-2">{{__('admin.role permissions')}}</label>
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <tbody class="text-gray-600 fw-semibold">
                                                        {{-- <tr>
                                                            <td class="text-gray-800">Administrator Access
                                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Allows a full access to the system">
                                                                <i class="ki-duotone ki-information fs-7">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span></td>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-custom form-check-solid me-9">
                                                                    <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                                    <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                        </tr> --}}
                                                        @forelse (config('global.permissions') as $name => $value)
                                                            <tr>
                                                                <td class="text-gray-800">{{ $value }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                            <input class="form-check-input" type="checkbox" value="{{ $name }}" name="permissions[]" />
                                                                            <span class="form-check-label">{{__('admin.check')}}</span>
                                                                        </label>

                                                                        {{-- <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                            <input class="form-check-input" type="checkbox" value="" name="user_management_write" />
                                                                            <span class="form-check-label">Write</span>
                                                                        </label> --}}
                                                                        {{-- <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="checkbox" value="" name="user_management_create" />
                                                                            <span class="form-check-label">Create</span>
                                                                        </label> --}}
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
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}
                                        <button type="submit" class="btn btn-primary" >{{__('admin.create role')}}</button>
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
	<script src="{{asset('assets/js/custom/apps/user-management/roles/list/update-role.js')}}"></script>
@endpush
