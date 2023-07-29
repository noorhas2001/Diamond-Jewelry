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
                        {{ translate('staffTranslation.StaffList') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.Dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('staffs.index') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.Staffs') }}</a>
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
                                <input type="text" data-kt-staff-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14"
                                    placeholder="{{ translate('staffTranslation.Search Staff') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-staff-table-toolbar="base">

                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->{{ translate('staffTranslation.Filter') }}
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">
                                            {{ translate('staffTranslation.FilterOptions') }}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-staffs-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label
                                                class="form-label fs-6 fw-semibold">{{ translate('staffTranslation.role') }}</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                data-placeholder="Select option" data-allow-clear="true"
                                                data-kt-user-table-filter="role" data-hide-search="true">
                                                <option></option>
                                                @foreach ($roles as $name => $id)
                                                    <option value="{{ $name }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                data-kt-menu-dismiss="true"
                                                data-kt-staffs-table-filter="reset">{{ translate('staffTranslation.Reset') }}</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                data-kt-menu-dismiss="true"
                                                data-kt-staffs-table-filter="filter">{{ translate('staffTranslation.Apply') }}</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--begin::Add Resource-->
                                @can(CREATE_STAFF_PERMISSION)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_staff">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                    rx="1" transform="rotate(-90 11.364 20.364)"
                                                    fill="currentColor" />
                                                <rect x="4.36396" y="11.364" width="16" height="2"
                                                    rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{ translate('staffTranslation.Add a New Staff') }}
                                    </button>
                                @endcan
                                <!--end::Add Resource-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-staff-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2"
                                        data-kt-staff-table-select="selected_count"></span>{{ translate('staffTranslation.Selected') }}
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-staff-table-select="delete_selected">{{ translate('staffTranslation.DeleteSelected') }}
                                </button>
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Add staff-->
                            <div class="modal fade" id="kt_modal_add_staff" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_staff_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">{{ translate('staffTranslation.Add Staffs') }}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-kt-staffs-modal-action="close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="6" y="17.3137"
                                                            width="16" height="2" rx="1"
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
                                            <form id="kt_modal_add_staff_form" class="form"
                                                action="{{ route('staffs.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                    id="kt_modal_add_staff_scroll" data-kt-scroll="true"
                                                    data-kt-scroll-activate="{default: false, lg: true}"
                                                    data-kt-scroll-max-height="auto"
                                                    data-kt-scroll-dependencies="#kt_modal_add_staff_header"
                                                    data-kt-scroll-wrappers="#kt_modal_add_staff_scroll"
                                                    data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->

                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.Staff Name') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="name"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('staffTranslation.Staff Name') }}"
                                                            required />
                                                        <!--end::Input-->
                                                    </div>



                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.Email') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="email" name="email"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('staffTranslation.Email') }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.password') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="password" name="password"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('staffTranslation.password') }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.confirm password') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('staffTranslation.confirm password') }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.Phone Number') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="phone"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="{{ translate('staffTranslation.Phone Number') }}" />
                                                        <!--end::Input-->
                                                    </div>


                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required fw-semibold fs-6 mb-2">{{ translate('staffTranslation.roles') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <!--begin::Col-->
                                                        <div class="col-6">
                                                            <select name="role" class="form-select form-select-solid"
                                                                data-control="select2" data-hide-search="true"
                                                                data-placeholder="{{ translate('staffTranslation.roles') }}"
                                                                required>
                                                                @foreach ($roles as $name => $id)
                                                                    <option value="{{ $id }}">
                                                                        {{ $name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-staffs-modal-action="cancel">{{ translate('staffTranslation.cancel') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-kt-staffs-modal-action="submit">
                                                        <span class="indicator-label">
                                                            {{ translate('staffTranslation.Addstaff') }}</span>
                                                        <span
                                                            class="indicator-progress">{{ translate('staffTranslation.wait') }}
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
                            <!--end::Modal - Add staff-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->


                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_staffs">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_staffs .form-check-input"
                                                    value="" />
                                            </div>
                                        </th>

                                        <th class="min-w-125px">{{ translate('staffTranslation.Name') }}</th>
                                        <th class="min-w-125px">{{ translate('staffTranslation.Email') }}</th>
                                        <th class="min-w-125px">{{ translate('staffTranslation.Phone Number') }}</th>

                                        <th class="min-w-125px">{{ translate('staffTranslation.role') }}</th>
                                        <th class="text-end min-w-100px px-10">
                                            {{ translate('staffTranslation.procedures') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($staffs as $staff)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $staff->id }}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Resource=-->
                                            <!--end::Resource=-->
                                            <!--begin::Role=-->

                                            <td>{{ $staff->name }}</td>
                                            <!--end::Role=-->
                                            <!--begin::Joined-->
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->phone }}</td>



                                            <td>
                                                @if (!empty($staff->getRoleNames()))
                                                    @foreach ($staff->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>





                                            <!--begin::Joined-->
                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">{{ translate('staffTranslation.procedures') }}
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
                                                    @can(READ_STAFF_PERMISSION)
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('staffs.show', $staff->id) }}"
                                                                class="menu-link px-3">{{ translate('staffTranslation.View') }}</a>
                                                        </div>
                                                    @endcan
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @can(DELETE_STAFF_PERMISSION)
                                                        <div class="menu-item px-3">
                                                            <form data-kt-staffs-table-filter="delete_form"
                                                                action="{{ route('staffs.destroy', $staff->id) }}"
                                                                method="post">
                                                                <input hidden="hidden" data-canDeleted="canDeleted"
                                                                    value="{{ $staff->canDeleted() }}">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-staffs-table-filter="delete_row">{{ translate('staffTranslation.Delete') }}</a>
                                                            </form>
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
        <script src="{{ asset('assets/js/custom/apps/staffs/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/staffs/list/table-en.js') }}"></script>
    @endif

@endpush
