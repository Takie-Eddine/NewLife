@extends('admin.layouts.admin')


@section('title', 'Facility')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Facility </h1>
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
                            <a href="{{route('admin.facilities')}}" class="text-muted text-hover-primary">Facilities</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Edit Facility</li>
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
                        <form class="form" action="{{route('admin.facilities.update',$facility->id)}}" method="POST" enctype="multipart/form-data" id="kt_subscriptions_create_new">
                            @csrf
                            <!--begin::Card-->
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Edit Facility</h2>
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
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column mb-10 fv-row">
                                        <!--begin::Label-->
                                        <div class="fs-5 fw-bold required form-label mb-3">Name</div>
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid rounded-3" name="name" value="{{$facility->name}}"/>
                                    </div>
                                    <!--end::Label-->
                                    <div class="d-flex flex-column mb-10 fv-row">
                                        <!--begin::Label-->
                                        <div class="fs-5 fw-bold required form-label mb-3">Description</div>
                                        <!--end::Label-->
                                        <textarea class="form-control form-control-solid rounded-3" rows="4" name="description">{{$facility->description}}</textarea>
                                    </div>
                                    <div class="d-flex flex-column mb-10 fv-row">
                                        <!--begin::Label-->
                                        <div class="fs-5 fw-bold required form-label mb-3">Type</div>
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid rounded-3" name="type" value="{{$facility->type}}"/>
                                    </div>
                                    <div class="row g-10">
                                        @forelse ($facility->images as $image)
                                            <div class="col-md-4">
                                                <div class="card-xl-stretch me-md-6">
                                                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{asset('images/facility/'.$image->name)}}">
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{asset("images/facility/".$image->name)}}')"></div>
                                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                            <i class="ki-duotone ki-eye fs-2x text-white">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </div>
                                                    </a>
                                                    <div class="mt-5">
                                                        <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base"></a>
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3"></div>
                                                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                                                            <span class="">
                                                            <span class="fs-6 fw-semibold text-gray-400"></span></span>
                                                            <a href="{{route('admin.facilities.deleteimage',$image->id)}}" class="btn btn-sm btn-primary">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <br>
                                    <div class="separator separator-dashed mb-9"></div>
                                    <div class="fv-row">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_dropzonejs_example_1">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary" id="kt_subscriptions_create_button">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Upload </span>
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
<script>
    var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
         // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 10,
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }

            ,
        url: "{{ route('admin.facilities.store_image') }}",
        success:
            function (file, response) {
                $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                myDropzone[file.name] = response.name
            }
            ,
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = myDropzone[file.name]
            }
            $('form').find('input[name="images[]"][value="' + name + '"]').remove()
        }
        ,
    });
</script>
@endpush
