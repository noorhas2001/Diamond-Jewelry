@extends('layouts.admin.index')

@section('main')
    <!--begin::Header-->
    @include('layouts.admin.header.index')
    <!--end::Header-->
    <!--begin::Wrapper-->
    <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
        <!--begin::Aside-->
        @include('flash::message')

        @include('layouts.admin.aside')

        <style>
            .btn.btn-primary.masa.active {
                background-color: red !important; /* لون عند الضغط */
            }
        </style>


        <!--begin::Modal - Add expense-->
        <div class="modal fade" id="kt_modal_add_expense" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px mh-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_expense_header">
                        <!-- Modal title -->
                        <h2 class="fw-bold">{{ translate('expenseTranslation.add_expense') }}</h2>

                        <!-- Button for Employee Expense -->
                        <button class="btn btn-primary masa active"  data-action="employee">مصروفات </button>

                        <!-- Button for Masa Expense -->
                        <button class="btn btn-primary masa" data-action="masa">سحب الماسة</button>

                        <!-- Close button -->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-expenses-modal-action="close">
                            <!-- Close Icon -->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>

                    <!--end::Modal header-->
                    <!--begin::Modal body-->

                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <!-- Section 1: Employee Expense -->
                        <div id="employee_expense_section">
                            <!--begin::Form-->
                            <form id="kt_modal_add_expense_form" class="form" action="{{ route('expenses.store') }}"
                                method="POST" enctype="multipart/form-data">


                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_expense_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_expense_header"
                                    data-kt-scroll-wrappers="#kt_modal_add_expense_scroll" data-kt-scroll-offset="300px">

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label
                                            class="required fw-semibold fs-6 mb-2">{{ translate('expenseTranslation.employee') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <select name="employee_id" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="{{ translate('expenseTranslation.employee') }}" required>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">
                                                        {{ $employee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">
                                            الصنف </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="description" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="الصنف" required>
                                                    <option value="مشروبات">مشروبات</option>
                                                    <option value="وجبات طعام">وجبات طعام</option>
                                                    <option value="م.صيانة">م.صيانة</option>
                                                    <option value="صيانة ذهب">صيانة ذهب</option>
                                                    <option value="مشتريات">مشتريات</option>
                                                    <option value="انترنت">انترنت</option>
                                                    <option value="كهرباء">كهرباء</option>
                                                    <option value="مولد">مولد</option>
                                                    <option value="غير ذلك">غير ذلك</option>
                                            </select>
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">
                                            {{ translate('expenseTranslation.amount') }} </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="amount"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="{{ translate('expenseTranslation.amount') }}" />
                                        <!--end::Input-->
                                    </div>

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">
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
                                    <button type="submit" class="btn btn-primary" data-kt-expenses-modal-action="submit">
                                        <span class="indicator-label">{{ translate('expenseTranslation.add') }}</span>
                                        <span class="indicator-progress">{{ translate('expenseTranslation.waiting') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->

                        </div>

                        <!-- Section 2: Masa Expense -->
                        <div id="masa_expense_section" style="display: none;">
                            <!--begin::Form-->
                            <form id="kt_modal_add_expense_masa_form" class="form"
                                action="{{ route('expenses.store_from_masa') }}" method="POST"
                                enctype="multipart/form-data">


                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_expense_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_expense_header"
                                    data-kt-scroll-wrappers="#kt_modal_add_expense_scroll" data-kt-scroll-offset="300px">


                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">
                                            {{ translate('expenseTranslation.amount') }} </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="amount"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="{{ translate('expenseTranslation.amount') }}" />
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
                                            <select name="currency_id" class="form-select form-select-solid"
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
                                        <label class="fw-semibold fs-6 mb-2">
                                            ملاحظات </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="description"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="ملاحظات" />
                                        <!--end::Input-->
                                    </div>



                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="submit" class="btn btn-primary"
                                        data-kt-expenses-masa-modal-action="submit">
                                        <span class="indicator-label">{{ translate('expenseTranslation.add') }}</span>
                                        <span class="indicator-progress">{{ translate('expenseTranslation.waiting') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add expense-->


        <!--begin::Modal - Add expense-->
        <div class="modal fade" id="kt_modal_add_deposit" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px mh-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_deposit_header">
                        <!-- Modal title -->
                        <h2 class="fw-bold">اضافة ايداع جديد</h2>

                        <!-- Close button -->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-deposits-modal-action="cancel">
                            <!-- Close Icon -->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>

                    <!--end::Modal header-->
                    <!--begin::Modal body-->

                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <!-- Section 1: Employee Expense -->
                        <div id="employee_deposit_section">
                            <!--begin::Form-->
                            <form id="kt_modal_add_deposit_form" class="form" action="{{ route('deposits.store') }}"
                                method="POST" enctype="multipart/form-data">


                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_deposit_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_deposit_header"
                                    data-kt-scroll-wrappers="#kt_modal_add_deposit_scroll" data-kt-scroll-offset="300px">




                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">
                                            المبلغ </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="amount"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="المبلغ" />
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
                                            <select name="currency_id" class="form-select form-select-solid"
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
                                        <label class="fw-semibold fs-6 mb-2">
                                            ملاحظات </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="notes"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ملاحظات" />
                                        <!--end::Input-->
                                    </div>


                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="submit" class="btn btn-primary"
                                        data-kt-deposits-modal-action="submit">
                                        <span class="indicator-label">{{ translate('expenseTranslation.add') }}</span>
                                        <span class="indicator-progress">{{ translate('expenseTranslation.waiting') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->

                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add expense-->

        <!--start::Modal - Confirm Password-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">تاكيد كلمة السر</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="check_password" class="form" action="{{ route('check-password') }}" method="POST"
                            enctype="multipart/form-data">


                            @csrf
                            <div class="fv-row mb-7">
                                <!-- begin::Label -->
                                <label class="required fw-semibold fs-6 mb-2">كلمة السر</label>
                                <!-- end::Label -->
                                <!-- begin::Input -->
                                <input type="password" id="passwordInput" name="password"
                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="الرجاء تاكيد كلمة السر" />
                                <!-- end::Input -->
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                <button type="submit" id="confirmPasswordBtn" class="btn btn-primary">تأكيد</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!--end::Modal - Confirm Password-->


        <!--end::Aside-->
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content-->
            @yield('content')
            <!--end::Content-->
            <!--begin::Footer-->
            <div id="kt_app_footer" class="app-footer">
                <!--begin::Footer container-->
                <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2023&copy;</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Masa Jewelry</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="#" target="_blank"
                                class="menu-link px-2">{{ translate('footerTranslation.About') }}</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" target="_blank"
                                class="menu-link px-2">{{ translate('footerTranslation.Support') }}</a>
                        </li>
                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Footer container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Wrapper-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/resources-search.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    @if (App::getLocale() == 'ar')
        <script src="{{ asset('assets/js/custom/apps/general/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/general/list/table-en.js') }}"></script>
    @endif


    <script>
        // Wait for the DOM to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to elements
            const modalBody = document.querySelector(".modal-body");
            const employeeButton = document.querySelector("button[data-action='employee']");
            const masaButton = document.querySelector("button[data-action='masa']");
            const employeeSection = document.getElementById("employee_expense_section");
            const masaSection = document.getElementById("masa_expense_section");

            // Function to toggle section visibility
            function showSection(sectionToShow, sectionToHide) {
                sectionToShow.style.display = "block";
                sectionToHide.style.display = "none";
            }

            // Event listener for the employee button click
            employeeButton.addEventListener("click", function() {
                showSection(employeeSection, masaSection);
            });

            // Event listener for the masa button click
            masaButton.addEventListener("click", function() {
                showSection(masaSection, employeeSection);
            });
        });
    </script>

<script>
    document.querySelectorAll('.btn.btn-primary.masa').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.btn.btn-primary.masa').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
</script>

    @yield('script')
@endsection
