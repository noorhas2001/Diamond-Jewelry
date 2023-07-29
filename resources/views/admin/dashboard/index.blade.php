@extends('layouts.admin.app')

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Toolbar-->
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                {{ translate('translation.Deault') }}</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    {{ translate('translation.Main') }}
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">{{ translate('translation.Dashboard') }}</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->

                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-fluid">

                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                            <!--Div 69-->
                            <!--begin::Col-->
                            <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"
                                     style="background-color: #3E97FF;background-image:url('assets/media/svg/shapes/widget-bg-1.png')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span
                                                    class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"></span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span
                                                    class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ translate('translation.CoursesNumber') }}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                <span>{{ translate('translation.Pending') }}
                                                </span>
                                                <span>%</span>
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar"
                                                     style="width: %;"
                                                     aria-valuenow="50"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                                <!--begin::List widget 26-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"
                                     style="background-color: #3E97FF;background-image:url('assets/media/svg/shapes/widget-bg-1.png')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span
                                                    class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"></span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span
                                                    class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ translate('translation.ResourceNumber') }}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                <span>{{ translate('translation.Available') }}
                                                     </span>
                                                <span>%</span>
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar"
                                                     style="width: %;"
                                                     aria-valuenow="50"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::LIst widget 26-->
                            </div>
                            <!--end::Col-->

                            <!--Div 69,700-->
                            <!--begin::Col-->
                            <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 17-->
                                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Currency-->
                                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                                <!--end::Currency-->
                                                <!--begin::Amount-->
                                                <span
                                                        class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                                                <!--end::Amount-->
                                                <!--begin::Badge-->

                                                <!--end::Badge-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span
                                                    class="text-white-400 pt-1 fw-semibold fs-6">{{ translate('translation.CoursesIncome') }}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                                        <!--begin::Chart-->

                                        <!--end::Chart-->
                                        <!--begin::Labels-->
                                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.TotalIncome') }} </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center my-3">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.WeeklyIncome') }}</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 me-3"
                                                     style="background-color: #E4E6EF"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.MonthlyIncome') }}</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Labels-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 17-->
                                <!--begin::Card widget 17-->
                                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Currency-->
                                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                                <!--end::Currency-->
                                                <!--begin::Amount-->
                                                <span
                                                        class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                                                <!--end::Amount-->
                                                <!--begin::Badge-->

                                                <!--end::Badge-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span
                                                    class="text-white-400 pt-1 fw-semibold fs-6">{{ translate('translation.ResourcesIncome') }}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                                        <!--begin::Chart-->

                                        <!--end::Chart-->
                                        <!--begin::Labels-->
                                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.TotalIncome') }}</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center my-3">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.WeeklyIncome') }} </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 me-3"
                                                     style="background-color: #E4E6EF"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ translate('translation.MonthlyIncome') }}</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    $</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Labels-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 17-->
                            </div>
                            <!--end::Col-->

                            <!-- Highlights -->
                            <div class="col-md-6 col-lg-6 col-xl-6 mb-md-5 mb-xl-10">
                                <!--begin::List widget 25-->
                                <div
                                        class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h3 class="card-title text-gray-800">{{ translate('translation.Courses') }}</h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar d-none">
                                            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                                 class="btn btn-sm btn-light d-flex align-items-center px-4">
                                                <!--begin::Display range-->
                                                <div class="text-gray-600 fw-bold">Loading date range...</div>
                                                <!--end::Display range-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                                <span class="svg-icon svg-icon-1 ms-2 me-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                              fill="currentColor"/>
                                                        <path
                                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                fill="currentColor"/>
                                                        <path
                                                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Daterangepicker-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.CoursesNumber') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr094.svg-->

                                                <!--begin::Number-->
                                                <span class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->

                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.ActiveCources') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr093.svg-->

                                                <!--end::Svg Icon-->
                                                <!--begin::Number-->
                                                <span
                                                        class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.FinishedCources') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr094.svg-->

                                                <!--end::Svg Icon-->
                                                <!--begin::Number-->
                                                <span
                                                        class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::LIst widget 25-->
                                <!--begin::List widget 25-->
                                <div
                                        class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h3 class="card-title text-gray-800">{{ translate('translation.Resources') }}</h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar d-none">
                                            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                                 class="btn btn-sm btn-light d-flex align-items-center px-4">
                                                <!--begin::Display range-->
                                                <div class="text-gray-600 fw-bold">Loading date range...</div>
                                                <!--end::Display range-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                                <span class="svg-icon svg-icon-1 ms-2 me-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                              fill="currentColor"/>
                                                        <path
                                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                fill="currentColor"/>
                                                        <path
                                                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Daterangepicker-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.ResourceNumber') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr094.svg-->

                                                <!--end::Svg Icon-->
                                                <!--begin::Number-->
                                                <span class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->

                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.AvailableResources') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr093.svg-->

                                                <!--end::Svg Icon-->
                                                <!--begin::Number-->
                                                <span
                                                        class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">
                                                {{ translate('translation.ReservedResources') }}</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr094.svg-->

                                                <!--end::Svg Icon-->
                                                <!--begin::Number-->
                                                <span
                                                        class="text-gray-900 fw-bolder fs-6"></span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::LIst widget 25-->
                            </div>

                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row gx-xl-0">
                            <!--begin::Card widget 17-->
                            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span
                                                    class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->

                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span
                                                class="text-white-400 pt-1 fw-semibold fs-6">{{ translate('translation.TotalCompanyIncome') }}</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                                    <!--begin::Chart-->

                                    <!--end::Chart-->
                                    <!--begin::Labels-->
                                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                        <!--begin::Label-->
                                        <div class="d-flex fw-semibold align-items-center">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ translate('translation.TotalIncome') }} </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-bolder text-gray-700 text-xxl-end">
                                                $</div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fw-semibold align-items-center my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ translate('translation.WeeklyIncome') }}</div>

                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-bolder text-gray-700 text-xxl-end">
                                                $
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fw-semibold align-items-center">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-3px rounded-2 me-3"
                                                 style="background-color: #E4E6EF"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ translate('translation.MonthlyIncome') }}</div>

                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-bolder text-gray-700 text-xxl-end">
                                                $
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 17-->
                        </div>
                        <!--end::Row-->

                        <!-- Div 357 -->
                        <div class="row gx-xl-0 d-flex justify-content-between">

                            <!--begin::Card widget 7-->
                            <div class="card card-flush col-xl-5 mb-5 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span
                                                class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <span
                                                class="text-gray-400 pt-1 fw-semibold fs-6">{{ translate('translation.CategoriesNumber') }}</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->

                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 7-->

                            <!--begin::Card widget 7-->
                            <div class="card card-flush col-xl-5 mb-5 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$employeesNum}}</span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <span
                                                class="text-gray-400 pt-1 fw-semibold fs-6">{{ translate('translation.EmployeesNumber') }}</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->

                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 7-->

                        </div>
                        <!-- Div 357 -->

                        <!-- ألإحصائيات -->
                        @if ($features)
                            <!--begin::Row-->
                            <div class="row gx-5 gx-xl-10">

                                <!--begin::Col-->
                                <div class="col-xl-6 mb-5 mb-xl-10">
                                    <!--begin::Chart Widget 35-->
                                    <div class="card card-flush h-md-100">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-6">
                                            <!--begin::Title-->
                                            <h3 class="card-title align-items-start flex-column">
                                                <!--begin::Statistics-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Currency-->
                                                    <span class="fs-3 fw-semibold text-gray-400 align-self-start me-1">$</span>
                                                    <!--end::Currency-->
                                                    <!--begin::Value-->
                                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,274.94</span>
                                                    <!--end::Value-->
                                                </div>
                                                <!--end::Statistics-->
                                                <!--begin::Description-->
                                                <span
                                                        class="fs-6 fw-semibold text-white-400">{{ translate('translation.AverageIncome') }}</span>
                                                <!--end::Description-->
                                            </h3>
                                            <!--end::Title-->
                                            <!--begin::Toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Menu-->
                                                <button
                                                        class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                        data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2"
                                                                      width="20" height="20" rx="4"
                                                                      fill="currentColor"/>
                                                                <rect x="11" y="11" width="2.6"
                                                                      height="2.6" rx="1.3" fill="currentColor"/>
                                                                <rect x="15" y="11" width="2.6"
                                                                      height="2.6" rx="1.3" fill="currentColor"/>
                                                                <rect x="7" y="11" width="2.6"
                                                                      height="2.6" rx="1.3" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    <!--end::Svg Icon-->
                                                </button>

                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Toolbar-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-0 px-0">
                                            <!--begin::Nav-->
                                            <ul class="nav d-flex justify-content-between mb-3 mx-9">
                                                <!--begin::Item-->
                                                <li class="nav-item mb-3">
                                                    <!--begin::Link-->
                                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px active"
                                                       data-bs-toggle="tab" id="kt_charts_widget_35_tab_1"
                                                       href="#kt_charts_widget_35_tab_content_1">1d</a>
                                                    <!--end::Link-->
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="nav-item mb-3">
                                                    <!--begin::Link-->
                                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px"
                                                       data-bs-toggle="tab" id="kt_charts_widget_35_tab_2"
                                                       href="#kt_charts_widget_35_tab_content_2">5d</a>
                                                    <!--end::Link-->
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="nav-item mb-3">
                                                    <!--begin::Link-->
                                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px"
                                                       data-bs-toggle="tab" id="kt_charts_widget_35_tab_3"
                                                       href="#kt_charts_widget_35_tab_content_3">1m</a>
                                                    <!--end::Link-->
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="nav-item mb-3">
                                                    <!--begin::Link-->
                                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px"
                                                       data-bs-toggle="tab" id="kt_charts_widget_35_tab_4"
                                                       href="#kt_charts_widget_35_tab_content_4">6m</a>
                                                    <!--end::Link-->
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="nav-item mb-3">
                                                    <!--begin::Link-->
                                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px"
                                                       data-bs-toggle="tab" id="kt_charts_widget_35_tab_5"
                                                       href="#kt_charts_widget_35_tab_content_5">1y</a>
                                                    <!--end::Link-->
                                                </li>
                                                <!--end::Item-->
                                            </ul>
                                            <!--end::Nav-->
                                            <!--begin::Tab Content-->
                                            <div class="tab-content mt-n6">
                                                <!--begin::Tap pane-->
                                                <div class="tab-pane fade active show"
                                                     id="kt_charts_widget_35_tab_content_1">
                                                    <!--begin::Chart-->
                                                    <div id="kt_charts_widget_35_chart_1" data-kt-chart-color="primary"
                                                         class="min-h-auto h-200px ps-3 pe-6"></div>
                                                    <!--end::Chart-->
                                                    <!--begin::Table container-->
                                                    <div class="table-responsive mx-9 mt-n6">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">-139.34</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">3:10 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$3,207.03</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+576.24</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">3:55 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$3,274.94</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+124.03</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table container-->
                                                </div>
                                                <!--end::Tap pane-->
                                                <!--begin::Tap pane-->
                                                <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_2">
                                                    <!--begin::Chart-->
                                                    <div id="kt_charts_widget_35_chart_2" data-kt-chart-color="primary"
                                                         class="min-h-auto h-200px ps-3 pe-6"></div>
                                                    <!--end::Chart-->
                                                    <!--begin::Table container-->
                                                    <div class="table-responsive mx-9 mt-n6">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,345.45</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+134.02</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">11:35 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">3:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">+144.04</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table container-->
                                                </div>
                                                <!--end::Tap pane-->
                                                <!--begin::Tap pane-->
                                                <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_3">
                                                    <!--begin::Chart-->
                                                    <div id="kt_charts_widget_35_chart_3" data-kt-chart-color="primary"
                                                         class="min-h-auto h-200px ps-3 pe-6"></div>
                                                    <!--end::Chart-->
                                                    <!--begin::Table container-->
                                                    <div class="table-responsive mx-9 mt-n6">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">3:20 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$3,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">+185.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">12:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">+124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">-154.03</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table container-->
                                                </div>
                                                <!--end::Tap pane-->
                                                <!--begin::Tap pane-->
                                                <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_4">
                                                    <!--begin::Chart-->
                                                    <div id="kt_charts_widget_35_chart_4" data-kt-chart-color="primary"
                                                         class="min-h-auto h-200px ps-3 pe-6"></div>
                                                    <!--end::Chart-->
                                                    <!--begin::Table container-->
                                                    <div class="table-responsive mx-9 mt-n6">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-warning">+124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">5:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-info">+144.65</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,085.25</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">+154.06</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table container-->
                                                </div>
                                                <!--end::Tap pane-->
                                                <!--begin::Tap pane-->
                                                <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_5">
                                                    <!--begin::Chart-->
                                                    <div id="kt_charts_widget_35_chart_5" data-kt-chart-color="primary"
                                                         class="min-h-auto h-200px ps-3 pe-6"></div>
                                                    <!--end::Chart-->
                                                    <!--begin::Table container-->
                                                    <div class="table-responsive mx-9 mt-n6">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$2,045.04</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-warning">+114.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">3:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#"
                                                                       class="text-gray-600 fw-bold fs-6">10:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                            <span
                                                                                    class="text-gray-800 fw-bold fs-6 me-1">$1.756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-info">+165.86</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table container-->
                                                </div>
                                                <!--end::Tap pane-->
                                            </div>
                                            <!--end::Tab Content-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Chart Widget 35-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-xl-6 mb-5 mb-xl-10">
                                    <!--begin::Chart widget 36-->
                                    <div class="card card-flush overflow-hidden h-xl-100">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5">
                                            <!--begin::Title-->
                                            <h3 class="card-title align-items-start flex-column">
                                                    <span
                                                            class="card-label fw-bold text-dark">{{ translate('translation.Revenues') }}</span>

                                            </h3>
                                            <!--end::Title-->
                                            <!--begin::Toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                                     data-kt-daterangepicker-range="today"
                                                     class="btn btn-sm btn-light d-flex align-items-center px-4">
                                                    <!--begin::Display range-->
                                                    <div class="text-gray-600 fw-bold">Loading date range...</div>
                                                    <!--end::Display range-->
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                                    <span class="svg-icon svg-icon-1 ms-2 me-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3"
                                                                      d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                      fill="currentColor"/>
                                                                <path
                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                        fill="currentColor"/>
                                                                <path
                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                        fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Daterangepicker-->
                                            </div>
                                            <!--end::Toolbar-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex align-items-end p-0">
                                            <!--begin::Chart-->
                                            <div id="kt_charts_widget_36" class="min-h-auto w-100 ps-4 pe-6"
                                                 style="height: 300px"></div>
                                            <!--end::Chart-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Chart widget 36-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        @endif
                        <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
@endsection
