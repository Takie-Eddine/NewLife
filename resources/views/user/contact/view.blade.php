@extends('user.layouts.user')


@section('title', 'Contact')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> {{__('user.contact')}}</h1>
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
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('user.contacts')}}" class="text-muted text-hover-primary">{{__('user.contacts')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('user.view contact')}}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row g-7">
                    <div class="col-xl-12">
                        <!--begin::Contacts-->
                        <div class="card card-flush h-lg-100" id="kt_contacts_main">
                            <!--begin::Card header-->
                            <div class="card-header pt-7" id="kt_chat_contacts_header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <i class="ki-duotone ki-badge fs-1 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    <h2>{{__('user.contact details')}}</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar gap-3">
                                    <!--begin::Chat-->
                                    <button class="btn btn-sm btn-light btn-active-light-primary" data-kt-drawer-show="true" data-kt-drawer-target="#kt_drawer_chat">
                                    <i class="ki-duotone ki-message-text-2 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>{{__('user.chat')}}</button>
                                    <!--end::Chat-->
                                    <!--begin::Chat-->
                                    <a href="../../demo1/dist/apps/inbox/reply.html" class="btn btn-sm btn-light btn-active-light-primary">
                                    <i class="ki-duotone ki-messages fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>{{__('user.message')}}</a>
                                    <!--end::Chat-->
                                    <!--begin::Action menu-->
                                    {{-- <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-dots-square fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </a> --}}
                                    <!--begin::Menu-->
                                    {{-- <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/contacts/edit-contact.html" class="menu-link px-3">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" id="kt_contact_delete" data-kt-redirect="../../demo1/dist/apps/contacts/getting-started.html">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div> --}}
                                    <!--end::Menu-->
                                    <!--end::Action menu-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-5">
                                <!--begin::Profile-->
                                <div class="d-flex gap-7 align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-100px">
                                        @if ($admin->profile->photo)
                                            <img src="{{asset('images/profile/'.$admin->profile->photo)}}" alt="image" />
                                        @else
                                            <img src="{{asset('images/no-image.png')}}" alt="image" />
                                        @endif

                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Contact details-->
                                    <div class="d-flex flex-column gap-2">
                                        <!--begin::Name-->
                                        <h3 class="mb-0">{{$admin->profile->first_name.' '.$admin->profile->last_name}}</h3>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ki-duotone ki-sms fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <a href="#" class="text-muted text-hover-primary">{{$admin->email}}</a>
                                        </div>
                                        <!--end::Email-->
                                        <!--begin::Phone-->
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ki-duotone ki-phone fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <a href="#" class="text-muted text-hover-primary">{{$admin->profile->phone}}</a>
                                        </div>
                                        <!--end::Phone-->
                                    </div>
                                    <!--end::Contact details-->
                                </div>
                                <!--end::Profile-->
                                <!--begin:::Tabs-->
                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-semibold mt-6 mb-8 gap-2">
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary d-flex align-items-center pb-4 active" data-bs-toggle="tab" href="#kt_contact_view_general">
                                        <i class="ki-duotone ki-home fs-4 me-1"></i>{{__('user.general')}}</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    {{-- <li class="nav-item">
                                        <a class="nav-link text-active-primary d-flex align-items-center pb-4" data-bs-toggle="tab" href="#kt_contact_view_meetings">
                                        <i class="ki-duotone ki-calendar-8 fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>Meetings</a>
                                    </li> --}}
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    {{-- <li class="nav-item">
                                        <a class="nav-link text-active-primary d-flex align-items-center pb-4" data-bs-toggle="tab" href="#kt_contact_view_activity">
                                        <i class="ki-duotone ki-save-2 fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>Activity</a>
                                    </li> --}}
                                    <!--end:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->
                                <!--begin::Tab content-->
                                <div class="tab-content" id="">
                                    <!--begin:::Tab pane-->
                                    <div class="tab-pane fade show active" id="kt_contact_view_general" role="tabpanel">
                                        <!--begin::Additional details-->
                                        <div class="d-flex flex-column gap-5 mt-7">
                                            <!--begin::Company name-->
                                            <div class="d-flex flex-column gap-1">
                                                <div class="fw-bold text-muted">{{__('profile.role')}}</div>
                                                <div class="fw-bold fs-5">{{$admin->role->name}}</div>
                                            </div>
                                            <!--end::Company name-->
                                            <!--begin::City-->
                                            <div class="d-flex flex-column gap-1">
                                                <div class="fw-bold text-muted">{{__('user.last active')}}</div>
                                                @if ($admin->last_active_at)
                                                    <div class="fw-bold fs-5">{{$admin->last_active_at->longAbsoluteDiffForHumans()}}</div>
                                                @else
                                                    <div class="fw-bold fs-5">Not Active</div>
                                                @endif
                                            </div>
                                            {{-- <div class="d-flex flex-column gap-1">
                                                <div class="fw-bold text-muted">Country</div>
                                                <div class="fw-bold fs-5">Australia</div>
                                            </div> --}}
                                            <!--end::Country-->
                                            <!--begin::Notes-->
                                            {{-- <div class="d-flex flex-column gap-1">
                                                <div class="fw-bold text-muted">Notes</div>
                                                <p>Emma Smith joined the team on September 2019 as a junior associate. She soon showcased her expertise and experience in knowledge and skill in the field, which was very valuable to the company. She was promptly promoted to senior associate on July 2020.
                                                <br />
                                                <br />Emma Smith now heads a team of 5 associates and leads the company's sales growth by 7%.</p>
                                            </div> --}}
                                            <!--end::Notes-->
                                        </div>
                                        <!--end::Additional details-->
                                    </div>
                                    <!--end:::Tab pane-->
                                    <!--begin:::Tab pane-->
                                    <div class="tab-pane fade" id="kt_contact_view_meetings" role="tabpanel">
                                        <!--begin::Dates-->
                                        <ul class="nav nav-pills d-flex flex-stack flex-nowrap hover-scroll-x">
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                                    <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 fw-bold">22</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                                    <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                                    <span class="fs-6 fw-bold">23</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                                    <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 fw-bold">24</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                                    <span class="opacity-50 fs-7 fw-semibold">We</span>
                                                    <span class="fs-6 fw-bold">25</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                                    <span class="opacity-50 fs-7 fw-semibold">Th</span>
                                                    <span class="fs-6 fw-bold">26</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                                    <span class="opacity-50 fs-7 fw-semibold">Fr</span>
                                                    <span class="fs-6 fw-bold">27</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                                    <span class="opacity-50 fs-7 fw-semibold">Sa</span>
                                                    <span class="fs-6 fw-bold">28</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                                    <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 fw-bold">29</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                                    <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                                    <span class="fs-6 fw-bold">30</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-dark text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                                    <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 fw-bold">31</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                        </ul>
                                        <!--end::Dates-->
                                        <!--begin::Tab Content-->
                                        <div class="tab-content">
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_0" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">14:30 - 15:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Caleb Donaldson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">David Stevenson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_2" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Yannis Gloverson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_3" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Naomi Hayabusa</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Mark Randall</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_4" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Mark Randall</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_5" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Bob Harris</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Naomi Hayabusa</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_6" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Michael Walters</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Caleb Donaldson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_7" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Yannis Gloverson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_8" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Yannis Gloverson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Bob Harris</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_9" class="tab-pane fade show">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Karina Clarke</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                        </div>
                                        <!--end::Tab Content-->
                                    </div>
                                    <!--end:::Tab pane-->
                                    <!--begin:::Tab pane-->
                                    <div class="tab-pane fade" id="kt_contact_view_activity" role="tabpanel">
                                        <!--begin::Timeline-->
                                        <div class="timeline-label">
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-warning fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Text-->
                                                <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And keep structure</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-success fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Content-->
                                                <div class="timeline-content d-flex">
                                                    <span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-danger fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Desc-->
                                                <div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit
                                                <a href="#" class="text-primary">USD 700</a>. to ESL</div>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-primary fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Text-->
                                                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-danger fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Desc-->
                                                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-primary fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Text-->
                                                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-danger fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Desc-->
                                                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="ki-duotone ki-abstract-8 text-success fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch preparion meeting</div>
                                            </div>
                                        </div>
                                    </div>
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
