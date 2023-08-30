@extends('admin.layouts.admin')


@section('title', 'Role')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Role</h1>
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
                            <a href="{{route('admin.roles')}}" class="text-muted text-hover-primary">Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">View Role</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="d-flex flex-column flex-lg-row">
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="mb-0">{{$role->name}}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column text-gray-600">
                                    @forelse ($role-> permissions as $permission)
                                        <div class="d-flex align-items-center py-2">
                                        <span class="bullet bg-primary me-3"></span>{{$permission}}</div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-footer pt-0">
                                <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-light btn-active-primary" >Edit Role</a>
                            </div>
                        </div>

                        <!--end::Modal - Update role-->
                        <!--end::Modal-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-10">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header pt-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="d-flex align-items-center">Admins Assigned
                                    <span class="text-gray-600 fs-6 ms-1">({{$role->admins->count()}})</span></h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Search-->
                                    <form action="{{URL::current()}}" method="GET">
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"  data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Admins" />
                                        </div>
                                    </form>
                                    <!--end::Search-->
                                    <!--begin::Group actions-->
                                    {{-- <div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected</div>
                                        <button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
                                    </div> --}}
                                    <!--end::Group actions-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" >
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            {{-- <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
                                                </div>
                                            </th> --}}
                                            <th class="min-w-50px">ID</th>
                                            <th class="min-w-150px">User</th>
                                            <th class="min-w-125px">Created Date</th>
                                            {{-- <th class="text-end min-w-100px">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="{{'admin.users.view',$user->id}}">
                                                            <div class="symbol-label">
                                                                @if ($user->profile->photo)
                                                                    <img src="{{asset('images/profile/'.$user->profile->photo)}}" alt="{{$user->profile->first_name.' '.$user->profile->last_name}}" class="w-100" />
                                                                @else
                                                                    <img src="{{asset('images/no-image.png')}}" alt="{{$user->profile->first_name.' '.$user->profile->last_name}}" class="w-100" />
                                                                @endif

                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    <div class="d-flex flex-column">
                                                        <a href="{{route('admin.users.view',$user->id)}}" class="text-gray-800 text-hover-primary mb-1">{{$user->profile->first_name.' '.$user->profile->last_name}}</a>
                                                        <span>{{$user->email}}</span>
                                                    </div>
                                                    <!--begin::User details-->
                                                </td>
                                                <td>{{$user->created_at}}</td>
                                                {{-- <td class="text-end">
                                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 m-0"></i></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td> --}}
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">No admins defined.</td>
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
<script src="{{asset('assets/js/custom/apps/user-management/roles/view/view.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/roles/view/update-role.js')}}"></script>
@endpush
