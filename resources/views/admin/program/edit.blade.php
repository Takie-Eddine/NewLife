@extends('admin.layouts.admin')


@section('title', 'Program')


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
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Program</h1>
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
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Edit Program</li>
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
                            <!--begin::Form-->
                            <form class="form" action="{{route('admin.programs.update',$program->id)}}" method="POST" enctype="multipart/form-data" id="kt_subscriptions_create_new">
                                @csrf
                                <!--begin::Card-->
                                <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2 class="fw-bold">Program</h2>
                                        </div>

                                        <!--begin::Card title-->
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
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Custom fields-->
                                        <div class="d-flex flex-column mb-15 fv-row">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-empty" data-kt-image-input="true">
                                                <!--begin::Image preview wrapper-->
                                                <div class="image-input-wrapper w-125px h-125px"></div>
                                                <!--end::Image preview wrapper-->

                                                <!--begin::Edit button-->
                                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change"
                                                data-bs-toggle="tooltip"
                                                data-bs-dismiss="click"
                                                title="Add photo">
                                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                                    <!--begin::Inputs-->
                                                    <input type="file" name="avatar"  accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Edit button-->

                                                <!--begin::Cancel button-->
                                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel"
                                                data-bs-toggle="tooltip"
                                                data-bs-dismiss="click"
                                                title="Cancel avatar">
                                                    <i class="ki-outline ki-cross fs-3"></i>
                                                </span>
                                                <!--end::Cancel button-->

                                                <!--begin::Remove button-->
                                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove"
                                                data-bs-toggle="tooltip"
                                                data-bs-dismiss="click"
                                                title="Remove avatar">
                                                    <i class="ki-outline ki-cross fs-3"></i>
                                                </span>
                                                <!--end::Remove button-->
                                            </div>
                                            <br>
                                            <div class="symbol symbol-100px symbol me-3">
                                                <img alt="Pic" src="{{asset('images/program/'.$program->photo)}}" />
                                            </div>
                                            <br>
                                            <!--end::Image input-->
                                            <!--begin::Label-->
                                            <div class="d-flex flex-column mb-10 fv-row">
                                                <!--begin::Label-->
                                                <div class="fs-5 fw-bold required form-label mb-3">Name</div>
                                                <!--end::Label-->
                                                <input class="form-control form-control-solid rounded-3" name="name" value="{{$program->name}}"/>
                                            </div>
                                            <!--end::Label-->
                                            <div class="d-flex flex-column mb-10 fv-row">
                                                <!--begin::Label-->
                                                <div class="fs-5 fw-bold required form-label mb-3">Description</div>
                                                <!--end::Label-->
                                                <textarea class="form-control form-control-solid rounded-3" rows="4" name="description">{{$program->description}}</textarea>
                                            </div>


                                            <div id="kt_docs_repeater_nested">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="features">
                                                        @forelse ($program->features as $feature)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label required">Feature Name:</label>
                                                                        <input type="text" class="form-control mb-2 mb-md-0" placeholder="Enter feature name" name="feature" value="{{$feature->name}}" />
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="inner-repeater">
                                                                            <div data-repeater-list="services" class="mb-5">
                                                                                @forelse ($feature->services as $service)
                                                                                    <div data-repeater-item>
                                                                                        <label class="form-label required">Service Name:</label>
                                                                                        <div class="input-group pb-3">
                                                                                            <input type="text" class="form-control" placeholder="Enter service name" name="service" value="{{$service->description}}" />
                                                                                            <button class="border border-secondary btn btn-icon btn-flex btn-light-danger" data-repeater-delete type="button">
                                                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                @empty
                                                                                @endforelse
                                                                            </div>
                                                                            <button class="btn btn-sm btn-flex btn-light-primary" data-repeater-create type="button">
                                                                                <i class="ki-duotone ki-plus fs-5"></i>
                                                                                Add Service
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-flex btn-light-danger mt-3 mt-md-9">
                                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                            Delete Row
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <!--end::Form group-->

                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                                                        <i class="ki-duotone ki-plus fs-3"></i>
                                                        Add Feature
                                                    </a>
                                                </div>
                                                <!--end::Form group-->
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Card body-->

                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary" id="kt_subscriptions_create_button">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Edit Program</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Card-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
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
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/subscriptions/add/advanced.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/subscriptions/add/customer-select.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/subscriptions/add/products.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/new-card.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script>
    $('#kt_docs_repeater_nested').repeater({
        repeaters: [{
            selector: '.inner-repeater',
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        }],
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endpush
