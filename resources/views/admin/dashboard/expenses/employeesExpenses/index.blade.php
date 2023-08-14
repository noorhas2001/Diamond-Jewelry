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
                        {{ translate('expenseTranslation.list_expenses') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                {{ translate('expenseTranslation.dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('expenses.index') }}"
                                class="text-muted text-hover-primary">{{ translate('expenseTranslation.expenses') }}</a>
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

                                <input type="text" data-kt-expenses-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14"
                                    placeholder=" {{ translate('expenseTranslation.search_expense') }} " />

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-expense-table-toolbar="base">
                                <!--begin::Add Category-->
                                {{-- @can(CREATE_EXPENSE_PERMISSION)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_expense">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                    rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--> {{ translate('expenseTranslation.add_new_expense') }}
                                    </button>
                                @endcan --}}
                                <!--end::Add Category-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-expense-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2"
                                        data-kt-expense-table-select="selected_count"></span>{{ translate('expenseTranslation.selected') }}
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-expense-table-select="delete_selected">{{ translate('expenseTranslation.delete_selected') }}
                                </button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_expenses">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_expenses .form-check-input"
                                                    value="" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px"> {{ translate('expenseTranslation.employee') }}</th>
                                        <th class="min-w-125px">{{ translate('expenseTranslation.description') }}</th>
                                        <th class="min-w-125px"> {{ translate('expenseTranslation.amount') }}</th>
                                        <th class="min-w-125px"> {{ translate('expenseTranslation.currency') }}</th>
                                        <th class="min-w-125px"> {{ translate('expenseTranslation.draw_date') }}</th>
                                        <th class="text-end min-w-100px px-10">
                                            {{ translate('expenseTranslation.procedures') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($expenses as $expense)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $expense->id }}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Category=-->
                                            <td>
                                                <!--begin:: Avatar -->

                                                <!--end::Avatar-->
                                                <!--begin::Category details-->
                                                <div class="d-flex flex-column">
                                                    <a @can(READ_EXPENSE_PERMISSION) href="{{ route('expenses.show', $expense->id) }}" @endcan
                                                        class="text-gray-800 text-hover-primary mb-1">{{ $expense?->employee?->name }}</a>
                                                </div>
                                                <!--begin::Category details-->
                                            </td>

                                            <td>{{ $expense->description }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->currency->name }}</td>
                                            <td>{{ $expense->draw_date }}</td>

                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">{{ translate('expenseTranslation.procedures') }}
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
                                                    @can(READ_EXPENSE_PERMISSION)
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('expenses.show', $expense->id) }}"
                                                                class="menu-link px-3">{{ translate('expenseTranslation.view') }}</a>
                                                        </div>
                                                    @endcan
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @can(DELETE_EXPENSE_PERMISSION)
                                                        <div class="menu-item px-3">
                                                            <form action="{{ route('expenses.destroy', $expense->id) }}"
                                                                method="post" data-kt-expenses-table-filter="delete_form">
                                                            </form>
                                                            <a href="" class="menu-link px-3"
                                                                data-kt-expenses-table-filter="delete_row">{{ translate('expenseTranslation.delete') }}</a>
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
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@push('scripts')

    @if (App::getLocale() == 'ar')
        <script src="{{ asset('assets/js/custom/apps/expenses/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/expenses/list/table-en.js') }}"></script>
    @endif

@endpush
