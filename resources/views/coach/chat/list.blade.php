<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
    @forelse ($users as $user)
        <div class="d-flex flex-stack py-4">
            <!--begin::Details-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-45px symbol-circle">
                    <img class="symbol-label bg-light-danger text-danger fs-6 fw-bolder" src="{{asset('images/participant/'.$user->profile->photo)}}" alt="">
                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                </div>
                <!--end::Avatar-->
                <!--begin::Details-->
                <div class="ms-5">
                    <a href="{{route('coach.chats.create_user',$user->id)}}" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{$user->name}}</a>
                    <div class="fw-semibold text-muted">{{$user->email}}</div>
                </div>
                <!--end::Details-->
            </div>
            <!--end::Details-->
            <!--begin::Lat seen-->
            <!--end::Lat seen-->
        </div>
        <div class="separator separator-dashed d-none"></div>
    @empty
    @endforelse
</div>
