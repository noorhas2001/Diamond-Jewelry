var KTstaffsList = function () {
    let table = document.getElementById('kt_table_staffs');
    let datatable;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;


    let initstaffsTable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 3 }, // Disable ordering on column 6 (actions)
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
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    let handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-staff-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Add staff
    let handleAddstaff = () => {
        // Shared variables
        const element = document.getElementById('kt_modal_add_staff');
        const form = element.querySelector('#kt_modal_add_staff_form');
        const modal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        const validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'email is required'
                            }
                        }
                    },
                    'phone': {
                        validators: {
                            notEmpty: {
                                message: 'phone is required'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'password is required'
                            }
                        }
                    },
                    'password_confirmation': {
                        validators: {
                            notEmpty: {
                                message: 'password confirmation is required'
                            }
                        }
                    },
                    'role': {
                        validators: {
                            notEmpty: {
                                message: 'role is required'
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
        const submitButton = element.querySelector('[data-kt-staffs-modal-action="submit"]');
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
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
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
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-staffs-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
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
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-staffs-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
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
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    let handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-staffs-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-staffs-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            let filterString = '';

            // Get filter values
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    }


    //Delete subscirption
    let handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-staffs-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                let canDeletedElement = parent.querySelector('[data-canDeleted="canDeleted"]')
                // Get reservation name
                const StaffName = parent.querySelectorAll('td')[1].innerText;

                // Select all delete form
                const deletForm = parent.querySelector('[data-kt-staffs-table-filter="delete_form"]');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete" + StaffName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        if (canDeletedElement.value == false) {
                            Swal.fire({
                                text: "You Can't Delete The  staff",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "ok , go it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        } else {
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

                        }

                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: StaffName + "Was Not Deleted .",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok , Go it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    let handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-staffs-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-staffs-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

    // Init toggle toolbar
    let initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-staff-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-staff-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-staff-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-staff-table-select="delete_selected"]');

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
                text: "Are you sure you want to delete selected staffs?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    let selectedData = [];
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let rows = [];
                    let canDeletedElementsArray = [];
                    checkboxes.forEach(c => {
                        let canDeletedElement = c.closest('tr').querySelector('[data-canDeleted="canDeleted"]');
                        if (c.checked && canDeletedElement !== null) {
                            canDeletedElementsArray.push(canDeletedElement.value);
                        }
                        if (c.checked && canDeletedElement !== null && canDeletedElement.value !== "") {
                            let row = datatable.row($(c.closest('tbody tr')));
                            rows.push(row);
                        }
                    });
                    if (canDeletedElementsArray.includes("")) {
                        Swal.fire({
                            text: "You Can't Delete The Pending staffs  ",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok , Go It !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    } else {
                        checkboxes.forEach(c => {
                            let canDeletedElement = c.closest('tr').querySelector('[data-canDeleted="canDeleted"]');
                            if (c.checked && canDeletedElement !== null && canDeletedElement.value !== "") {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                                selectedData.push(c.value);
                            }
                        });
                        let filterSelectedData = selectedData.filter(element => element !== '');
                        let data = {
                            selectedData: filterSelectedData
                        };
                        $.ajax({
                            url: 'staffs/deleteSelected',
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
                            text: "You have deleted all selected staffs!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            toggleToolbars(); // Detect checked checkboxes
                            initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                        });
                    }
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Selected staffs was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
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


    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initstaffsTable();
            handleSearchDatatable();
            handleAddstaff();
            handleFilterDatatable();
            handleResetForm();
            initToggleToolbar();
            handleDeleteRows();


        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTstaffsList.init();
});
