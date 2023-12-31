@extends('user.layouts.user')


@section('title', 'Profile')


@push('style')

    <link href="{{asset('ssets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('profile.account settings')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('profile.home')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.profile')}}" class="text-muted text-hover-primary">{{__('profile.account')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('profile.edit account')}}</li>
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
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Navbar-->
                @include('user.profile.header')
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    @include('user.layouts.alerts.flash')
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{__('profile.profile details')}}</h3>
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
                        <form id="" class="form" action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{__('profile.avatar')}}</label>
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
                                        <div class="form-text">{{__('profile.allowed')}}</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{__('profile.full name')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{__('profile.first name')}}" value="{{$user->profile->first_name}}" />
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text" name="lname" class="form-control form-control-lg form-control-solid" placeholder="{{__('profile.last name')}}" value="{{$user->profile->last_name}}" />
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
                                        <span class="required">{{__('profile.contact phone')}}</span>
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
                                        <input type="text" name="phone" class="form-control form-control-lg form-control-solid" placeholder="{{__('profile.phone number')}}" value="{{$user->profile->phone}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{__('profile.birthday')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input class="form-control form-control-solid" name="birthday" value="{{$user->profile->birthday}}"  placeholder="{{__('profile.pick date')}} " id="kt_datepicker_3"/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{__('profile.gender')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-check-custom ">
                                            <input type="radio" id="" name="gender" value="male" class="form-check-input" @if ($user->profile->gender === 'male')
                                                checked
                                            @endif  />
                                            <label class="form-check-label" for="">{{__('profile.male')}}</label>
                                        </div>
                                        <div class="form-check-custom">
                                            <input type="radio" id="" name="gender" value="female" class="form-check-input" @if ($user->profile->gender == 'female')
                                            checked
                                        @endif  />
                                            <label class="form-check-label" for="">{{__('profile.female')}}</label>
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
                                        <span class="required">{{__('profile.country')}}</span>
                                        {{-- <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span> --}}
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="{{__('profile.select a country')}}" class="form-select form-select-solid form-select-lg fw-semibold">
                                            <option value="">{{__('profile.select a country')}}</option>
                                            @foreach ($countries as $country => $value)
                                                <option value="{{$country}}"  @selected($country == $user->profile->country)>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{__('profile.city')}} </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="city" class="form-control form-control-lg form-control-solid" placeholder="{{__('profile.city')}}" value="{{$user->profile->city}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{__('profile.postal code')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="postal_code" class="form-control form-control-lg form-control-solid" placeholder="{{__('profile.postal code')}}" value="{{$user->profile->postal_code}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{__('profile.address')}} </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="{{__('profile.address')}}" value="{{$user->profile->street_address}}" />
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
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">{{__('profile.discard')}} </button>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('profile.save changes')}} </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{__('profile.sign in method')}} </h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Email Address-->
                            <div class="d-flex flex-wrap align-items-center">
                                <!--begin::Label-->
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1">{{__('profile.email address')}} </div>
                                    <div class="fw-semibold text-gray-600">{{$user->email}}</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="kt_signin_change_email" class="form" novalidate="novalidate" method="POST" action="{{route('user.profile.update_email')}}">
                                        @csrf
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">{{__('profile.enter email')}}</label>
                                                    <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="{{__('profile.email address')}} " name="email" value="{{$user->email}}" />
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="confirmemailpassword" required id="confirmemailpassword" />
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex">
                                            <button id="" type="submit" class="btn btn-primary me-2 px-6">{{__('profile.update email')}}</button>
                                            <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{__('profile.cancel')}}</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">{{__('profile.change email')}}</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Email Address-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Separator-->
                            <!--begin::Password-->
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">{{__('profile.password')}}</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="" class="form" novalidate="novalidate" method="POST" action="{{route('user.profile.update_password')}}">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-1">
                                            {{-- <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword" />
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">{{__('profile.new password')}}</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="newpassword" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">{{__('profile.confirm new password')}}</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="confirmpassword" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">{{__('profile.password must be at least 8 character and contain symbols')}}</div>
                                        <div class="d-flex">
                                            <button id="" type="submit" class="btn btn-primary me-2 px-6">{{__('profile.update password')}}</button>
                                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{__('profile.cancel')}}</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">{{__('profile.reset password')}}</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Sign-in Method-->
                <!--begin::Connected Accounts-->

                <!--end::Connected Accounts-->
                <!--begin::Notifications-->

                <!--end::Notifications-->
                <!--begin::Notifications-->

                <!--end::Notifications-->
                <!--begin::Deactivate Account-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{__('profile.deactivate account')}}</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <!--begin::Form-->
                        <form id="" class="form" method="POST" action="{{route('user.profile.deactivate')}}">
                            @csrf
                            @method('delete')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">{{__('profile.you are deactivating your account')}}</h4>
                                            {{-- <div class="fs-6 text-gray-700">For extra security, this requires you to confirm your email or phone number when you reset yousignr password. --}}
                                            {{-- <a class="fw-bold" href="#">Learn more</a></div> --}}
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value="deactivate" id="deactivate" required />
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">{{__('profile.i confirm my account deactivation')}}</label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button  type="submit" class="btn btn-danger fw-semibold">{{__('profile.deactivate account')}}</button>
                            </div>
                            <!--end::Card footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Deactivate Account-->
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
        <script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
		<script src="{{asset('assets/js/custom/account/settings/profile-details.js')}}"></script>
		<script src="{{asset('assets/js/custom/account/settings/deactivate-account.js')}}"></script>
		<script src="{{asset('assets/js/custom/pages/user-profile/general.js')}}"></script>
		<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/type.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/details.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/finance.j')}}s"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/complete.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/offer-a-deal/main.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/two-factor-authentication.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>

        <script>
            $("#kt_datepicker_3").flatpickr({
                // enableTime: true,
                // dateFormat: "Y-m-d H:i",
            });
        </script>

@endpush
