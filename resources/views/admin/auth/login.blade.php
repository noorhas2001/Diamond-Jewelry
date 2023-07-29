@extends('layouts.admin.index')

@section('main')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center overlay-container"
             style="background-image: url({{asset('assets/img/LogoLogin.avif')}})">
            <!--begin::Overlay-->
            <div class="overlay"></div>
            <!--end::Overlay-->
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                <!--begin::Image-->
                <!--end::Image-->
                {{-- <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-3qx fw-bold text-center mb-10 text-warning" style="z-index: 2;">Act Hub</h1>
                <!--end::Title--> --}}
                <!--begin::Text-->
                {{-- <div class="d-none d-lg-block text-white fs-base text-center w-600px fs-lg-2 fw-medium" style="z-index: 2;">
                    {{translate('loginTranslation.description')}}
                </div> --}}
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
            <!--begin::Form-->
            @if ($errors->has('email'))
                <!--begin::Alert-->
                <div class="alert alert-danger d-flex align-items-center p-5">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <!--begin::Title-->
                        <h4 class="mb-1 text-dark">{{ $errors->first('email') }}</h4>
                        <!--end::Title-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            @endif
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form class="form w-100" action="{{route('login')}}" method="POST">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">{{translate('loginTranslation.SignIn')}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->


                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="on"
                                   class="form-control bg-transparent" required/>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3">
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="password" autocomplete="on"
                                   class="form-control bg-transparent" required/>
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Wrapper-->
                        {{-- <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">--}}
{{--                            <div></div>--}}
{{--                            <!--begin::Link-->--}}
{{--                            <a href="#"--}}
{{--                               class="link-primary">Forgot Password ?</a>--}}
{{--                            <!--end::Link-->--}}
{{--                        </div> --}}
                        <!--end::Wrapper-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">{{translate('loginTranslation.SignIn')}}</span>
                                <!--end::Indicator label-->
                            </button>
                        </div>
                        <!--end::Submit button-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->

@endsection


