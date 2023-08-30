@extends('admin.layouts.admin')


@section('title', 'Program')


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
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Program</h1>
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
                                <a href="{{route('admin.programs')}}" class="text-muted text-hover-primary">Programs</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">View Program</li>
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
                                    <div class="card-title">
                                        <h2 class="fw-bold">Plan </h2>
                                    </div>
                                </div>
                                <div class="card-body pt-3">
                                    @forelse ($program->plans as $plan)
                                        <div>
                                            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                                                <h3 class="card-title">{{$plan->name}}</h3>
                                                <div class="card-toolbar rotate-180">
                                                    <i class="ki-duotone ki-down fs-1"></i>
                                                </div>
                                            </div>
                                            <div id="kt_docs_card_collapsible" class="collapse ">
                                                <div class="card-body">
                                                    {{$plan->description}}
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="card card-flush pt-3 mb-5 mb-xl-10">
                                <div class="card-header">

                                    <div class="card-title">
                                        <h2>Feature</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5" id="kt_table_customers_events">
                                            <tbody>
                                                @forelse ($program->features as $feature)
                                                    <tr>
                                                        <div>
                                                            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                                                                <h3 class="card-title">{{$feature->name}}</h3>
                                                                <div class="card-toolbar rotate-180">
                                                                    <i class="ki-duotone ki-down fs-1"></i>
                                                                </div>
                                                            </div>
                                                            <div id="kt_docs_card_collapsible" class="collapse ">
                                                                @forelse ($feature->services as $service)
                                                                    <div class="card-body">
                                                                        {{$service->description}}
                                                                    </div>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
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
                                        <h2>Program</h2>
                                    </div>
                                    <!--end::Card title-->
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
                                                <img alt="Pic" src="{{asset('images/program/'.$program->photo)}}" />
                                            </div>
                                            <!--end::Avatar-->
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
                                        <h5 class="mb-4">Program name</h5>
                                        <!--end::Title-->
                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Plan-->
                                            <!--end::Plan-->
                                            <!--begin::Price-->
                                            <span class="fw-semibold text-gray-600">{{$program->name}}</span>
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
                                        <h5 class="mb-4">Program description</h5>
                                        <!--end::Title-->
                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Card expiry-->
                                            <div class="fw-semibold text-gray-600">{{$program->description}}</div>
                                            <!--end::Card expiry-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Seperator-->
                                    <!--end::Seperator-->
                                    <!--begin::Section-->

                                    <!--end::Section-->
                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                        <a href="{{route('admin.programs.edit',$program->id)}}" class="btn btn-primary" id="kt_subscriptions_create_button">Edit Program</a>
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
