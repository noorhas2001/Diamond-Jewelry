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
                        {{translate('courseTranslation.ShowCourseDetails')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{translate('courseTranslation.Dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('courses.index') }}" class="text-muted text-hover-primary">{{translate('courseTranslation.Courses')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('courses.show', $course->id) }}"
                                class="text-muted text-hover-primary">{{translate('courseTranslation.Show')}}</a>
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <!--begin::Category Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="{{asset($course->imageUrl() ?? 'assets/img/avatar.jpeg')}}"
                                             alt="image"/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <h1 class="symbol symbol-100px symbol-circle mb-7">
                                        {{ $course->name }}
                                    </h1>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <!--begin::Info heading-->

                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge-lg badge-light-primary d-inline">{{ $course->description }}</div>
                                        <!--begin::Badge-->
                                    </div>

                                </div>
                                <!--end::Category Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#kt_category_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_category_view_details">{{translate('courseTranslation.Details')}}
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    @can(UPDATE_COURSE_PERMISSION)
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_update_details">{{translate('courseTranslation.Edit')}}</a>
                                    </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_category_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">

                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('courseTranslation.AddedBy')}}</div>
                                        <div class="text-gray-600">{{ $course->admin->name }}</div>
                                        <div class="fw-bold mt-5">{{translate('courseTranslation.CoursName')}}</div>
                                        <div class="text-gray-600">{{ $course->name }}</div>
                                        <div class="fw-bold mt-5">{{translate('courseTranslation.Price')}}</div>
                                        <div class="text-gray-600">{{ $course->price }}</div>

                                        <div class="fw-bold mt-5">{{translate('courseTranslation.CourseHours')}}</div>
                                        <div class="text-gray-600">{{ $course->hours }}</div>

                                        <div class="fw-bold mt-5">{{translate('courseTranslation.NumberSeats')}}</div>
                                        <div class="text-gray-600">{{ $course->number_seats }}</div>

                                        <div class="fw-bold mt-5">{{translate('courseTranslation.LectureHours')}}</div>
                                        <div class="text-gray-600">{{ $course->lecture_hours }}</div>

                                        <div class="fw-bold mt-5">{{translate('courseTranslation.CourseDays')}}</div>
                                        <div class="text-gray-600">{{ implode(' - ', $courseDays) }}</div>

                                        <!--end::Details item-->
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                   href="#kt_category_view_overview_tab">Overview</a>
                            </li> --}}
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item ms-auto">
                                <!--begin::Action menu-->
                                <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">{{translate('courseTranslation.Proccesses')}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-2 me-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5">تقارير</a>
                                    </div> --}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    @can(DELETE_COURSE_PERMISSION)
                                    <div class="menu-item px-3">
                                        <a href="{{ route('courses.destroy', $course->id) }}"
                                            class="menu-link text-danger px-5"
                                            data-kt-categories-table-filter="delete_row">{{translate('courseTranslation.DeleteCourse')}}</a>
                                    </div>
                                    @endcan
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu-->
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_resource_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">{{translate('courseTranslation.CourseSubscriptions')}}</h2>

                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            @can(CREATE_SUBSCRIPTION_PERMISSION)
                                            <button type="button" class="btn btn-light-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                                <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                                {{translate('courseTranslation.AddSubscription')}}
                                            </button>
                                            @endcan
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body py-4">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                id="kt_table_subscriptions">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-10px pe-2">
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    data-kt-check="true"
                                                                    data-kt-check-target="#kt_table_subscriptions .form-check-input"
                                                                    value="1" />
                                                            </div>
                                                        </th>
                                                        <th class="min-w-125px">{{translate('courseTranslation.User')}}</th>
                                                        <th class="min-w-125px">{{translate('courseTranslation.Price')}}</th>
                                                        <th class="min-w-125px">{{translate('courseTranslation.Status')}}</th>
                                                        <th class="text-end min-w-100px px-10">{{translate('courseTranslation.Procedures')}}</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                    @foreach ($subscriptions as $subscription)
                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <!--begin::Checkbox-->
                                                            <td>
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                            </td>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Resource=-->
                                                            <!--end::Resource=-->
                                                            <!--begin::Role=-->
                                                            <!--end::Role=-->
                                                            <!--begin::Joined-->
                                                            <td>{{ $subscription->user->name }}</td>
                                                            <td>{{ $subscription->price }}</td>
                                                            <td data-status="status">
                                                                <span id="subscriptionStatusSpan"
                                                                    @if ($subscription->isPending())
                                                                        class="badge badge-light-success fw-bold px-4 py-3"
                                                                    @elseif ($subscription->isFinished() || $subscription->isCanceled())
                                                                        class="badge badge-light-danger fw-bold px-4 py-3"
                                                                    @endif
                                                                >{{ $subscription->status() }}</span>
                                                            </td>
                                                                                                                        <!--begin::Joined-->
                                                            <!--begin::Action=-->
                                                            <td class="text-end">
                                                                <a href="#"
                                                                    class="btn btn-light btn-active-light-primary btn-sm"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">{{translate('resourceTranslation.Procedures')}}
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                                    <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
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
                                                                    @can(READ_SUBSCRIPTION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('subscriptions.show', $subscription->id) }}"
                                                                            class="menu-link px-3">{{translate('courseTranslation.Show')}}</a>
                                                                    </div>
                                                                    @endcan
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    @can(DELETE_SUBSCRIPTION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <form action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                                            method="post" data-kt-subscription-table-filter="delete_form">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a href=""
                                                                            class="menu-link px-3"
                                                                            data-kt-subscription-table-filter="delete_row">{{translate('subscriptionTranslation.Delete')}}</a>
                                                                        </form>
                                                                    </div>
                                                                    @endcan
                                                                    @can(CANCEL_SUBSCRIPTION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('subscriptions.cancel', $subscription->id) }}"
                                                                            class="menu-link px-3" data-kt-subscription-table-filter="cancel-subscription">{{translate('subscriptionTranslation.Cancel')}}</a>
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
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                    </div>
                    <!--end::Content-->
                </div>

                <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">{{translate('courseTranslation.AddNewSubscription')}}</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-resources-modal-action="close">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                fill="currentColor" />
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                                <form id="kt_modal_add_schedule_form" class="form"
                                    action="{{ route('subscriptions.store') }}" method="POST">
                                    @csrf
                                    <!--begin::Input group-->
                                    <input type="hidden" class="d-none form-control form-control-solid"
                                            name="course_id" value="{{ $course->id }}" />

                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.User')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <select name="user_id" class="form-select form-select-solid"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="{{translate('courseTranslation.User')}}" required>
                                                        @foreach ($users as $user)
                                                            @if ($user->email_verified_at != null)
                                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.Price')}}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="price"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="{{translate('courseTranslation.Price')}}" min="1"
                                                    value="{{ $course->price }}" />
                                            </div>
                                    <!--end::Input group-->

                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-resources-modal-action="cancel">{{translate('courseTranslation.Cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">{{translate('courseTranslation.Add')}}</span>
                                            <span class="indicator-progress">{{translate('courseTranslation.Waiting')}}
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
                <!--end::Layout-->
                <!--begin::Modals-->
                <!--begin::Modal - Update category details-->
                <!--begin::Modal - Update resource details-->
                <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('courses.update', $course->id) }}" method="POST"
                                id="kt_modal_update_resource_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_resource_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{translate('courseTranslation.UpdateCourseDetails')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-resources-modal-action="close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                    height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                    fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2"
                                                    rx="1" transform="rotate(45 7.41422 6)"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Form-->
                                    <form id="kt_modal_add_schedule_form" class="form"
                                        action="{{ route('courses.update', $course->id) }}">

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="d-block fw-semibold fs-6 mb-5">{{translate('courseTranslation.Image')}}</label>
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
                                                    data-bs-toggle="tooltip" title="{{translate('courseTranslation.ImageChange')}}">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="avatar"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="cancel"
                                                    data-bs-toggle="tooltip" title="{{translate('courseTranslation.ImageRemove')}}">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->
                                                <!--begin::Remove-->
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="remove"
                                                    data-bs-toggle="tooltip" title="{{translate('courseTranslation.ImageRemove')}}">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Remove-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">{{translate('courseTranslation.AllowedFile')}}
                                            </div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold form-label mb-2">{{translate('courseTranslation.Course')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="name"
                                                value="{{ $course->name }}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.Resource')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!--end::Input-->
                                        </div>



                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fw-semibold fs-6 mb-2">{{translate('courseTranslation.Description')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="description"
                                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{translate('courseTranslation.Description')}}"
                                                value="{{ $course->description }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.Price')}} </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="price"
                                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{translate('courseTranslation.Price')}}"
                                                min="1" value="{{ $course->price }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.CourseHours')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="hours"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{translate('courseTranslation.CourseHours')}}" min="1"
                                                value="{{ $course->hours }}" />
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
                                                min="1"
                                                value="{{ $course->number_seats }}"/>
                                            <!--end::Input-->
                                        </div>


                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.LectureHours') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="lecture_hours"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ translate('courseTranslation.LectureHours') }}"
                                                min="1"
                                                value="{{$course->lecture_hours}}"/>
                                            <!--end::Input-->
                                        </div>



                                    <!--begin::Input group-->

                                    <div class="container">
                                        <label class="required fw-semibold fs-6 mb-2">{{ translate('courseTranslation.CourseDays') }}</label>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="card">
                                              <div class="card-body">
                                                <div class="form-check mb-2">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="monday" id="monday">
                                                  <label class="form-check-label" for="monday">Monday</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="tuesday" id="tuesday">
                                                  <label class="form-check-label" for="tuesday">Tuesday</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="wednesday" id="wednesday">
                                                  <label class="form-check-label" for="wednesday">Wednesday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="course_days[]" value="thursday" id="thursday">
                                                    <label class="form-check-label" for="thursday">Thursday</label>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="card">
                                              <div class="card-body">
                                                <h5 class="card-title">&nbsp;</h5>
                                                <div class="form-check mb-2">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="friday" id="friday">
                                                  <label class="form-check-label" for="friday">Friday</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="saturday" id="saturday">
                                                  <label class="form-check-label" for="saturday">Saturday</label>
                                                </div>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="course_days[]" value="sunday" id="sunday">
                                                  <label class="form-check-label" for="sunday">Sunday</label>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    </div>

                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">{{translate('courseTranslation.Cancel')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                                <span class="indicator-label">{{translate('courseTranslation.Update')}}</span>
                                                <span class="indicator-progress">{{translate('courseTranslation.Waiting')}}
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                        </div>
                    </div>
                    <!--end::Modal - تحديث تفاصيل الحجز-->

                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    @endsection
    @push('scripts')
        <!--begin::Javascript-->

        @if(Cookie::get(APP_LOCALE) == 'ar')
            <script src="{{ asset('assets/js/custom/apps/courses/view/table.js') }}"></script>
        @else
            <script src="{{ asset('assets/js/custom/apps/courses/view/table-en.js') }}"></script>
        @endif

        <!--end::Custom Javascript-->
    @endpush
