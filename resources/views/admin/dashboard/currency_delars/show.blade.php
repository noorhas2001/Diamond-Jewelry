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
                        عرض تفاصيل تجار العملة</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('employeeTranslation.Dashborad') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('currency_delars.index') }}" class="text-muted text-hover-primary">تجار
                                العملة</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('currency_delars.show', $currency_delar->id) }}"
                                class="text-muted text-hover-primary">{{ translate('employeeTranslation.View') }}</a>
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
                                        class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $currency_delar->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge-lg badge-light-primary d-inline">{{ $currency_delar->phone }}
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
                                        href="#kt_delar_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_delar_view_details">
                                        {{ translate('employeeTranslation.Details') }}
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
                                    @can(UPDATE_CURRENCY_DELAR_PERMISSION)
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_update_details">{{ translate('employeeTranslation.Edit') }}</a>
                                        </span>
                                    @endcan
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_delar_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">



                                        <!--begin::Details item-->

                                        <div class="fw-bold mt-5"> حساب الشيكل</div>
                                        <div class="text-gray-600">{{ $currency_delar->shekels_balance() }}</div>

                                        <div class="fw-bold mt-5">حساب الدولار</div>
                                        <div class="text-gray-600">{{ $currency_delar->dollars_balance() }}</div>

                                        <div class="fw-bold mt-5"> حساب الدينار</div>
                                        <div class="text-gray-600">{{ $currency_delar->dinars_balance() }}</div>

                                        <div class="fw-bold mt-5"> رقم الهاتف</div>
                                        <div class="text-gray-600">{{ $currency_delar->phone }}</div>

                                        <div class="fw-bold mt-5"> ملاحظات</div>
                                        <div class="text-gray-600">{{ $currency_delar->notes }}</div>
                                        <div class="fw-bold mt-5"> {{ translate('employeeTranslation.created_at') }}</div>
                                        <div class="text-gray-600">{{ \Carbon\Carbon::parse($currency_delar->created_at)->format('Y-m-d h:i A') }}</div>

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


                        <!--start::Delar Transactions-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_resource_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">معاملات التاجر
                                            </h2>

                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <div class="d-flex justify-content-end" data-kt-delar-table-toolbar="base">
                                                @can(CREATE_TRANSACTIONS_CURRENCY_DELAR_PERMISSION)
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add_transaction">
                                                    <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                                    معاملة
                                                </button>
                                                @endcan
                                            </div>

                                            <div class="d-flex justify-content-end align-items-center d-none"
                                                data-kt-delar-table-toolbar="selected">
                                                <div class="fw-bold me-5">
                                                    <span class="me-2"
                                                        data-kt-delar-table-select="selected_count"></span>{{ translate('employeeTranslation.Selected') }}
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                    data-kt-delar-table-select="delete_selected">{{ translate('employeeTranslation.DeleteSelected') }}
                                                </button>
                                            </div>
                                        </div>
                                        <!--end::Card toolbar-->




                                        <!--begin::Modal - Add Transaction-->
                                        <div class="modal fade" id="kt_modal_add_transaction" tabindex="-1"
                                            aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header" id="kt_modal_add_transaction_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">اضافة معاملة جديدة</h2>
                                                        <!--end::Modal title-->
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                            data-kt-transactions-modal-action="close">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="6" y="17.3137"
                                                                        width="16" height="2" rx="1"
                                                                        transform="rotate(-45 6 17.3137)"
                                                                        fill="currentColor" />
                                                                    <rect x="7.41422" y="6" width="16"
                                                                        height="2" rx="1"
                                                                        transform="rotate(45 7.41422 6)"
                                                                        fill="currentColor" />
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
                                                        <form id="kt_modal_add_transaction_form" class="form"
                                                            action="{{ route('transactions.store') }}" method="POST"
                                                            enctype="multipart/form-data">


                                                            @csrf
                                                            <!--begin::Scroll-->
                                                            <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                                id="kt_modal_add_transaction_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#kt_modal_add_transaction_header"
                                                                data-kt-scroll-wrappers="#kt_modal_add_transaction_scroll"
                                                                data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->


                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <input class="d-none" name="delar_id" type="hidden"
                                                                    value="{{ $currency_delar->id }}">
                                                                <!--end::Input group-->
                                                                <!--begin::Input group select delar-->

                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="required fw-semibold fs-6 mb-2">نوع
                                                                        المعاملة</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-6">
                                                                        <select name="transaction_type"
                                                                            class="form-select form-select-solid"
                                                                            data-control="select2" data-hide-search="true"
                                                                            data-placeholder="نوع المعاملة" required>
                                                                            <option value=""></option>
                                                                            <option value="استلام">استلام</option>
                                                                            <option value="دفعة">دفعة</option>
                                                                        </select>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                    <!--end::Input-->
                                                                </div>

                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="required fw-semibold fs-6 mb-2">
                                                                        المبلغ </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="number" name="amount"
                                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                                        placeholder="المبلغ" />
                                                                    <!--end::Input-->
                                                                </div>

                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="required fw-semibold fs-6 mb-2">{{ translate('expenseTranslation.currency') }}</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-6">
                                                                        <select name="currency_id"
                                                                            class="form-select form-select-solid"
                                                                            data-control="select2" data-hide-search="true"
                                                                            data-placeholder="{{ translate('expenseTranslation.currency') }}"
                                                                            required>
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
                                                                    <label class=" fw-semibold fs-6 mb-2">
                                                                        ملاحظات </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" name="notes"
                                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                                        placeholder="ملاحظات" />
                                                                    <!--end::Input-->
                                                                </div>


                                                            </div>
                                                            <!--end::Scroll-->
                                                            <!--begin::Actions-->
                                                            <div class="text-center pt-15">
                                                                <button type="reset" class="btn btn-light me-3"
                                                                    data-kt-transactions-modal-action="cancel">{{ translate('employeeTranslation.cancel') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-kt-transactions-modal-action="submit">
                                                                    <span
                                                                        class="indicator-label">{{ translate('employeeTranslation.add') }}</span>
                                                                    <span
                                                                        class="indicator-progress">{{ translate('employeeTranslation.Waiting') }}
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
                                        <!--end::Modal - Add Transaction-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body py-4">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                id="kt_table_transactions">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-10px pe-2">
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    data-kt-check="true"
                                                                    data-kt-check-target="#kt_table_transactions .form-check-input"
                                                                    value="" />
                                                            </div>
                                                        </th>
                                                        <th class="min-w-125px">المعاملة</th>
                                                        <th class="min-w-125px">المبلغ</th>
                                                        <th class="min-w-125px">العملة</th>
                                                        <th class="min-w-125px">التاريخ</th>
                                                        <th class="min-w-125px">ملاحظات</th>
                                                        <th class="text-end min-w-100px px-10">
                                                            الاجراءات</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                    @foreach ($transactions as $transaction)
                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <!--begin::Checkbox-->
                                                            <td>
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $transaction->id }}" />
                                                                </div>
                                                            </td>
                                                            <!--end::Checkbox-->

                                                            <td>{{ $transaction->transaction_type }}</td>
                                                            <td>{{ $transaction->amount }}</td>
                                                            <td>{{ $transaction->currency->name }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d h:i A') }}</td>
                                                            <td>{{ $transaction->notes }}</td>

                                                            <!--begin::Action=-->
                                                            <td class="text-end">
                                                                <a href="#"
                                                                    class="btn btn-light btn-active-light-primary btn-sm"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">الاجراءات
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
                                                                    <div class="menu-item px-3">
                                                                        <form
                                                                            action="{{ route('transactions.destroy', $transaction->id) }}"
                                                                            method="post"
                                                                            data-kt-transaction-table-filter="delete_form">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a href="" class="menu-link px-3"
                                                                                data-kt-transcation-table-filter="delete_row">حذف</a>
                                                                        </form>
                                                                    </div>
                                                                    {{-- @endcan --}}
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
                        <!--end::Delar Transactions-->
                    </div>

                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
            <!--begin::Modals-->
            <!--begin::Modal - Update delar details-->
            <!--begin::Modal - Update delar details-->
            <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="{{ route('currency_delars.update', $currency_delar->id) }}"
                            method="POST" id="kt_modal_update_delar_form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_update_delar_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold"> تحديث تفاصيل تاجر العملة </h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-delars-modal-action="close">
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
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_delar_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_update_delar_header"
                                    data-kt-scroll-wrappers="#kt_modal_update_delar_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label
                                            class="required fw-semibold fs-6 mb-2">اسم التاجر</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name" value="{{ $currency_delar->name }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="اسم التاجر"
                                            required />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group select delar-->

                                    {{-- <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">
                                            حساب الشيكل </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="shekels_balance"
                                            value="{{ $currency_delar->shekels_balance }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="حساب الشيكل" />
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">
                                            حساب الدولار </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="dollars_balance"
                                            value="{{ $currency_delar->dollars_balance }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="حساب الدولار" />
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">
                                            حساب الدينار </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="dinars_balance"
                                            value="{{ $currency_delar->dinars_balance }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="حساب الدينار" />
                                        <!--end::Input-->
                                    </div> --}}

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">
                                            رقم الهاتف </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="phone" value="{{ $currency_delar->phone }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="رقم الهاتف" />
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">
                                            ملاحظات </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="notes" value="{{ $currency_delar->notes }}"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ملاحظات" />
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
                                    data-kt-delars-modal-action="cancel">{{ translate('employeeTranslation.cancel') }}
                                </button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary" data-kt-delars-modal-action="submit">
                                    <span class="indicator-label">{{ translate('employeeTranslation.Update') }}</span>
                                    <span class="indicator-progress">الانتظار
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

    @if (App::getLocale() == 'ar')
        <script src="{{ asset('assets/js/custom/apps/currency_delars/view/update-delar.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/currency_delars/view/update-delar-en.js') }}"></script>
    @endif

    <!--end::Custom Javascript-->
@endpush
