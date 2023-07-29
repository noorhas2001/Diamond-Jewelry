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
                        {{ translate('staffTranslation.ListofStaffsroles') }}</h1>
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
                            <a href="{{ route('roles.index') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.roles') }}</a>
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
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Row-->
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                            @foreach ($roles as $role)
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <!--begin::Card-->
                                    <div class="card card-flush h-md-100">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>{{ $role->name }}</h2>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-1">
                                            <!--begin::Users-->
                                            <div class="fw-bold text-gray-600 mb-5">
                                                {{ translate('staffTranslation.Total') }}({{ $role->users->count() }})
                                            </div>
                                            <!--end::Users-->
                                            <div class="d-flex flex-column text-gray-600">
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <div class="d-flex card-footer flex-wrap pt-0">
                                            @can(READ_ROLE_PERMISSION)
                                                <a href="{{ route('roles.show', $role->id) }}"
                                                    class="btn btn-primary btn-active-primary my-1 me-2">{{ translate('staffTranslation.ViewRole') }}</a>
                                            @endcan
                                            @can(DELETE_ROLE_PERMISSION)
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                                                    data-kt-role-table-filter="delete_form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="" data-kt-role-table-filter="delete_row"
                                                        class="btn btn-danger my-1 me-2">{{ translate('staffTranslation.DeleteRole') }}</a>
                                                </form>
                                            @endcan
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                            @endforeach
                            @can(CREATE_ROLE_PERMISSION)
                                <!--begin::Add new card-->
                                <div class="ol-md-4">
                                    <!--begin::Card-->
                                    <div class="card h-md-100">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-center">
                                            <!--begin::Button-->
                                            <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                                <!--begin::Illustration-->
                                                <img src="assets/media/illustrations/sketchy-1/4.png" alt=""
                                                    class="mw-100 mh-150px mb-7" />
                                                <!--end::Illustration-->
                                                <!--begin::Label-->
                                                <div class="fw-bold fs-3 text-gray-600 text-hover-primary">
                                                    {{ translate('staffTranslation.AddNewRole') }}</div>
                                                <!--end::Label-->
                                            </button>
                                            <!--begin::Button-->
                                        </div>
                                        <!--begin::Card body-->
                                    </div>
                                    <!--begin::Card-->
                                </div>
                                <!--begin::Add new card-->
                            @endcan

                        </div>
                        <!--end::Row-->
                        <!--begin::Modals-->
                        <!--begin::Modal - Add role-->
                        <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">{{ translate('staffTranslation.AddRole') }}</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-roles-modal-action="close">
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
                                    <div class="modal-body scroll-y mx-lg-5 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_add_role_form" class="form"
                                            action="{{ route('roles.store') }}" method="POST">
                                            @csrf
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                id="kt_modal_add_role_scroll" data-kt-scroll="true"
                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                data-kt-scroll-max-height="auto"
                                                data-kt-scroll-dependencies="#kt_modal_add_role_header"
                                                data-kt-scroll-wrappers="#kt_modal_add_role_scroll"
                                                data-kt-scroll-offset="300px">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                        <span
                                                            class="required">{{ translate('staffTranslation.Rolename') }}</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid"
                                                        placeholder="{{ translate('staffTranslation.Rolename') }}"
                                                        name="name" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Permissions-->
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="fs-5 fw-bold form-label mb-2">{{ translate('staffTranslation.RolePermissions') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Table wrapper-->
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                            id="kt_table_roles">
                                                            <!--begin::Table body-->
                                                            <tbody class="text-gray-600 fw-semibold">
                                                                <!--begin::Table row-->
                                                                <tr>
                                                                    <td class="text-gray-800">
                                                                        {{ translate('staffTranslation.AdministratorAccess') }}
                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Allows a full access to the system"></i>
                                                                    </td>
                                                                    <td>
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                            class="form-check form-check-custom form-check-solid me-9">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="kt_roles_select_all" />
                                                                            <span class="form-check-label"
                                                                                for="kt_roles_select_all">Select all</span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </td>
                                                                </tr>
                                                                <!--end::Table row-->
                                                                @foreach ($permissions as $name => $id)
                                                                    <!--begin::Table row-->
                                                                    <tr>
                                                                        <!--begin::Label-->
                                                                        <td class="text-gray-800">{{ $name }}</td>
                                                                        <!--end::Label-->
                                                                        <!--begin::Options-->
                                                                        <td>
                                                                            <!--begin::Wrapper-->
                                                                            <div class="d-flex">
                                                                                <!--begin::Checkbox-->
                                                                                <label
                                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                    <input class="form-check-input name"
                                                                                        type="checkbox"
                                                                                        name="permission[]"
                                                                                        value="{{ $id }}" />
                                                                                </label>
                                                                                <!--end::Checkbox-->

                                                                            </div>
                                                                            <!--end::Wrapper-->
                                                                        </td>
                                                                        <!--end::Options-->
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                @endforeach

                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table wrapper-->
                                                </div>
                                                <!--end::Permissions-->
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-kt-roles-modal-action="cancel">{{ translate('staffTranslation.cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-roles-modal-action="submit">
                                                    <span
                                                        class="indicator-label">{{ translate('staffTranslation.Add') }}</span>
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
                        <!--end::Modal - Add role-->

                        <!--end::Modals-->
                    </div>
                    <!--end::Content container-->
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
        <script src="{{ asset('assets/js/custom/apps/roles/list/add.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-role-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this); // Store the clicked "Delete" button
                    const cardElement = deleteButton.closest(
                    '.col-md-4'); // Find the parent col-md-4 element (card container)

                    toastr.options = {
                        "positionClass": "toast-bottom-left",
                    }

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "هل أنت متأكد من أنك تريد حذف هذه الصلاحية؟",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "نعم ، احذف!",
                        cancelButtonText: "لا ، ارجع",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: form.attr('action'),
                                type: 'POST',
                                data: form
                                    .serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        cardElement.remove();
                                        toastr.success(response.message);
                                    } else if (response.status === 'warning') {
                                        Swal.fire('Warning', response.message, 'warning');
                                    } else {
                                        Swal.fire('Error', 'An error occurred: ' + response
                                            .message, 'error');
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
        <script src="{{ asset('assets/js/custom/apps/roles/list/add-en.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-role-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this); // Store the clicked "Delete" button
                    const cardElement = deleteButton.closest(
                    '.col-md-4'); // Find the parent col-md-4 element (card container)
                    toastr.options = {
                        "positionClass": "toast-bottom-right",
                    }

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "Are you sure you want to Delete this Role ?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes , Delete!",
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
                                data: form
                                    .serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        cardElement.remove();
                                        toastr.success(response.message);
                                    } else if (response.status === 'warning') {
                                        Swal.fire('Warning', response.message, 'warning');
                                    } else {
                                        Swal.fire('Error', 'An error occurred: ' + response
                                            .message, 'error');
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
@endpush
