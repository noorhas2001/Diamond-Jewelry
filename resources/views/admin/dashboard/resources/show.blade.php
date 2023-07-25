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
                        {{translate('resourceTranslation.ShowResourceDetails')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                               class="text-muted text-hover-primary">{{translate('resourceTranslation.Dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('resources.index') }}"
                               class="text-muted text-hover-primary">{{translate('resourceTranslation.Resources')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('resources.show', $resource->id) }}"
                               class="text-muted text-hover-primary">{{translate('resourceTranslation.Show')}}</a>
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
                                <!--begin::Resource Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="{{ asset($resource->imageUrl() ?? 'assets/img/avatar.jpeg') }}"
                                             alt="image"/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                       class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $resource->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge-lg badge-light-primary d-inline">{{ $resource->description }}
                                        </div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->

                                </div>
                                <!--end::Resource Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                         href="#kt_resource_view_details" role="button" aria-expanded="false"
                                         aria-controls="kt_resource_view_details">{{translate('resourceTranslation.Details')}}
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                            fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    @can(UPDATE_RESOURCE_PERMISSION)
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                              title="Edit customer details">
                                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_update_details">{{translate('resourceTranslation.Edit')}}</a>
                                    </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_resource_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.Category')}}</div>
                                        <div class="text-gray-600">
                                            <a href="#"
                                               class="text-gray-600 text-hover-primary">{{ $resource->category->name }}</a>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.NumberSeats')}}</div>
                                        <div class="text-gray-600">{{ $resource->number_seats }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.HourPrice')}}</div>
                                        <div class="text-gray-600">{{ $resource->price_by_hour }}</div>
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.DayPrice')}}</div>
                                        <div class="text-gray-600">{{ $resource->price_by_day }} </div>
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.WeekPrice')}}</div>
                                        <div class="text-gray-600">{{ $resource->price_by_weak }}</div>
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.MonthPrice')}}</div>
                                        <div class="text-gray-600">{{ $resource->price_by_month }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->

                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.AddedBy')}}</div>
                                        <div class="text-gray-600">{{ $resource?->user?->user_type }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.AddedDate')}}</div>
                                        <div class="text-gray-600">{{ $resource->created_at }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{translate('resourceTranslation.UpdateDate')}}</div>
                                        <div class="text-gray-600">{{ $resource->updated_at }}</div>
                                        <!--begin::Details item-->
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
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                   href="#kt_resource_view_overview_tab">{{translate('resourceTranslation.Overview')}}</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item ms-auto">
                                <!--begin::Action menu-->
                                <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                   data-kt-menu-attach="parent"
                                   data-kt-menu-placement="bottom-end">{{translate('resourceTranslation.Proccesses')}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-2 me-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                     data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5">تقارير</a>
                                    </div>
                                    <!--end::Menu item-->
                                    @can(DELETE_RESOURCE_PERMISSION)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('resources.destroy', $resource->id) }}"
                                               class="menu-link text-danger px-5"
                                               data-kt-resources-table-filter="delete_row">{{translate('resourceTranslation.DeleteResource')}}</a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endcan
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu-->
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_resource_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">{{translate('resourceTranslation.ResourceReservations')}}</h2>

                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        @can(CREATE_RESERVATION_PERMISSION)
                                            <div class="card-toolbar">
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                                    <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                                    {{translate('resourceTranslation.AddReservation')}}
                                                </button>
                                            </div>
                                        @endcan
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body py-4">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                   id="kt_table_resources">
                                                <!--begin::Table head-->
                                                <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                   data-kt-check="true"
                                                                   data-kt-check-target="#kt_table_resources .form-check-input"
                                                                   value="1"/>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-125px">{{translate('resourceTranslation.ReservationName')}}</th>
                                                    <th class="min-w-125px">{{translate('reservationTranslation.User')}}</th>
                                                    <th class="min-w-125px">{{translate('reservationTranslation.course_name')}}</th>
                                                    <th class="min-w-125px px-10">{{translate('resourceTranslation.Status')}}</th>
                                                    <th class="min-w-125px">{{translate('resourceTranslation.PaymentMethod')}}</th>
                                                    <th class="min-w-125px">{{translate('resourceTranslation.num_reservation_times')}}</th>
                                                    <th class="text-end min-w-100px px-10">{{translate('resourceTranslation.Procedures')}}</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                @foreach ($reservations as $reservation)
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Checkbox-->
                                                        <td>
                                                            <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="1"/>
                                                            </div>
                                                        </td>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Resource=-->
                                                        <!--end::Resource=-->
                                                        <!--begin::Role=-->
                                                        <td>
                                                            <a class="text-gray-800"
                                                               @can(READ_RESERVATION_PERMISSION) href="{{route('reservations.show' , $reservation->id)}}" @endcan>
                                                                {{$reservation->name}}
                                                            </a>
                                                        </td>
                                                        <!--end::Role=-->
                                                        <!--begin::Joined-->
                                                        <td>
                                                            <a class="text-gray-800"
                                                               @can(READ_USER_PERMISSION) href="{{route('users.show' , $reservation?->user?->id ?? 0)}}" @endcan>
                                                                {{$reservation?->user?->name}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a class="text-gray-800"
                                                               @can(READ_USER_PERMISSION) href="{{route('courses.show' , $reservation?->course?->id ?? 0)}}" @endcan>
                                                                {{$reservation?->course?->name}}
                                                            </a>
                                                        </td>
                                                        <td data-status="status">
                                                                <span id="reservationStatusSpan"
                                                                      @if ($reservation->isPending())
                                                                          class="badge badge-light-success fw-bold px-4 py-3"
                                                                      @elseif ($reservation->isFinished() || $reservation->isCanceled())
                                                                          class="badge badge-light-danger fw-bold px-4 py-3"
                                                                    @endif
                                                                >{{ $reservation->status() }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $reservation->payment_method->name }}</span>
                                                        </td>
                                                        <!--begin::Joined-->
                                                        <td class="px-12">
                                                            <a @can(READ_RESERVATION_PERMISSION) href="{{route('reservations.show' , $reservation->id)}}" @endcan>
                                                                {{count($reservation->reservationTimes)}}
                                                            </a>
                                                        </td>

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
                                                                                    fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                            <!--begin::Menu-->
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                 data-kt-menu="true">
                                                                <!--begin::Menu item-->
                                                                @can(READ_RESERVATION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('reservations.show', $reservation->id) }}"
                                                                           class="menu-link px-3">{{translate('resourceTranslation.Show')}}</a>
                                                                    </div>
                                                                @endcan
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                @can(DELETE_RESERVATION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('reservations.destroy', $reservation->id) }}"
                                                                           class="menu-link px-3"
                                                                           data-kt-resources-table-filter="delete_row">{{translate('resourceTranslation.Delete')}}</a>
                                                                    </div>
                                                                @endcan
                                                                @can(CANCEL_RESERVATION_PERMISSION)
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('reservations.cancel', $reservation->id) }}"
                                                                           data-kt-reservation-table-filter="cancel-reservation"
                                                                           class="menu-link px-3">{{translate('resourceTranslation.Cancel')}}</a>
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
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
                <!--begin::Modals-->
                <!--begin::Modal - Update resource details-->
                <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('resources.update', $resource->id) }}" method="POST"
                                  id="kt_modal_update_resource_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_resource_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{translate('resourceTranslation.UpdateResourceDetails')}}</h2>
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
                                                      fill="currentColor"/>
                                                <rect x="7.41422" y="6" width="16" height="2"
                                                      rx="1" transform="rotate(45 7.41422 6)"
                                                      fill="currentColor"/>
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
                                    <form id="kt_modal_add_resource_form" class="form"
                                          action="{{ route('resources.update', $resource->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <!--begin::Scroll-->
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                             id="kt_modal_update_resource_scroll" data-kt-scroll="true"
                                             data-kt-scroll-activate="{default: false, lg: true}"
                                             data-kt-scroll-max-height="auto"
                                             data-kt-scroll-dependencies="#kt_modal_update_resource_header"
                                             data-kt-scroll-wrappers="#kt_modal_update_resource_scroll"
                                             data-kt-scroll-offset="300px">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="d-block fw-semibold fs-6 mb-5">{{translate('resourceTranslation.Image')}}</label>
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
                                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                            title="{{translate('resourceTranslation.ImageChange')}}">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar"
                                                               value="{{ asset($resource->imageUrl() ?? 'assets/img/avatar.jpeg') }}"
                                                               accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="avatar_remove"/>
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                            title="{{translate('resourceTranslation.ImageRemove')}}">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                            title="{{translate('resourceTranslation.ImageRemove')}}">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--begin::Hint-->
                                                <div class="form-text">{{translate('resourceTranslation.AllowedFile')}}
                                                </div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.ResourceName')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="name" value="{{ $resource->name }}"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.ResourceName')}}"
                                                       required/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group select category-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.Category')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <select name="category_id" class="form-select form-select-solid"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="{{translate('resourceTranslation.Category')}}"
                                                            required>
                                                        <option value="{{ $resource->category->id }}" selected>
                                                            {{ $resource->category->name }}</option>
                                                        @foreach ($categories as $name => $id)
                                                            <option value="{{ $id }}">{{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group select category-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fw-semibold fs-6 mb-2">{{translate('resourceTranslation.Description')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="description"
                                                       value="{{ $resource->description }}"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.Description')}}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.NumberSeats')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="number_seats"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       value="{{ $resource->number_seats }}" min="1" required/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->

                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.HourPrice')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="price_by_hour"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                       value="{{ $resource->price_by_hour }}"
                                                       min="1" required/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.DayPrice')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="price_by_day"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                       value="{{ $resource->price_by_day }}"
                                                       min="1" required/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.WeekPrice')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="price_by_weak"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                       value="{{ $resource->price_by_weak }}"
                                                       min="1" required/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.MonthPrice')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="price_by_month"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                       value="{{ $resource->price_by_month }}"
                                                       min="1" required/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Scroll-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" class="btn btn-light me-3"
                                            data-kt-resources-modal-action="cancel">{{translate('resourceTranslation.Cancel')}}
                                    </button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" class="btn btn-primary"
                                            data-kt-resources-modal-action="submit">
                                        <span class="indicator-label">{{translate('resourceTranslation.Update')}}</span>
                                        <span class="indicator-progress">{{translate('resourceTranslation.Waiting')}}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - تحديث تفاصيل المورد-->
                <!--begin::Modal - Add schedule-->
                <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">{{translate('resourceTranslation.AddReservation')}}</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                      action="{{ route('reservations.store') }}" method="POST">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold form-label mb-2">{{translate('resourceTranslation.ReservationName')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                               placeholder="{{translate('resourceTranslation.ReservationName')}}"
                                               name="name"/>
                                        <input type="hidden" class="d-none form-control form-control-solid"
                                               name="resource_id" value="{{ $resource->id }}"/>
                                        <!--end::Input-->
                                    </div>
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.UserName')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="user_id" class="form-select form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="التصنيف"
                                                    required>
                                                @foreach ($users as $user)
                                                    @if ($user->email_verified_at != null)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Input-->
                                    </div>
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.PaymentMethod')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="payment_method_id" class="form-select form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Payment Method"
                                                    required>
                                                @foreach ($payment_methods as $name => $id)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <div class="fv-row mb-7">
                                        <label for="pricing_option"> {{translate('resourceTranslation.ReservationVia')}}
                                            :</label>
                                        <select class="form-select form-select-sm form-select-solid"
                                                name="pricing_option"
                                                id="pricing_option" onclick="showInputField()">
                                            @if ($resource->price_by_hour != 0)
                                                <option value="price_by_hour"> {{translate('resourceTranslation.ReservationByHours')}}</option>
                                            @endif
                                            @if ($resource->price_by_day != 0)
                                                <option value="price_by_day"> {{translate('resourceTranslation.ReservationByDays')}}</option>
                                            @endif
                                            @if ($resource->price_by_weak != 0)
                                                <option value="price_by_weak"> {{translate('resourceTranslation.ReservationByWeeks')}}</option>
                                            @endif
                                            @if ($resource->price_by_month != 0)
                                                <option value="price_by_month"> {{translate('resourceTranslation.ReservationByMonths')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <input placeholder="{{translate('resourceTranslation.HoursNymber')}}"
                                               class="form-control form-control-solid"
                                               type="text" name="price_by_hour_input" id="price_by_hour_input"
                                               style="display:none;">


                                        <input placeholder="{{translate('resourceTranslation.DaysNymber')}}"
                                               class="form-control form-control-solid"
                                               type="text" name="price_by_day_input" id="price_by_day_input"
                                               style="display:none;">


                                        <input placeholder="{{translate('resourceTranslation.WeeksNymber')}}"
                                               class="form-control form-control-solid"
                                               type="text" name="price_by_weak_input" id="price_by_weak_input"
                                               style="display:none;">


                                        <input placeholder="{{translate('resourceTranslation.MonthsNymber')}}"
                                               class="form-control form-control-solid"
                                               type="text" name="price_by_month_input" id="price_by_month_input"
                                               style="display:none;">

                                    </div>


                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{translate('resourceTranslation.StartDate')}}</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Select a date & time."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="{{translate('resourceTranslation.EnterStartDate')}}"
                                               name="start_date" id="kt_modal_add_schedule_datepicker"/>
                                        <!--end::Input-->
                                    </div>

                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">{{translate('resourceTranslation.Cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">{{translate('resourceTranslation.Add')}}</span>
                                            <span class="indicator-progress">{{translate('resourceTranslation.Waiting')}}
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
                <!--end::Modal - Add schedule-->
                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add a Task</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                <form id="kt_modal_add_task_form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold form-label mb-2">Task Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" name="task_name"
                                               value=""/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Task Due Date</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Select a due date."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Pick date"
                                               name="task_duedate" id="kt_modal_add_task_datepicker"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">Task Description</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid rounded-3"></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Add task-->
                <!--begin::Modal - Update email-->
                <div class="modal fade" id="kt_modal_update_email" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Email Address</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                <form id="kt_modal_update_email_form" class="form" action="#">
                                    <!--begin::Notice-->
                                    <!--begin::Notice-->
                                    <div
                                            class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                        <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                      height="20" rx="10" fill="currentColor"/>
                                                <rect x="11" y="14" width="7" height="2"
                                                      rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                                                <rect x="11" y="17" width="2" height="2"
                                                      rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <div class="fs-6 text-gray-700">Please note that a valid email
                                                    address is required to complete the email verification.
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Email Address</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder=""
                                               name="profile_email" value="smith@kpmg.com"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Update email-->
                <!--begin::Modal - Update password-->
                <div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Password</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                <form id="kt_modal_update_password_form" class="form" action="#">
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="required form-label fs-6 mb-2">Current Password</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                               placeholder="" name="current_password" autocomplete="off"/>
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                                        <!--begin::Wrapper-->
                                        <div class="mb-1">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                                            <!--end::Label-->
                                            <!--begin::Input wrapper-->
                                            <div class="position-relative mb-3">
                                                <input class="form-control form-control-lg form-control-solid"
                                                       type="password" placeholder="" name="new_password"
                                                       autocomplete="off"/>
                                                <span
                                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                        data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                            </div>
                                            <!--end::Input wrapper-->
                                            <!--begin::Meter-->
                                            <div class="d-flex align-items-center mb-3"
                                                 data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                </div>
                                            </div>
                                            <!--end::Meter-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Hint-->
                                        <div class="text-muted">Use 8 or more characters with a mix of letters,
                                            numbers & symbols.
                                        </div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="form-label fw-semibold fs-6 mb-2">Confirm New Password</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                               placeholder="" name="confirm_password" autocomplete="off"/>
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Update password-->
                <!--begin::Modal - Update role-->
                <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">تحديث تفاصيل المورد</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                <form id="kt_modal_update_role_form" class="form" action="#">
                                    <!--begin::Notice-->
                                    <!--begin::Notice-->
                                    <div
                                            class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                        <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                      height="20" rx="10" fill="currentColor"/>
                                                <rect x="11" y="14" width="7" height="2"
                                                      rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                                                <rect x="11" y="17" width="2" height="2"
                                                      rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <div class="fs-6 text-gray-700">Please note that reducing a resource
                                                    role rank, that resource will lose all priviledges that was
                                                    assigned to the previous role.
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-5">
                                            <span class="required">Select a resource role</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="resource_role" type="radio"
                                                       value="0" id="kt_modal_update_role_option_0"
                                                       checked='checked'/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                    <div class="fw-bold text-gray-800">Administrator</div>
                                                    <div class="text-gray-600">Best for business owners and company
                                                        administrators
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="resource_role" type="radio"
                                                       value="1" id="kt_modal_update_role_option_1"/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                    <div class="fw-bold text-gray-800">Developer</div>
                                                    <div class="text-gray-600">Best for developers or people
                                                        primarily using the API
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="resource_role" type="radio"
                                                       value="2" id="kt_modal_update_role_option_2"/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                    <div class="fw-bold text-gray-800">Analyst</div>
                                                    <div class="text-gray-600">Best for people who need full access
                                                        to analytics data, but don't need to update business
                                                        settings
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="resource_role" type="radio"
                                                       value="3" id="kt_modal_update_role_option_3"/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_3">
                                                    <div class="fw-bold text-gray-800">Support</div>
                                                    <div class="text-gray-600">Best for employees who regularly
                                                        refund payments and respond to disputes
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="resource_role" type="radio"
                                                       value="4" id="kt_modal_update_role_option_4"/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_4">
                                                    <div class="fw-bold text-gray-800">Trial</div>
                                                    <div class="text-gray-600">Best for people who need to preview
                                                        content data, but don't need to make any updates
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Update role-->
                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_auth_app" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add Authenticator App</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Content-->
                                <div class="fw-bold d-flex flex-column justify-content-center mb-5">
                                    <!--begin::Label-->
                                    <div class="text-center mb-5" data-kt-add-auth-action="qr-code-label">Download
                                        the
                                        <a href="#">Authenticator app</a>, add a new account, then scan this barcode
                                        to set up your account.
                                    </div>
                                    <div class="text-center mb-5 d-none" data-kt-add-auth-action="text-code-label">
                                        Download the
                                        <a href="#">Authenticator app</a>, add a new account, then enter this code
                                        to set up your account.
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::QR code-->
                                    <div class="d-flex flex-center" data-kt-add-auth-action="qr-code">
                                        <img src="{{ asset('assets/media/misc/qr.png') }}" alt="Scan this QR code"/>
                                    </div>
                                    <!--end::QR code-->
                                    <!--begin::Text code-->
                                    <div class="border rounded p-5 d-flex flex-center d-none"
                                         data-kt-add-auth-action="text-code">
                                        <div class="fs-1">gi2kdnb54is709j</div>
                                    </div>
                                    <!--end::Text code-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Action-->
                                <div class="d-flex flex-center">
                                    <div class="btn btn-light-primary" data-kt-add-auth-action="text-code-button">
                                        Enter code manually
                                    </div>
                                    <div class="btn btn-light-primary d-none" data-kt-add-auth-action="qr-code-button">
                                        Scan barcode instead
                                    </div>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Add task-->
                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_one_time_password" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Enable One Time Password</h2>
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
                                                  fill="currentColor"/>
                                            <rect x="7.41422" y="6" width="16" height="2"
                                                  rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                <form class="form" id="kt_modal_add_one_time_password_form">
                                    <!--begin::Label-->
                                    <div class="fw-bold mb-9">Enter the new phone number to receive an SMS to when
                                        you log in.
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Mobile number</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="A valid mobile number is required to receive the one-time password to validate your account login."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                               name="otp_mobile_number" placeholder="+6123 456 789" value=""/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Separator-->
                                    <div class="separator saperator-dashed my-5"></div>
                                    <!--end::Separator-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Email</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="email" class="form-control form-control-solid" name="otp_email"
                                               value="smith@kpmg.com" readonly="readonly"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Confirm password</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="password" class="form-control form-control-solid"
                                               name="otp_confirm_password" value=""/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Add task-->
                <!--end::Modals-->
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
        <script src="{{ asset('assets/js/custom/apps/resources/view/update-resource.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/resources/view/add-reservation.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/resources/view/update-resource-en.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/resources/view/add-reservation-en.js') }}"></script>
    @endif

    <script>
        function showInputField() {
            const select = document.getElementById("pricing_option");
            const selectedOption = select.options[select.selectedIndex].value;

            // Hide all input fields first
            document.getElementById("price_by_hour_input").style.display = "none";
            document.getElementById("price_by_day_input").style.display = "none";
            document.getElementById("price_by_weak_input").style.display = "none";
            document.getElementById("price_by_month_input").style.display = "none";

            // Show the input field that matches the selected option
            if (selectedOption === "price_by_hour") {
                document.getElementById("price_by_hour_input").style.display = "block";
            } else if (selectedOption === "price_by_day") {
                document.getElementById("price_by_day_input").style.display = "block";
            } else if (selectedOption === "price_by_weak") {
                document.getElementById("price_by_weak_input").style.display = "block";
            } else if (selectedOption === "price_by_month") {
                document.getElementById("price_by_month_input").style.display = "block";
            }
        }
    </script>
    <!--end::Custom Javascript-->
@endpush
