@extends('layouts.admin.app')

@section('content')
    @include('flash::message')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ translate('sliderTranslation.SliderList') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('sliderTranslation.Dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('sliders.index') }}"
                                class="text-muted text-hover-primary">{{ translate('sliderTranslation.Sliders') }}</a>
                        </li>
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
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <form >
                                    <input type="text" data-kt-sliders-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-14"
                                        placeholder="{{ translate('sliderTranslation.Search') }}" name="keyword" />

                                </form>

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-sliders-table-toolbar="base">
                                <!--begin::Add Resource-->
                                @can(CREATE_SLIDER_PERMISSION)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_slider">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->{{ translate('sliderTranslation.AddSlider') }}
                                </button>
                                @endcan
                                <!--end::Add Resource-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-sliders-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-sliders-table-select="selected_count"></span>{{translate('sliderTranslation.Selected')}}
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-sliders-table-select="delete_selected">{{translate('sliderTranslation.DeleteSelected')}}
                                </button>
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Add sliders-->
                            <div class="modal fade" id="kt_modal_add_slider" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_slider_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">{{ translate('sliderTranslation.AddSlider') }}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-kt-sliders-modal-action="close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                            height="2" rx="1"
                                                            transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                        <rect x="7.41422" y="6" width="16"
                                                            height="2" rx="1"
                                                            transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                            <!--begin::Form-->
                                            <form id="kt_modal_add_slider_form" class="form"
                                                action="{{ route('sliders.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                    id="kt_modal_add_sliders_scroll" data-kt-scroll="true"
                                                    data-kt-scroll-activate="{default: false, lg: true}"
                                                    data-kt-scroll-max-height="auto"
                                                    data-kt-scroll-dependencies="#kt_modal_add_sliders_header"
                                                    data-kt-scroll-wrappers="#kt_modal_add_sliders_scroll"
                                                    data-kt-scroll-offset="300px">

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('sliderTranslation.Title') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="title"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('sliderTranslation.EnterTitle') }}"
                                                            required />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('sliderTranslation.SubTitle') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="sub_title"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('sliderTranslation.EnterSubTitle') }}"
                                                            required />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ translate('sliderTranslation.Description') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="description"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('sliderTranslation.Description') }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label for="link_option">{{ translate('sliderTranslation.ChooseLink') }}:</label>
                                                        <select class="form-select form-select-sm form-select-solid" name="link_option" id="link_option">
                                                            <option value="resource">{{ translate('sliderTranslation.Resources') }}</option>
                                                            <option value="category">{{ translate('sliderTranslation.Categories') }}</option>
                                                            <option value="course">{{ translate('sliderTranslation.Courses') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="fv-row mb-7">
                                                        <select class="form-select form-select-sm form-select-solid" name="id_option" id="resources_option" style="display: none">
                                                            @foreach ($resources as $name => $id)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <select class="form-select form-select-sm form-select-solid" name="id_option" id="categories_option" style="display: none">
                                                            @foreach ($categories as $name => $id)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <select class="form-select form-select-sm form-select-solid" name="id_option" id="courses_option" style="display: none">
                                                            @foreach ($courses as $name => $id)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Input group-->




                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-sliders-modal-action="cancel">{{ translate('sliderTranslation.Cancel') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-kt-sliders-modal-action="submit">
                                                        <span
                                                            class="indicator-label">{{ translate('sliderTranslation.Add') }}</span>
                                                        <span
                                                            class="indicator-progress">{{ translate('sliderTranslation.Waiting') }}
                                                            <span span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Modal - Add sliders-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_sliders">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_sliders .form-check-input"
                                                    value="" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">{{ translate('sliderTranslation.Title') }}</th>
                                        <th class="min-w-125px">{{ translate('sliderTranslation.SubTitle') }}</th>
                                        <th class="min-w-125px">{{ translate('sliderTranslation.Description') }} </th>
                                        <th class="min-w-125px">{{ translate('sliderTranslation.Link') }}</th>
                                        <th class="text-end min-w-100px px-10">
                                            {{ translate('sliderTranslation.Procedures') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($sliders as $slider)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="{{$slider->id}}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Resource=-->
                                            <!--end::Resource=-->
                                            <!--begin::Role=-->
                                            <td>{{ $slider->title }}</td>
                                            <!--end::Role=-->
                                            <!--begin::Joined-->
                                            <td>{{ $slider->sub_title }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td>{{ $slider->linkName() }}</td>


                                            <!--begin::Joined-->
                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">{{ translate('sliderTranslation.Procedures') }}
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    @can(READ_SLIDER_PERMISSION)
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('sliders.show', $slider->id) }}"
                                                            class="menu-link px-3">{{ translate('sliderTranslation.Show') }}</a>
                                                    </div>
                                                    @endcan
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @can(DELETE_SLIDER_PERMISSION)
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="post" data-kt-sliders-table-filter="delete_form"></form>
                                                        <a href=""
                                                            class="menu-link px-3"
                                                            data-kt-sliders-table-filter="delete_row">{{ translate('sliderTranslation.Delete') }}</a>
                                                    </div>
                                                    @endcan
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->

                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
                                        <!--end::Table row-->
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                           
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
@push('scripts')

    @if (Cookie::get(APP_LOCALE) == 'ar')
        <script src="{{ asset('assets/js/custom/apps/sliders/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/sliders/list/table-en.js') }}"></script>
    @endif

    <script>
        var linkOption = document.getElementById("link_option");
        var resourcesOption = document.getElementById("resources_option");
        var categoriesOption = document.getElementById("categories_option");
        var coursesOption = document.getElementById("courses_option");

        linkOption.addEventListener("click", showOptionsId);

        function showOptionsId() {
            var selectedOption = linkOption.value;
            resourcesOption.style.display = (selectedOption === "resource") ? "block" : "none";
            categoriesOption.style.display = (selectedOption === "category") ? "block" : "none";
            coursesOption.style.display = (selectedOption === "course") ? "block" : "none";
        }
    </script>
@endpush
