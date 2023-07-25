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
                        {{ translate('planTranslation.ListPlans') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('planTranslation.addplan') }} </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('plans.index') }}"
                                class="text-muted text-hover-primary">{{ translate('planTranslation.plans') }}</a>
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
                            @foreach ($plans as $plan)
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <!--begin::Card-->
                                    <div class="card card-flush h-md-100">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>{{ $plan->name }}</h2>
                                            </div>
                                            <!--end::Card title-->
                                        </div>


                                        <div class="card-header">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                price:
                                                {{ $plan->price }}
                                            </div>
                                            <!--end::Card title-->
                                        </div>





                                        <!--end::Card header-->
                                        <!--begin::Card body-->

                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <div class="d-flex card-footer flex-wrap pt-0">
                                            @can(UPDATE_PLANE_PERMISSION)
                                            <a href="{{ route('plans.update', $plan->id) }}"
                                                class="btn btn-primary btn-active-primary my-1 me-2">
                                                {{ translate('planTranslation.ViewPlan') }}</a>
                                            @endcan
                                            @can(DELETE_PLANE_PERMISSION)
                                            <form action="{{ route('plans.destroy', $plan->id) }}" method="post"
                                                data-kt-plan-table-filter="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <a href="" data-kt-plan-table-filter="delete_row"
                                                    class="btn btn-danger my-1 me-2">{{ translate('planTranslation.DeletePlan') }}</a>
                                            </form>
                                            @endcan
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                            @endforeach
                            @can(CREATE_PLANE_PERMISSION)
                            <!--begin::Add new card-->
                            <div class="ol-md-4">
                                <!--begin::Card-->
                                <div class="card h-md-100">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_plan">
                                            <!--begin::Illustration-->
                                            <img src="assets/media/illustrations/sketchy-1/4.png" alt=""
                                                class="mw-100 mh-150px mb-7" />
                                            <!--end::Illustration-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-2 text-gray-600 text-hover-primary">
                                                {{ translate('planTranslation.addplan') }}</div>
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
                        <div class="modal fade" id="kt_modal_add_plan" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold "> {{ translate('planTranslation.addplan') }}</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-plans-modal-action="close">
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
                                        <form id="kt_modal_add_plan_form" class="form"
                                            action="{{ route('plans.store') }}" method="POST">
                                            @csrf
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                id="kt_modal_add_plan_scroll" data-kt-scroll="true"
                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                data-kt-scroll-max-height="auto"
                                                data-kt-scroll-dependencies="#kt_modal_add_plan_header"
                                                data-kt-scroll-wrappers="#kt_modal_add_plan_scroll"
                                                data-kt-scroll-offset="300px">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                        <span class="required">{{ translate('planTranslation.nameplane') }}
                                                        </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid"
                                                        placeholder=" {{ translate('planTranslation.nameplane') }}"
                                                        name="name" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Permissions-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                        <span class="required">
                                                            {{ translate('planTranslation.descriptionplane') }}</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid"
                                                        placeholder="{{ translate('planTranslation.descriptionplane') }}"
                                                        name="description" />
                                                    <!--end::Input-->
                                                </div>

                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                        <span class="required">
                                                            {{ translate('planTranslation.Planprice') }}</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid"
                                                        placeholder=" {{ translate('planTranslation.Planprice') }}"
                                                        type="number" name="price" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Permissions-->
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-kt-plans-modal-action="cancel">
                                                    {{ translate('planTranslation.cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-plans-modal-action="submit">
                                                    <span class="indicator-label">{{ translate('planTranslation.add') }}
                                                    </span>
                                                    <span
                                                        class="indicator-progress">{{ translate('planTranslation.wait') }}
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
        <script src="{{ asset('assets/js/custom/apps/plans/list/add-plan.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-plan-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const cardElement = $(this).closest('.col-md-4'); // Find the parent col-md-4 element (card container)


                    const form = $(this).closest('form');
                    Swal.fire({
                        text: "هل أنت متأكد من أنك تريد حذف هذه الخطة؟",
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
        <script src="{{ asset('assets/js/custom/apps/plans/list/add-plan-en.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '[data-kt-plan-table-filter="delete_row"]', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const cardElement = $(this).closest('.col-md-4'); // Find the parent col-md-4 element (card container)


                    const form = $(this).closest('form');
                    Swal.fire({
                        text: "Are you sure you want to Delete this Plan ?",
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
