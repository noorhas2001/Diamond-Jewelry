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
                        {{ translate('reservationTranslation.ShowReservationDetails') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                               class="text-muted text-hover-primary">{{ translate('reservationTranslation.Dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('reservations.index') }}"
                               class="text-muted text-hover-primary">{{ translate('reservationTranslation.Reservations') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('reservations.show', $reservation->id) }}"
                               class="text-muted text-hover-primary">{{ translate('reservationTranslation.Show') }}</a>
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
                                    <h1 class="symbol symbol-100px symbol-circle mb-7">
                                        {{ $reservation->name }}
                                    </h1>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                </div>
                                <!--end::Category Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                         href="#kt_category_view_details" role="button" aria-expanded="false"
                                         aria-controls="kt_category_view_details">
                                        {{ translate('reservationTranslation.Details') }}
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
                                    @can(UPDATE_RESERVATION_PERMISSION)
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                              title="Edit customer details">
                                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                               data-bs-target="#kt_modal_update_details">{{ translate('reservationTranslation.Edit') }}</a>
                                        </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_category_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">


                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ translate('reservationTranslation.AddedBy') }}</div>
                                        <div class="text-gray-600">{{ $reservation->admin->name }}</div>
                                        @if (!$reservation->user)
                                            <div class="fw-bold mt-5">{{ translate('reservationTranslation.Course') }}
                                            </div>
                                            <div class="text-gray-600">
                                                <a class="text-gray-800" @can(READ_USER_PERMISSION) href="{{route('courses.show' , $reservation->course->id)}}" @endcan>
                                                    {{$reservation->course->name}}
                                                </a>
                                            </div>
                                        @else
                                            <div class="fw-bold mt-5">{{ translate('reservationTranslation.User') }}</div>
                                            <div class="text-gray-600">
                                                <a class="text-gray-800" @can(READ_USER_PERMISSION) href="{{route('users.show' , $reservation->user->id)}}" @endcan>
                                                    {{$reservation->user->name}}
                                                </a>
                                            </div>
                                        @endif
                                        <div class="fw-bold mt-5">{{ translate('reservationTranslation.Resource') }}</div>
                                        <div class="text-gray-600">
                                            <a class="text-gray-800" @can(READ_RESOURCE_PERMISSION) href="{{route('resources.show' , $reservation?->resource?->id ?? -1)}}" @endcan>
                                                {{$reservation->resource->name}}
                                            </a>
                                        </div>
                                        <div class="fw-bold mt-5">{{ translate('reservationTranslation.Cost') }}</div>
                                        <div class="text-gray-600">{{ $reservation->costReservationTimes() }}</div>
                                        <div class="fw-bold mt-5">{{ translate('resourceTranslation.PaymentMethod') }}
                                        </div>
                                        <div class="text-gray-600">{{ $reservation->payment_method->name }}</div>

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
                                   data-kt-menu-attach="parent"
                                   data-kt-menu-placement="bottom-end">{{ translate('reservationTranslation.Proccesses') }}
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
                                    {{-- <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5">تقارير</a>
                                    </div> --}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    @can(DELETE_RESERVATION_PERMISSION)
                                        <div class="menu-item px-3">
                                            <a href="{{ route('reservations.destroyShow', $reservation->id) }}"
                                               class="menu-link text-danger px-5"
                                               data-kt-categories-table-filter="delete_row">{{ translate('reservationTranslation.DeleteReservation') }}</a>
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


                        <!-- begin :: Reservation Times-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_resource_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">{{ translate('reservationTranslation.ReservationTimes') }}
                                            </h2>

                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body py-4">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                   id="kt_table_reservations">
                                                <!--begin::Table head-->
                                                <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                   data-kt-check="true"
                                                                   data-kt-check-target="#kt_table_reservations .form-check-input"
                                                                   value="1"/>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-125px">
                                                        {{ translate('reservationTranslation.StartTime') }}</th>
                                                    <th class="min-w-125px">
                                                        {{ translate('reservationTranslation.EndTime') }}</th>
                                                    <th class="min-w-125 px-10">
                                                        {{ translate('reservationTranslation.Status') }}</th>
                                                    <th class="text-end min-w-100px px-10">
                                                        {{ translate('reservationTranslation.Procedures') }}</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                @foreach ($reservationTimes as $reservationTime)
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
                                                        <td>{{ $reservationTime->start_time }}</td>
                                                        <td>{{ $reservationTime->end_time }}</td>
                                                        <td data-status="status">
                                                            <span id="reservationStatusSpan"
                                                                @if ($reservationTime->isPending())
                                                                    class="badge badge-light-success fw-bold px-4 py-3"
                                                                @elseif ($reservationTime->isFinished() || $reservationTime->isCanceled())
                                                                    class="badge badge-light-danger fw-bold px-4 py-3"
                                                                @endif
                                                            >{{ $reservationTime->status() }}</span>
                                                        </td>

                                                        <td class="text-end">
                                                            <a href="#"
                                                               class="btn btn-light btn-active-light-primary btn-sm"
                                                               data-kt-menu-trigger="click"
                                                               data-kt-menu-placement="bottom-end">{{ translate('reservationTranslation.Procedures') }}
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

                                                                <div class="menu-item px-3">
                                                                    <form
                                                                            action="{{ route('reservationsTime.destroy', $reservationTime->id) }}"
                                                                            method="post"
                                                                            data-kt-reservation-table-filter="delete_form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="" class="menu-link px-3"
                                                                           data-kt-reservation-table-filter="delete_row">{{ translate('reservationTranslation.Delete') }}</a>
                                                                    </form>

                                                                </div>

                                                                <div class="menu-item px-3">
                                                                    <a href="{{ route('reservationsTime.cancel', $reservationTime->id) }}"
                                                                       class="menu-link px-3"
                                                                       data-kt-reservation-table-filter="cancel-reservation">{{ translate('reservationTranslation.Cancel') }}</a>
                                                                </div>


                                                            </div>

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
                        <!-- end :: Reservation Times-->

                    </div>

                    <!--end::Content-->
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
                            <form class="form" action="{{ route('reservations.update', $reservation->id) }}"
                                  method="POST" id="kt_modal_update_reservation_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_resource_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{ translate('reservationTranslation.UpdateReservationDetails') }}
                                    </h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                         data-kt-reservations-modal-action="close">
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
                                    <form id="kt_modal_add_schedule_form" class="form"
                                          action="{{ route('reservations.update', $reservation->id) }}">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                    class="required fs-6 fw-semibold form-label mb-2">{{ translate('reservationTranslation.Reservation') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="name"
                                                   value="{{ $reservation->name }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->


                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                    data-kt-reservations-modal-action="cancel">{{ translate('reservationTranslation.Cancel') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                    data-kt-reservations-modal-action="submit">
                                                <span
                                                        class="indicator-label">{{ translate('reservationTranslation.Update') }}</span>
                                                <span
                                                        class="indicator-progress">{{ translate('reservationTranslation.Waiting') }}
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
            @if (Cookie::get(APP_LOCALE) == 'ar')
                <script src="{{ asset('assets/js/custom/apps/reservations/view/update-reservation.js') }}"></script>
            @else
                <script src="{{ asset('assets/js/custom/apps/reservations/view/update-reservation-en.js') }}"></script>
            @endif
            <!--end::Custom Javascript-->
    @endpush
