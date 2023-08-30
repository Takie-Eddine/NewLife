@extends('admin.layouts.admin')


@section('title', 'Food')


@push('style')

@endpush

@section('content')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Food</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.foods')}}" class="text-muted text-hover-primary">foods</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">View Food</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="position-relative mb-17">
                        </div>
                        <div class="d-flex flex-column flex-lg-row mb-17">
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                <div class="mb-17">
                                    <div class="m-0">
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">{{$food->date}}</h4>
                                    </div>
                                    @forelse ($food->types as $type)
                                        <div class="m-0">
                                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_2">
                                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </div>
                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">{{$type->type}}</h4>
                                            </div>
                                            <div id="kt_job_1_2" class="collapse fs-6 ms-1">
                                                @forelse ($type->meals as $meal)
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                                            <span class="bullet me-3"></span>
                                                            <div class="text-gray-600 fw-semibold fs-6">{{$meal->name}}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                                            <span class="bullet me-3"></span>
                                                            <div class="text-gray-600 fw-semibold fs-6">{{$meal->description}}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                                            @if ($meal->photo)
                                                                <img src="{{asset('images/food/'.$meal->photo)}}" alt="">
                                                            @else
                                                                <img src="{{asset('images/no-image.png')}}" alt="">
                                                            @endif

                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                            <div class="separator separator-dashed"></div>
                                        </div>
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
</div>




@endsection


@push('script')

@endpush
