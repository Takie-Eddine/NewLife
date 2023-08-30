@extends('admin.layouts.admin')


@section('title', 'Participant')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Participant</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.participants')}}" class="text-muted text-hover-primary">Participants</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add Participant</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form action="{{route('admin.participants.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Sign-in Method *</h3>
                            </div>
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
                        <!--begin::Content-->
                        <div id="kt_account_settings_signin_method" class="collapse show">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Email Address-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <!--begin::Label-->
                                    <div id="kt_signin_email">
                                        <div class="fs-6 fw-bold mb-1">Email Address, Username, Password</div>
                                        <div class="fw-semibold text-gray-600"></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Edit-->
                                    <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                        <!--begin::Form-->
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="emailaddress" class="form-label required fs-6 fw-bold mb-3">Enter  Email Address</label>
                                                        <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="Email Address" name="email" value="{{old('email')}}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmemailpassword" class="form-label required fs-6 fw-bold mb-3"> Username</label>
                                                        <input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="Username" required id="confirmemailpassword" value="{{old('name')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="newpassword" class="form-label required fs-6 fw-bold mb-3"> Password</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" placeholder="Password" name="password" id="newpassword" required/>
                                                    </div>
                                                </div>
                                                <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                            </div>
                                            <div class="d-flex">
                                                {{-- <button id="" type="submit" class="btn btn-primary me-2 px-6">Create </button> --}}
                                                <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                            </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Edit-->
                                    <!--begin::Action-->
                                    <div id="kt_signin_email_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-primary">Create </button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Email Address-->
                                <!--begin::Separator-->
                                {{-- <div class="separator separator-dashed my-6"></div> --}}
                                <!--end::Separator-->
                                <!--begin::Password-->
                                {{-- <div class="d-flex flex-wrap align-items-center mb-10">
                                    <!--begin::Label-->
                                    <div id="kt_signin_password">
                                        <div class="fs-6 fw-bold mb-1">Password</div>
                                        <div class="fw-semibold text-gray-600">************</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Edit-->
                                    <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                        <!--begin::Form-->
                                        <form id="" class="form" novalidate="novalidate" method="POST" action="{{route('admin.profile.update_password')}}">
                                            @csrf
                                            @method('put')
                                            <div class="row mb-1">
                                                <!-- <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword" />
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="newpassword" class="form-label fs-6 fw-bold mb-3"> Password</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="newpassword" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm  Password</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="confirmpassword" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                            <div class="d-flex">
                                                <button id="" type="submit" class="btn btn-primary me-2 px-6">Create Password</button>
                                                <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                            </div>
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Edit-->
                                    <!--begin::Action-->
                                    <div id="kt_signin_password_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-primary">Create Password</button>
                                    </div>
                                    <!--end::Action-->
                                </div> --}}
                                <!--end::Password-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Content-->
                    </div>

                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Participant Details *</h3>
                            </div>

                            <!--end::Card title-->
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
                        <!--begin::Card header-->
                        <!--begin::Content-->
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <!--begin::Form-->
                                <!--begin::Card body-->
                                <div class="card-body border-top p-9">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{asset('assets/media/svg/avatars/blank.svg')}}')">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('assets/media/avatars/300-1.jpg')}})"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="ki-duotone ki-pencil fs-7">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki-duotone ki-cross fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <!--end::Cancel-->
                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="ki-duotone ki-cross fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <!--end::Remove-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{old('fname')}}" />
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="lname" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{old('lname')}}" />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Contact Phone</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{old('phone')}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Birthday</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input class="form-control form-control-solid" name="birthday" value="{{old('birthday')}}"  placeholder="Pick date " id="kt_datepicker_3"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Gender</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-check-custom ">
                                                <input type="radio"  name="gender" value="male" class="form-check-input"  @checked(old('gender') == 'male') />
                                                <label class="form-check-label" for="">Male</label>
                                            </div>
                                            <div class="form-check-custom">
                                                <input type="radio"  name="gender" value="female" class="form-check-input"   @checked(old('gender') == 'female')/>
                                                <label class="form-check-label" for="">Female</label>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Country</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-semibold">
                                                <option value="">Select a Country...</option>
                                                @foreach ($countries as $country => $value)
                                                    <option value="{{$country}}"  @selected( (old('country')) ==$country )>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">City </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="city" class="form-control form-control-lg form-control-solid" placeholder="City" value="{{old('city')}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Postal Code </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="postal_code" class="form-control form-control-lg form-control-solid" placeholder="Postal Code" value="{{old('postal_code')}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Address" value="{{old('street_address')}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    {{-- <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Communication</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <!--begin::Options-->
                                            <div class="d-flex align-items-center mt-3">
                                                <!--begin::Option-->
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                    <input class="form-check-input" name="communication[]" type="checkbox" value="1" />
                                                    <span class="fw-semibold ps-2 fs-6">Email</span>
                                                </label>
                                                <!--end::Option-->
                                                <!--begin::Option-->
                                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <input class="form-check-input" name="communication[]" type="checkbox" value="2" />
                                                    <span class="fw-semibold ps-2 fs-6">Phone</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Col-->
                                    </div> --}}
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Actions-->
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}
                                    {{-- <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Create Participant</button> --}}
                                </div>
                                <!--end::Actions-->
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>

                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Participant Medical Info *</h3>
                            </div>
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
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Weight </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="weight" class="form-control form-control-lg form-control-solid" placeholder="Weight" value="{{old('weight')}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Height </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="height" class="form-control form-control-lg form-control-solid" placeholder="Height" value="{{old('height')}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label  fw-semibold fs-6">
                                        <span class="required">Blood Type</span>

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select name="blood_type" aria-label="Select a Blood Type" data-control="select2" data-placeholder="Select a Blood Type..." class="form-select form-select-solid form-select-lg fw-semibold">
                                            <option value="">Select a Blood Type...</option>
                                                <option value="A+"  @selected( (old('blood_type')) =='A+' )>A+</option>
                                                <option value="A-"  @selected( (old('blood_type')) =='A-' )>A-</option>
                                                <option value="B+"  @selected( (old('blood_type')) =='B+' )>B+</option>
                                                <option value="B-"  @selected( (old('blood_type')) =='B-' )>B-</option>
                                                <option value="AB+"  @selected( (old('blood_type')) =='AB+' )>AB+</option>
                                                <option value="AB-"  @selected( (old('blood_type')) =='AB-' )>AB-</option>
                                                <option value="O+"  @selected( (old('blood_type')) =='O+' )>O+</option>
                                                <option value="O-"  @selected( (old('blood_type')) =='O-' )>O-</option>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Sugar </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="sugar" class="form-control form-control-lg form-control-solid" placeholder="Sugar" value="{{old('sugar')}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tension </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="tension" class="form-control form-control-lg form-control-solid" placeholder="Tension" value="{{old('tension')}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Oxygen</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="oxygen" class="form-control form-control-lg form-control-solid" placeholder="Oxygen" value="{{old('oxygen')}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Sleep Hour</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="sleep_hour" class="form-control form-control-lg form-control-solid" placeholder="Sleep Hour" value="{{old('sleep_hour')}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Participant Plan *</h3>
                            </div>
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
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Program </span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="program" aria-label="Select a Program" data-control="select2" data-placeholder="Select a Program..." onchange="console.log($(this).val())" class="form-select form-select-solid form-select-lg fw-semibold">
                                            <option value=""> Select a Program...</option>
                                            @forelse ($programs as $program)
                                            <option value="{{$program->id}}"  @selected( (old('program')) == $program->id ) > {{$program->name}} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Plan </span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="plan" aria-label="Select a Plan" data-control="select2" data-placeholder="Select a Plan..." class="form-select form-select-solid form-select-lg fw-semibold">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button type="submit" class="btn btn-primary" >Create Participant</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
</div>

@endsection


@push('script')
        <script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
		<script src="{{asset('assets/js/custom/account/settings/profile-details.js')}}"></script>
		<script src="{{asset('assets/js/custom/account/settings/deactivate-account.js')}}"></script>
		<script src="{{asset('assets/js/custom/pages/user-profile/general.js')}}"></script>
        <script>
            $("#kt_datepicker_3").flatpickr({
                // enableTime: true,
                // dateFormat: "Y-m-d H:i",
            });
        </script>

        <script>
            $(document).ready(function(){
                $('select[name="program"]').on('change', function(){
                    var program = $(this).val();
                    if (program) {
                        $.ajax({
                            url: "{{URL::to('admin/participant/plans')}}/" + program,
                            type: "GET",
                            dataType: "json",
                            success :function(data){
                                $('select[name="plan"]').empty();
                                $.each(data, function(key, value){
                                    $('select[name="plan"]').append(' <option value=""> Select a Plan...</option>');
                                    $('select[name="plan"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        });
                    } else{
                        console.log('AJAX load did not work');
                    };
                })
            });
        </script>

@endpush
