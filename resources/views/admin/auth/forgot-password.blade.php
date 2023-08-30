@extends('admin.auth.layouts.master')

@section('title','Forgot Password')


@push('style')

@endpush

@section('content')

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>body { background-image: url('{{asset("images/logo/New Life Presentation Investor new content-01.png")}}'); } [data-bs-theme="dark"] body { background-image: url('{{asset("images/logo/New Life Presentation Investor new content-01.png")}}'); }</style>
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <div class="d-flex flex-center flex-lg-start flex-column">

            </div>
        </div>
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <form class="form w-100" novalidate="novalidate"  data-kt-redirect-url="{{route('admin.password.email')}}" action="{{route('admin.password.email')}}" method="POST">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="email" placeholder="Email" name="email" value="{{old('email')}}" autocomplete="off" class="form-control bg-transparent"  required/>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                            <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <a href="{{route('admin.login')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-stack px-lg-10">
                    {{-- <div class="me-0">
                        <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                            <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="assets/media/flags/united-states.svg" alt="" />
                            <span data-kt-element="current-lang-name" class="me-1">English</span>
                            <i class="ki-duotone ki-down fs-5 text-muted rotate-180 m-0"></i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/united-states.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">English</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/spain.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Spanish</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/germany.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">German</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/japan.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Japanese</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/france.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">French</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex fw-semibold text-primary fs-base gap-5">
                        <a href="../../demo1/dist/pages/team.html" target="_blank">Terms</a>
                        <a href="../../demo1/dist/pages/pricing/column.html" target="_blank">Plans</a>
                        <a href="../../demo1/dist/pages/contact.html" target="_blank">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('script')
<script src="{{asset('assets/js/custom/authentication/reset-password/reset-password.js')}}"></script>
@endpush




{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
