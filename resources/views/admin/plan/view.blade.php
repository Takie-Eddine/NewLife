@extends('admin.layouts.admin')


@section('title', 'Plan')


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
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Plan</h1>
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
                                <a href="{{route('admin.plans')}}" class="text-muted text-hover-primary">Plans</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">View Plan</li>
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
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                            <!--begin::Card-->
                            <div class="card card-flush pt-3 mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Services</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-2">
                                    <!--begin::Tab Content-->
                                    <div id="kt_referred_users_tab_content" class="tab-content">
                                        <!--begin::Tab panel-->
                                        <div id="kt_customer_details_invoices_1" class="tab-pane fade show active" role="tabpanel">
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table id="kt_customer_details_invoices_table_1" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                                    <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                                        <tr class="text-start text-gray-400">
                                                            <th class="min-w-100px">Service Name</th>
                                                            <th class="min-w-100px">Description</th>
                                                            <th class="min-w-100px">Included</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                                        @forelse ($plan->services as $service)
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 text-hover-primary">{{$service->description}}</a>
                                                                </td>
                                                                <td ><a href="#" class="text-gray-600 text-hover-primary">{{$service->plan_service->description ?? '__'}} </a>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 text-hover-primary">{{$service->plan_service->is_checked ?? '__'}} </a>
                                                                </td>
                                                            </tr>
                                                        @empty

                                                        @endforelse

                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Tab panel-->

                                    </div>
                                    <!--end::Tab Content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                            <!--begin::Card-->
                            <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Plan</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 fs-6">
                                    <!--begin::Section-->
                                    <div class="mb-7">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-100px symbol-circle me-3">
                                                <img alt="Pic" src="{{asset('images/plan/'.$plan->photo)}}" />
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Info-->
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->
                                    <!--begin::Section-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <h5 class="mb-4">Plan name</h5>
                                        <!--end::Title-->
                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Plan-->
                                            <!--end::Plan-->
                                            <!--begin::Price-->
                                            <span class="fw-semibold text-gray-600">{{$plan->name}}</span>
                                            <!--end::Price-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->
                                    <!--begin::Section-->
                                    <div class="mb-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-4">Plan description</h5>
                                        <!--end::Title-->
                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Card info-->

                                            <div class="fw-semibold text-gray-600">{{$plan->description}}</div>
                                            <!--end::Card expiry-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->
                                    <!--begin::Section-->
                                    <div class="mb-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-4">Program</h5>
                                        <!--end::Title-->
                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Card info-->

                                            <div class="fw-semibold text-gray-600">{{$plan->program->name}}</div>
                                            <!--end::Card expiry-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                        <a href="{{route('admin.plans.edit',$plan->id)}}" class="btn btn-primary" id="kt_subscriptions_create_button">Edit Plan</a>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>

@endsection


@push('script')

@endpush
