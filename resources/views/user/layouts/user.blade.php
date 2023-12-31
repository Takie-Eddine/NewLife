<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}" dir="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}" style="direction: {{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
	<!--begin::Head-->
	<head><base href=""/>
		<title>{{config('app.name')}}</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{asset('images/logo/NewLife Brand Guidelines-18.png')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        @if ( app() -> getLocale() === 'ar')
            <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        @else
            <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        @endif
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        {{-- <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" /> --}}


        @stack('style')
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
        @include('user.partials.init')
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
                @include('user.layouts.navbar')
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
                    @include('user.layouts.sidebar')
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
									<!--begin::Page title-->
									{{-- @include('user.layouts.partials.header_right') --}}
									<!--end::Page title-->
									<!--begin::Actions-->
									{{-- @include('user.layouts.partials.header_left') --}}
									<!--end::Actions-->
								</div>
								<!--end::Toolbar container-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Content-->
                            @yield('content')
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
                        @include('user.layouts.footer')
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->
		@include('user.partials.activities')
		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->
		@include('user.partials.chat')
		<!--end::Chat drawer-->
		<!--begin::Chat drawer-->
		@include('user.partials.chat1')
		<!--end::Chat drawer-->
		<!--end::Drawers-->
		<!--begin::Scrolltop-->
		@include('user.partials.scrolltop')
		<!--end::Scrolltop-->
		<!--begin::Modals-->
		<!--begin::Modal - Upgrade plan-->
		@include('user.partials.modal_upgrade_plan')
		<!--end::Modal - Upgrade plan-->
		<!--begin::Modal - Create App-->
		@include('user.partials.modal_create_app')
		<!--end::Modal - Create App-->
		<!--begin::Modal - New Target-->
		@include('user.partials.modal_new_target')
		<!--end::Modal - New Target-->
		<!--begin::Modal - View Users-->
		@include('user.partials.modal_view_user')
		<!--begin::Modal - Users Search-->
		@include('user.partials.modal_user_search')
		<!--end::Modal - Users Search-->
		<!--begin::Modal - Invite Friends-->
		@include('user.partials.modal_invite_friend')

        @include('user.partials.init1')

		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

		<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js')}}"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

		<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
        @stack('script')
	</body>

</html>
