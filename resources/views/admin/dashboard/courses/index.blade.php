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
                        {{ translate('courseTranslation.CoursesList') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                               class="text-muted text-hover-primary">{{ translate('courseTranslation.Dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('courses.index') }}"
                               class="text-muted text-hover-primary">{{ translate('courseTranslation.Courses') }}</a>
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
                                              rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                        <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-course-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-14"
                                       placeholder="{{ translate('courseTranslation.Search') }}"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-course-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
															<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                                  fill="currentColor"/>
														</svg>
													</span>
                                    <!--end::Svg Icon-->{{translate('reservationTranslation.Filter')}}</button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{translate('reservationTranslation.FilterOptions')}}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-courses-table-filter="form">
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                    class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-courses-table-filter="reset">{{translate('courseTranslation.Reset')}}</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-courses-table-filter="filter">{{translate('courseTranslation.Apply')}}</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                <!--begin::Add Resource-->
                                @can(CREATE_COURSE_PERMISSION)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_course">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                  rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                  fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->{{ translate('courseTranslation.AddCourse') }}
                                    </button>
                                @endcan
                                <!--end::Add Resource-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-course-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2"
                                          data-kt-course-table-select="selected_count"></span>{{translate('courseTranslation.Selected')}}
                                </div>
                                <button type="button" class="btn btn-danger"
                                        data-kt-course-table-select="delete_selected">{{translate('courseTranslation.DeleteSelected')}}
                                </button>
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Add course-->
                            <div class="modal fade" id="kt_modal_add_course" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_course_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">{{ translate('courseTranslation.AddCourse') }}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                 data-kt-courses-modal-action="close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                              height="2" rx="1"
                                                              transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                                        <rect x="7.41422" y="6" width="16"
                                                              height="2" rx="1"
                                                              transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                            <form id="kt_modal_add_course_form" class="form"
                                                  action="{{ route('courses.store') }}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                     id="kt_modal_add_course_scroll" data-kt-scroll="true"
                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                     data-kt-scroll-max-height="auto"
                                                     data-kt-scroll-dependencies="#kt_modal_add_course_header"
                                                     data-kt-scroll-wrappers="#kt_modal_add_course_scroll"
                                                     data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="d-block fw-semibold fs-6 mb-5">{{ translate('courseTranslation.Image') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Image placeholder-->
                                                        <style>
                                                            .image-input-placeholder {
                                                                background-image: {{ asset('assets/img/avatar.jpeg') }};
                                                            }

                                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                                background-image: {{ asset('assets/img/avatar.jpeg') }};
                                                            }
                                                        </style>
                                                        <!--end::Image placeholder-->
                                                        <!--begin::Image input-->
                                                        <div class="image-input image-input-outline image-input-placeholder"
                                                             data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-125px h-125px"
                                                                 style="background-image: {{ asset('assets/img/avatar.jpeg') }};">
                                                            </div>
                                                            <!--end::Preview existing avatar-->
                                                            <!--begin::Label-->
                                                            <label
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="change"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ translate('courseTranslation.ImageChange') }}">
                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file" name="avatar"
                                                                       accept=".png, .jpg, .jpeg"/>
                                                                <input type="hidden" name="avatar_remove"/>
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Cancel-->
                                                            <span
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="cancel"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ translate('courseTranslation.ImageRemove') }}">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                            <!--end::Cancel-->
                                                            <!--begin::Remove-->
                                                            <span
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="remove"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ translate('courseTranslation.ImageRemove') }}">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                            <!--end::Remove-->
                                                        </div>
                                                        <!--end::Image input-->
                                                        <!--begin::Hint-->
                                                        <div class="form-text">
                                                            {{ translate('courseTranslation.AllowedFile') }}
                                                        </div>
                                                        <!--end::Hint-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.Course') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="name"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.CoursName') }}"
                                                               required/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="required fw-semibold fs-6 mb-2">{{ translate('calendarTranslation.ResourceName') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <!--begin::Col-->
                                                        <div class="col-6">
                                                            <select name="resource_id" class="form-select form-select-solid"
                                                                    data-control="select2" data-hide-search="true"
                                                                    data-placeholder="{{ translate('calendarTranslation.ResourceName') }}"
                                                                    required>
                                                                @foreach ($resources as $resource)
                                                                    <option value="{{ $resource->id }}">{{ $resource->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--end::Input-->
                                                    </div>



                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="fw-semibold fs-6 mb-2">{{ translate('courseTranslation.Description') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="description"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.Description') }}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.Price') }}
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="price"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.Price') }}"
                                                               min="1"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class=" fw-semibold fs-6 mb-2">{{ translate('courseTranslation.NumberSeats') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="number_seats"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.NumberSeats') }}"
                                                               min="1"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.CourseHours') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="hours"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.CourseHours') }}"
                                                               min="1"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                                class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.LectureHours') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="lecture_hours"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{ translate('courseTranslation.LectureHours') }}"
                                                               min="1"/>
                                                        <!--end::Input-->
                                                    </div>

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.CourseDays') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="card">
                                                                        <div class="card-body items-center">
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="0" id="saturday">
                                                                                <label class="form-check-label"
                                                                                       for="saturday">Saturday</label>
                                                                            </div>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="1" id="sunday">
                                                                                <label class="form-check-label"
                                                                                       for="sunday">Sunday</label>
                                                                            </div>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="2" id="monday">
                                                                                <label class="form-check-label"
                                                                                       for="monday">Monday</label>
                                                                            </div>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="3" id="tuesday">
                                                                                <label class="form-check-label"
                                                                                       for="tuesday">Tuesday</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card">
                                                                        <div class="card-body items-center">
                                                                            <h5 class="card-title">&nbsp;</h5>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="4" id="wednesday">
                                                                                <label class="form-check-label"
                                                                                       for="wednesday">Wednesday</label>
                                                                            </div>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="5" id="thursday">
                                                                                <label class="form-check-label"
                                                                                       for="thursday">Thursday</label>
                                                                            </div>
                                                                            <div class="form-check mb-4">
                                                                                <input class="form-check-input"
                                                                                       type="checkbox"
                                                                                       name="course_days[]"
                                                                                       value="6" id="friday">
                                                                                <label class="form-check-label"
                                                                                       for="friday">Friday</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mb-2">
                                                            <span
                                                                    class="required">{{ translate('courseTranslation.courseStartDate') }}</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                               placeholder="{{ translate('courseTranslation.EnterStartDate') }}"
                                                               name="start_date" id="kt_modal_add_course_datepicker"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                            data-kt-courses-modal-action="cancel">{{ translate('courseTranslation.Cancel') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            data-kt-courses-modal-action="submit">
                                                        <span
                                                                class="indicator-label">{{ translate('courseTranslation.Add') }}</span>
                                                        <span
                                                                class="indicator-progress">{{ translate('courseTranslation.Waiting') }}
                                                            <span
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
                            <!--end::Modal - Add course-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->


                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_courses">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                   data-kt-check-target="#kt_table_courses .form-check-input"
                                                   value="1"/>
                                        </div>
                                    </th>
                                    <th class="min-w-125px">{{ translate('courseTranslation.Course') }}</th>
                                    <th class="min-w-50px">{{ translate('courseTranslation.Price') }}</th>
                                    <th class="min-w-50px">{{ translate('courseTranslation.NumberSeats') }}</th>
                                    <th class="min-w-50px px-10">{{ translate('courseTranslation.Status') }}</th>
                                    <th class="min-w-50px">{{ translate('courseTranslation.Rate') }}</th>
                                    <th class="text-end min-w-100px px-10">
                                        {{ translate('courseTranslation.Procedures') }}</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                @foreach ($courses as $course)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{{$course->id}}"/>
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::Resource=-->
                                        <!--end::Resource=-->
                                        <!--begin::Role=-->
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a @can(READ_COURSE_PERMISSION) href="{{ route('courses.show', $course->id) }}" @endcan>
                                                    <div class="symbol-label">
                                                        <img src="{{ asset($course->imageUrl() ?? 'assets/img/avatar.jpeg') }}"
                                                             alt="Emma Smith" class="w-100"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Category details-->
                                            <div class="d-flex flex-column">
                                                <a @can(READ_COURSE_PERMISSION) href="{{ route('courses.show', $course->id) }}"
                                                   @endcan
                                                   class="text-gray-800 text-hover-primary mb-1">{{ $course->name }}</a>
                                                <span>{{ $course->description }}</span>
                                            </div>
                                            <!--begin::Category details-->
                                        </td>
                                        <!--end::Role=-->
                                        <!--begin::Joined-->
                                        <td>{{ $course->price }}</td>
                                        <td>{{ $course->number_seats }}</td>
                                        @if ($course->isPending())
                                            <td>
                                                    <span
                                                            class="badge badge-light-success fw-bold px-4 py-3">{{ $course->status() }}</span>
                                            </td>
                                        @endif
                                        @if ($course->isFinished())
                                            <td>
                                                    <span
                                                            class="badge badge-light-danger fw-bold px-4 py-3">{{ $course->status() }}</span>
                                            </td>
                                        @endif
                                        <td>{{ $course->rate() }}</td>

                                        <!--begin::Joined-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                               data-kt-menu-trigger="click"
                                               data-kt-menu-placement="bottom-end">{{ translate('courseTranslation.Procedures') }}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                 data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                @can(READ_COURSE_PERMISSION)
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('courses.show', $course->id) }}"
                                                           class="menu-link px-3">{{ translate('courseTranslation.Show') }}</a>
                                                    </div>
                                                @endcan
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                @can(DELETE_COURSE_PERMISSION)
                                                    <div class="menu-item px-3">
                                                        <form action="{{route('courses.destroy', $course->id)}}"
                                                              method="post"
                                                              data-kt-courses-table-filter="delete_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input hidden="hidden" data-canDeleted="canDeleted"
                                                                   value="{{$course->canDeleted()}}">
                                                            <a href="#"
                                                               class="menu-link px-3"
                                                               data-kt-courses-table-filter="delete_row">{{translate('courseTranslation.Delete')}}</a>
                                                        </form>
                                                        {{-- <a href="{{ route('courses.destroy', $course->id) }}"
                                                            class="menu-link px-3"
                                                            data-kt-courses-table-filter="delete_row">{{ translate('courseTranslation.Delete') }}</a> --}}
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
        <script src="{{ asset('assets/js/custom/apps/courses/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/courses/list/table-en.js') }}"></script>
    @endif
@endpush
