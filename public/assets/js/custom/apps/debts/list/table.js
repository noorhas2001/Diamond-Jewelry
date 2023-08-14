"use strict";

$("#kt_modal_add_debts_datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});

var KTdebtsList = function () {
    let table = document.getElementById('kt_table_debts');
    let datatable;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;

    toastr.options = {
        "positionClass": "toastr-bottom-left",
    };


    let initdebtsTable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)
            ],
            fixedColumns: {
                left: 1,

            }
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            handleVerfiedDebt();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    let handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-debts-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    let handleAdddebt = () => {
        // Shared variables
        const element = document.getElementById('kt_modal_add_debt');
        const form = element.querySelector('#kt_modal_add_debt_form');
        const modal = new bootstrap.Modal(element);


        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        const validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'person_name': {
                        validators: {
                            notEmpty: {
                                message: 'الاسم مطلوب'
                            }
                        }
                    },
                    'phone_number': {
                        validators: {
                            notEmpty: {
                                message: 'رقم الهاتف مطلوب'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-debts-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status === 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "تم تقديم النموذج بنجاح!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "حسنًا ، اذهب!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    modal.hide();
                                }
                            });

                            form.submit(); // Submit form
                        }, 2000);
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "حسنًا ، اذهب!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-debts-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "هل أنت متأكد أنك تريد الإلغاء؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "نعم ، قم بإلغائها!",
                cancelButtonText: "لا، ارجع",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "لم يتم إلغاء النموذج الخاص بك !.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا ، اذهب!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-debts-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "هل أنت متأكد أنك تريد الإلغاء؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "نعم ، قم بإلغائها!",
                cancelButtonText: "لا، ارجع",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "لم يتم إلغاء النموذج الخاص بك !.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا ، اذهب!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }
    // Delete debts
    let handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-debts-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                // Select parent row
                const parent = e.target.closest('tr');
                const debtName = parent.querySelectorAll('td')[1].innerText;
                // Select all delete form
                const deletForm = parent.querySelector('[data-kt-debts-table-filter="delete_form"]');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد حذف  " + debtName + "؟",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، احذف!",
                    cancelButtonText: "لا ، ارجع",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Remove current row
                        let Url = deletForm.action;
                        let method = deletForm.method;
                        let csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: Url,
                            type: method,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            data: {
                                '_method': 'delete'
                            },
                            success: function (response) {
                                if (response.status == 'success') {
                                    toastr.success(response.message);
                                    datatable.row($(parent)).remove().draw();
                                } else if (response.status == 'warning') {
                                    toastr.warning(response.message);
                                } else if (response.status == 'error') {
                                    toastr.error(response.message);
                                }
                                console.log(response.message)
                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        }).then(function () {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: debtName + " لم يتم حذفه .",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "حسنا ، اذهب!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init toggle toolbar
    let initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-debt-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-debt-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-debt-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-debt-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "هل أنت متأكد من أنك تريد حذف الديون المختارة",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "نعم ، احذف!",
                cancelButtonText: "لا ، ارجع للخلف",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    let selectedData = [];
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    checkboxes.forEach(c => {
                        if (c.checked) {
                            datatable.row($(c.closest('tbody tr'))).remove().draw();
                            selectedData.push(c.value);
                        }
                    });
                    let filterSelectedData = selectedData.filter(element => element !== '');
                    let data = {
                        selectedData: filterSelectedData
                    };
                    $.ajax({
                        url: 'deleteSelected',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function (response) {
                            console.log(response.message);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                    // Remove header checked box
                    const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                    headerCheckbox.checked = false;

                    Swal.fire({
                        text: "لقد حذفت جميع الديون المختارة!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "حسنا، اذهب",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        toggleToolbars(); // Detect checked checkboxes
                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                    });

                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "الديون المختارة لم يتم حذفها",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنا ، اذهب!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    const handleVerfiedDebt = () => {
        const payButtons = document.querySelectorAll('[data-kt-Subscription-table-filter="verfiedSubscriptionPaynment_row"]');
        payButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                // Select parent row
                const parent = e.target.closest('tr');


                let paynmentStatusTd = parent.querySelector('[data-status="paidStatus"]');
                // Get subscription name
                const subscriptionName = parent.querySelectorAll('td')[1].innerText;

                // Select all delete form
                const verfiedForm = parent.querySelector('[data-kt-subscription-table-filter="verifiedSubscriptionPayment_form"]');

                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد الدفع  " + subscriptionName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، ادفع المبلغ!",
                    cancelButtonText: "لا ، ارجع",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        if (paynmentStatusTd.innerText === 'مدفوع') {
                            Swal.fire({
                                text: "لا يمكن دفع الديون المدفوعة",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "حسنا، اذهب",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        } else {
                            let Url = verfiedForm.action;
                            let method = verfiedForm.method;
                            let csrfToken = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                url: Url,
                                type: method,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                success: function (response) {
                                    if (response.status == 'success') {
                                        toastr.success(response.message);
                                        let paynmentStatusSpan = paynmentStatusTd.getElementsByTagName('span')[0]
                                        paynmentStatusSpan.innerText = 'مدفوع'
                                        paynmentStatusSpan.classList.add('badge-light-success');
                                        paynmentStatusSpan.classList.remove('badge-light-danger');
                                    } else if (response.status == 'warning') {
                                        toastr.warning(response.message);
                                    } else if (response.status == 'error') {
                                        toastr.error(response.message);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.log(error);
                                }
                            })
                        }
                    }
                })
            })
        })

    }


    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initdebtsTable();
            handleSearchDatatable();
            initToggleToolbar();
            handleDeleteRows();
            handleAdddebt();
            handleVerfiedDebt();

        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTdebtsList.init();
});
