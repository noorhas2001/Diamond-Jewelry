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

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control bg-transparent" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control bg-transparent" type="password" name="password" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="form-control bg-transparent"
                                                    type="password"
                                                    name="password_confirmation" required />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="w-full btn btn-primary" style="width: 100%">
                                    {{ __('Reset Password') }}
                                </x-primary-button>
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
