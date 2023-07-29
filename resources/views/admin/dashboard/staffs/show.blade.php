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
                        {{ translate('staffTranslation.ViewStaffDetails') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.Dashboard') }} </a>
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
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('staffs.show', $staff->id) }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.View') }}</a>
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
                                        {{ $staff->name }}
                                    </h1>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->

                                    <!--end::Position-->
                                    <!--begin::Info-->


                                    <!--end::Info-->
                                </div>
                                <!--end::Category Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#kt_category_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_category_view_details">
                                        {{ translate('staffTranslation.Details') }}
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
                                    @can(UPDATE_STAFF_PERMISSION)
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_update_details">{{ translate('staffTranslation.Edit') }}</a>
                                        </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_category_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">


                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ translate('staffTranslation.Staff Name') }}</div>
                                        <div class="text-gray-600">{{ $staff->name }}</div>
                                        <div class="fw-bold mt-5">{{ translate('staffTranslation.Email') }}</div>
                                        <div class="text-gray-600">{{ $staff->email }}</div>
                                        <div class="fw-bold mt-5"> {{ translate('staffTranslation.password') }}</div>
                                        <div class="text-gray-600">{{ $staff->password }}</div>
                                        <div class="fw-bold mt-5">{{ translate('staffTranslation.Phone Number') }} </div>
                                        <div class="text-gray-600">{{ $staff->phone }}</div>
                                        <div class="fw-bold mt-5">{{ translate('staffTranslation.role') }}</div>
                                        <div class="text-gray-600">

                                            <td>
                                                @if (!empty($staff->getRoleNames()))
                                                    @foreach ($staff->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>

                                        </div>


                                        <!--begin::Details item-->
                                        <!--begin::Details item-->

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
                                    data-kt-menu-placement="bottom-end">{{ translate('staffTranslation.procedures') }}
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
                                    @can(DELETE_STAFF_PERMISSION)
                                        <div class="menu-item px-3">
                                            <form action="{{ route('staffs.destroy', $staff->id) }}" method="post"
                                                data-kt-staffs-table-filter="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <input hidden="hidden" data-canDeleted="canDeleted"
                                                    value="{{ $staff->canDeleted() }}">
                                                <a href="#" class="menu-link text-danger px-3"
                                                    data-kt-staffs-table-filter="delete_row">{{ translate('staffTranslation.Delete') }}</a>
                                            </form>
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
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
                <!--begin::Modals-->
                <!--begin::Modal - Update category details-->
                <!--begin::Modal - Update user details-->
                <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('staffs.update', $staff->id) }}" method="POST"
                                id="kt_modal_update_user_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_user_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold"> {{ translate('staffTranslation.UpdateStaffData') }}
                                    </h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-users-modal-action="close">
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
                                        action="{{ route('staffs.update', $staff->id) }}">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                class="required fs-6 fw-semibold form-label mb-2">{{ translate('staffTranslation.Staff Name') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="name"
                                                value="{{ $staff->name }}" />
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                class="required fs-6 fw-semibold form-label mb-2">{{ translate('staffTranslation.Email') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid" name="email"
                                                value="{{ $staff->email }}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                class="required fs-6 fw-semibold form-label mb-2">{{ translate('staffTranslation.password') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" class="form-control form-control-solid"
                                                name="password" />
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label
                                                class="required fs-6 fw-semibold form-label mb-2">{{ translate('staffTranslation.Phone Number') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="phone" value="{{ $staff->phone }}" />
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
                                                    data-placeholder="{{ translate('staffTranslation.roles') }}" required>
                                                    @foreach ($roles as $name => $id)
                                                        <option value="{{ $id }}">
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-kt-users-modal-action="cancel">{{ translate('staffTranslation.cancel') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-users-modal-action="submit">
                                                <span class="indicator-label">{{ translate('staffTranslation.update') }}
                                                </span>
                                                <span class="indicator-progress">{{ translate('staffTranslation.wait') }}
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->

                                        <!--end::Form-->
                                    </form>
                                </div>
                            </form>
                        </div>
                        <!--end::Modal - تحديث تفاصيل الحجز-->
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
@endsection
@push('scripts')
    <!--begin::Javascript-->
    @if (Cookie::get(APP_LOCALE) == 'ar')
        <script src="{{ asset('assets/js/custom/apps/staffs/view/update-staff.js') }}"></script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-staffs-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this);

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "هل انت متاكد انك تريد حذف هذا الموظف   !?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "نعم , احذف!",
                        cancelButtonText: "لا , تراجع!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: form.attr('action'),
                                type: 'POST',
                                data: form.serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Show success message
                                        toastr.success(response.message);

                                        // Redirect to 'resources.index' route
                                        window.location.href = '{{ route("staffs.index") }}';
                                    } else if (response.status === 'warning') {
                                        Swal.fire('Warning', response.message, 'warning');
                                    } else {
                                        Swal.fire('Error', response.message, 'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @else
        <script src="{{ asset('assets/js/custom/apps/staffs/view/update-staff-en.js') }}"></script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-staffs-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this);

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "Are you sure you want to delete this staff ?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes , Delete",
                        cancelButtonText: "No , Back",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: form.attr('action'),
                                type: 'POST',
                                data: form.serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Show success message
                                        toastr.success(response.message);

                                        // Redirect to 'resources.index' route
                                        window.location.href = '{{ route("staffs.index") }}';
                                    } else if (response.status === 'warning') {
                                        Swal.fire('Warning', response.message, 'warning');
                                    } else {
                                        Swal.fire('Error', response.message, 'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endif
    <!--end::Custom Javascript-->
@endpush
