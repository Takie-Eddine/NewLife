@extends('user.layouts.user')


@section('title', 'Profile')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Account Overview</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.profile')}}" class="text-muted text-hover-primary">Account</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Coach</li>
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
            <div id="kt_app_content_container" class="app-container container-xxl">
                @include('user.profile.header')
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <h3 class="text-gray-800 fw-bold my-2">Coach
                    <span class="fs-6 text-gray-400 fw-semibold ms-1">({{$coaches->count()}})</span></h3>
                </div>
                <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
                    @forelse ($coaches as $coach)
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        @if ($coach->profile->photo)
                                            <img src="{{asset('images/coach/'.$coach->profile->photo)}}" alt="image" />
                                        @else
                                            <img src="{{asset('images/no-image.png')}}" alt="image" />
                                        @endif

                                        <div class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3"></div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    @if ($coach->profile->first_name)
                                        <a href="{{route('user.coaches.view',$coach->id)}}" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{$coach->profile->first_name}} {{$user->profile->last_name}}</a>
                                    @else
                                        <a href="{{route('user.coaches.view',$coach->id)}}" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{$coach->name}}</a>
                                    @endif

                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">{{$coach->type}}</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    {{-- <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div> --}}
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    {{-- <button class="btn btn-sm btn-light-primary btn-flex btn-center" data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-check following fs-3"></i>
                                        <i class="ki-duotone ki-plus follow fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Following</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button> --}}
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
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
