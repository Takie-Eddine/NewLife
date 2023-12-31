@extends('coach.auth.layouts.master')

@section('title','Login')


@push('style')

@endpush

@section('content')

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>body { background-image: url('{{asset("images/logo/Newlife-website-2.jpg")}}'); } [data-bs-theme="dark"] body { background-image: url('{{asset("images/logo/Newlife-website-2.jpg")}}'); }</style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
            </div>
        </div>

        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">

                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <form class="form w-100" novalidate="novalidate" id="" data-kt-redirect-url="{{route('coach.login')}}" action="{{route('coach.login')}}" method="POST">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">{{__('login.sign in')}}</h1>
                            {{-- <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div> --}}
                            <!--end::Subtitle=-->
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
                        {{-- <div class="row g-3 mb-9">
                            <div class="col-md-6">
                                <!--begin::Google link=-->
                                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>
                                <!--end::Google link=-->
                            </div>

                            <div class="col-md-6">
                                <!--begin::Google link=-->
                                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
                                <img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
                                <!--end::Google link=-->
                            </div>
                        </div> --}}

                        {{-- <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                        </div> --}}

                        <div class="fv-row mb-8">
                            <input type="email" placeholder="{{__('login.email')}}" name="email" value="{{old('email')}}" required autocomplete="off" class="form-control bg-transparent" />

                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="{{__('login.password')}}" name="password" required autocomplete="off" class="form-control bg-transparent" />

                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="remember"  id="remember_me" />
                                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">{{__('login.remember me')}}</span>
                            </label>
                        </div>

                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <!--begin::Link-->
                            <a href="{{ route('coach.password.request') }}" class="link-primary">{{__('login.forgot password')}}</a>
                            <!--end::Link-->
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">{{__('login.sign in')}}</span>

                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="d-flex flex-stack px-lg-10">
                    <div class="me-0">
                        <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                            @if (LaravelLocalization::getCurrentLocaleName() == 'English')
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" /></span></span>
                                <span data-kt-element="current-lang-name" class="me-1">English</span>
                            @else
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt="" /></span></span>
                                <span data-kt-element="current-lang-name" class="me-1">العربية</span>
                            @endif

                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="menu-item px-3">
                                    <a class="menu-link d-flex px-5 active" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"  data-language="{{ $localeCode }}">
                                        @if ($properties['native'] == 'English')
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
                                        </span>
                                        @endif
                                        @if ($properties['native'] == 'العربية')
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1" src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt="" />
                                        </span>
                                        @endif
                                        {{ $properties['native'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="d-flex fw-semibold text-primary fs-base gap-5">
                        <a href="https://newlifeprog.net/page/policy" target="_blank">{{__('login.term')}}</a>
                        <a href="https://newlifeprog.net/Programs" target="_blank">{{__('login.program')}}</a>
                        <a href="https://newlifeprog.net/Contactus" target="_blank">{{__('login.contact us')}}</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>

@endsection


@push('script')
<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
@endpush




{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
