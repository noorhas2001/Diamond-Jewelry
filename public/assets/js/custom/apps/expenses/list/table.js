
var KTexpensesList = function () {
    let table = document.getElementById('kt_table_expenses');
    let datatable;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;

    toastr.options = {
        "positionClass": "toastr-bottom-left",
    };


    let initexpensesTable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 5 }, // Disable ordering on column 6 (actions)
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
        const filterSearch = document.querySelector('[data-kt-expenses-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }
    // Delete expenses
    let handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-expenses-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                // Select parent row
                const parent = e.target.closest('tr');
                // Select all delete form
                const deletForm = parent.querySelector('[data-kt-expenses-table-filter="delete_form"]');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد حذف  السحب",
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
                            text:  " لم يتم حذف السحب .",
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
        toolbarBase = document.querySelector('[data-kt-expense-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-expense-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-expense-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-expense-table-select="delete_selected"]');

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
                text: "هل أنت متأكد من أنك تريد حذف المصروفات المختارة",
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
                        text: "لقد حذفت جميع المصروفات المختارة!.",
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
                        text: "المصروفات المختارة لم يتم حذفهم",
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


    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initexpensesTable();
            handleSearchDatatable();
            initToggleToolbar();
            handleDeleteRows();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTexpensesList.init();
});
