@extends('layouts.admin.index')

@section('main')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center overlay-container"
            style="background-image: url({{ asset('assets/img/LogoLogin.avif') }})">
            <!--begin::Overlay-->
            <div class="overlay"></div>
            <!--end::Overlay-->
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">

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
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                            class="path2"></span></i>
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
                    <x-guest-layout>

                        <form method="POST" action="{{ route('password.email') }}" class="max-w-sm mx-auto px-4">
                            @csrf

                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control bg-transparent" type="email"
                                    name="email" :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-center mt-4">
                                <x-primary-button class="w-full btn btn-primary" style="width: 100%">
                                    {{ __('Email Password Reset Link') }}
                                </x-primary-button>
                            </div>

                            <div class="mt-2 text-center">
                                <a href="{{ route('login') }}"
                                    class="block text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                                    {{ __('Back to Login') }}
                                </a>
                            </div>
                        </form>

                    </x-guest-layout>

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
