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
                        {{translate('debtsTranslation.view_debt_detail')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{translate('debtsTranslation.dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('debts.onUs') }}"
                                class="text-muted text-hover-primary">{{translate('debtsTranslation.debts')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('debts.show', $debt->id) }}"
                                class="text-muted text-hover-primary">{{translate('debtsTranslation.view')}}</a>
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

                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                        class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $debt->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge-lg badge-light-primary d-inline">{{ $debt->phone }}
                                        </div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <!--begin::Info heading-->

                                    <!--end::Info heading-->
                                    <div class="d-flex flex-wrap flex-center">
                                        <!--begin::Stats-->

                                        <!--begin::Stats-->

                                        <!--end::Stats-->
                                        <!--begin::Stats-->

                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Category Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#kt_debt_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_debt_view_details">
                                        {{translate('debtsTranslation.details')}}
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
                                    @can(UPDATE_DEBT_PERMISSION)
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_update_details">{{translate('debtsTranslation.edit')}}</a>
                                        </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_debt_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">



                                        <!--begin::Details item-->

                                        <div class="fw-bold mt-5">{{translate('debtsTranslation.person_name')}}
                                        </div>
                                        <div class="text-gray-600">{{ $debt->person_name }}</div>

                                        <div class="fw-bold mt-5"> {{translate('debtsTranslation.amount')}}</div>
                                        <div class="text-gray-600">{{ $debt->amount }}</div>

                                        <div class="fw-bold mt-5">{{translate('debtsTranslation.currency')}} </div>
                                        <div class="text-gray-600">{{ $debt->currency->name }}</div>

                                        <div class="fw-bold mt-5"> {{translate('debtsTranslation.debt_date')}}</div>
                                        <div class="text-gray-600">{{ $debt->debt_date }}</div>
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
                                   href="#kt_debt_view_overview_tab">Overview</a>
                            </li> --}}
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item ms-auto">
                                <!--begin::Action menu-->
                                <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                    data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">{{translate('debtsTranslation.procedures')}}
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
                                    @can(DELETE_DEBT_PERMISSION)
                                        <div class="menu-item px-3">
                                            <form action="{{ route('debts.destroy', $debt->id) }}" method="post"
                                                data-kt-debts-table-filter="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="menu-link text-danger px-5"
                                                    data-kt-debts-table-filter="delete_row">{{translate('debtsTranslation.delete_debt')}}</a>
                                            </form>
                                        </div>

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
            <!--begin::Modal - Update debt details-->
            <!--begin::Modal - Update debt details-->
            <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="{{ route('debts.update', $debt->id) }}" method="POST"
                            id="kt_modal_update_debt_form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_update_debt_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold"> {{translate('debtsTranslation.update_debt_detail')}} </h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-debts-modal-action="close">
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
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Form-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_debt_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_update_debt_header"
                                    data-kt-scroll-wrappers="#kt_modal_update_debt_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">{{translate('debtsTranslation.person_name')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="person_name" value="{{$debt->person_name}}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="{{translate('debtsTranslation.person_name')}}" required />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group select debt-->

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">
                                            {{translate('debtsTranslation.amount')}} </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="amount" value="{{$debt->amount}}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="{{translate('debtsTranslation.amount')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">{{translate('debtsTranslation.currency')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="currency_id"
                                                class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="{{translate('debtsTranslation.currency')}}" required>
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}">
                                                        {{ $currency->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{translate('debtsTranslation.debt_date')}}</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true"
                                                data-bs-content="Select a date & time."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" value="{{$debt->debt_date}}"
                                            placeholder="Select a date & time." name="debt_date"
                                            id="kt_modal_add_debts_datepicker" />
                                        <!--end::Input-->
                                    </div>


                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" class="btn btn-light me-3"
                                    data-kt-debts-modal-action="cancel">{{translate('debtsTranslation.cancel')}}
                                </button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary" data-kt-debts-modal-action="submit">
                                    <span class="indicator-label">{{translate('debtsTranslation.update')}}</span>
                                    <span class="indicator-progress">{{translate('debtsTranslation.waiting')}}
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
            <!--end::Modal - تحديث تفاصيل التصنيف-->

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
        <script src="{{ asset('assets/js/custom/apps/debts/view/update-debt.js') }}"></script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-debts-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this);

                    toastr.options = {
                        "positionClass": "toast-bottom-left",
                    }

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "هل انت متاكد انك تريد حذف هذا الدين  !?",
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
                                data: form
                            .serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Show success message
                                        toastr.success(response.message);

                                        // Redirect to 'resources.index' route
                                        window.location.href =
                                        '{{ route('debts.onUs') }}';
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
        <script src="{{ asset('assets/js/custom/apps/debts/view/update-debt-en.js') }}"></script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-debts-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const deleteButton = $(this);

                    toastr.options = {
                        "positionClass": "toast-bottom-right",
                    }

                    const form = deleteButton.closest('form');
                    Swal.fire({
                        text: "Are you sure you want to delete this Debt?",
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
                                data: form
                            .serialize(), // Include the CSRF token and the DELETE method
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Show success message
                                        toastr.success(response.message);

                                        // Redirect to 'resources.index' route
                                        window.location.href =
                                        '{{ route('debts.onUs') }}';
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
