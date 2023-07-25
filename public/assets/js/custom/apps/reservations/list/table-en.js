var KTReservationsList = function () {
    let table = document.getElementById('kt_table_reservation');
    let datatable;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;

    let initReservaionTable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 9 }, // Disable ordering on column 6 (actions)
            ],
            fixedColumns:   {
                left: 1,

            }
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            handleCancelReservation();
            handleVerfiedReservationPaynment();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    let handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-reservation-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    //Filter Datatable
    let handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-reservation-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-reservation-table-filter="filter"]');
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

    // Reset Filter
    let handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-reservation-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-reservation-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

    let handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-reservation-table-filter="delete_row"]');



        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                let statusElement = parent.querySelector('[data-status="status"]')
                // Get reservation name
                const reservationName = parent.querySelectorAll('td')[1].innerText;

                // Select all delete form
                const deletForm=  parent.querySelector('[data-kt-reservation-table-filter="delete_form"]');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + reservationName + "?",
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
                        if(statusElement.innerText === 'Pending'){
                            Swal.fire({
                                text:"You Can't Delete The Pending Reservations",
                                icon:"warning",
                                buttonsStyling: false,
                                confirmButtonText: "ok , go it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }else {
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
                                success: function(response) {
                                    if(response.status == 'success'){
                                        toastr.success(response.message);
                                        datatable.row($(parent)).remove().draw();
                                    }else if(response.status == 'warning'){
                                        toastr.warning(response.message);
                                    }else if(response.status == 'error'){
                                        toastr.error(response.message);
                                    }
                                    console.log(response.message)
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            }).then(function () {
                                // Detect checked checkboxes
                                toggleToolbars();
                            });
                        }

                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: reservationName + "Was Not Deleted .",
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

    // Init toggle toolbar
    let initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-reservation-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-reservation-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-reservation-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-reservation-table-select="delete_selected"]');

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
                text: "Are you sure you want to delete selected reservations?",
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
                    let stateElementsArray = [];
                    checkboxes.forEach(c => {
                        let statusElement = c.closest('tr').querySelector('[data-status="status"]');
                        if (c.checked && statusElement !== null) {
                            stateElementsArray.push(statusElement.innerText);
                        }
                        if (c.checked && statusElement !== null && statusElement.innerText !== 'Pending') {
                            let row = datatable.row($(c.closest('tbody tr')));
                            rows.push(row);
                        }
                    });
                    if(stateElementsArray.includes('Pending')){
                        Swal.fire({
                            text:"You Can't Delete The Pending Reservations",
                            icon:"warning",
                            buttonsStyling: false,
                            confirmButtonText: "Ok , Go It !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }else{
                        checkboxes.forEach(c => {
                            let statusElement = c.closest('tr').querySelector('[data-status="status"]');
                            if (c.checked && statusElement !== null && statusElement.innerText !== 'Pending') {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                                selectedData.push(c.value);
                            }
                        });
                        let filterSelectedData = selectedData.filter(element => element !== '');
                        let data = {
                            selectedData: filterSelectedData
                        };
                        $.ajax({
                            url: 'reservations/deleteSelected',
                            type: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                console.log(response.message);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                        // Remove header checked box
                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                        Swal.fire({
                            text: "You have deleted all selected reservations!.",
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
                        text: "Selected reservations was not deleted.",
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

    const handleCancelReservation = () => {
        const cancelButtons = table.querySelectorAll('[data-kt-reservation-table-filter="cancel-reservation"]');
        cancelButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = e.target.closest('tr');
                const reservationName = parent.querySelectorAll('td')[1].innerText;
                const Url = e.target.href;
                const StatusTd = parent.querySelector('[data-status="status"]');
                Swal.fire({
                    text: "Are You Sure , You Want Cancel The Reservation  "+ reservationName,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes , Cancel It!",
                    cancelButtonText: "No , Back",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result){
                    if (result.value) {
                        $.ajax({
                            url: Url,
                            type: 'GET',
                            success: function(response) {
                                if(response.status == 'success'){
                                    toastr.success(response.message);
                                    let StatusSpan = StatusTd.getElementsByTagName('span')[0]
                                    StatusSpan.innerText = 'Canceled'
                                    StatusSpan.classList.add('badge-light-danger');
                                    StatusSpan.classList.remove('badge-light-success');
                                    console.log(StatusSpan);
                                }else if(response.status == 'warning'){
                                    Swal.fire({
                                        text:response.message,
                                        icon:"warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK, Go",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });                                }else if(response.status == 'error'){
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                });
            })
        })
    }

    const handleVerfiedReservationPaynment = () => {
        const payButtons = table.querySelectorAll('[data-kt-reservation-table-filter="verfiedReservationPaynment_row"]');
        payButtons.forEach(d =>{
            d.addEventListener('click',function(e){
                e.preventDefault();
                // Select parent row
                const parent = e.target.closest('tr');

                let statusElement = parent.querySelector('[data-status="status"]');

                let paynmentStatusTd = parent.querySelector('[data-status="paynmentStatus"]');
                // Get reservation name
                const reservationName = parent.querySelectorAll('td')[1].innerText;

                // Select all delete form
                const verfiedForm =  parent.querySelector('[data-kt-reservation-table-filter="verfiedReservationPaynment_form"]');

                Swal.fire({
                    text: "Are You Sure You Want To Pay The Reservation " + reservationName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: " Yes, Pay The Amount",
                    cancelButtonText: "No , Back",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result){
                    if (result.value) {
                        if(paynmentStatusTd.innerText === 'Paid'){
                            Swal.fire({
                                text:"You Can't Pay The Paid Reservation Again",
                                icon:"error",
                                buttonsStyling: false,
                                confirmButtonText: "ok , Go It ",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        } else if (statusElement.innerText === 'Canceled' || statusElement.innerText === 'Finished'){
                            Swal.fire({
                                text:"You Can't Pay The Cancelled or Finished Reservations",
                                icon:"error",
                                buttonsStyling: false,
                                confirmButtonText: "ok , Go It ",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }else{
                            let Url = verfiedForm.action;
                            let method = verfiedForm.method;
                            let csrfToken = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                url: Url,
                                type: method,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                success: function(response) {
                                    if(response.status == 'success'){
                                        toastr.success(response.message);
                                        let paynmentStatusSpan = paynmentStatusTd.getElementsByTagName('span')[0]
                                        paynmentStatusSpan.innerText = 'Paid'
                                        paynmentStatusSpan.classList.add('badge-light-success');
                                        paynmentStatusSpan.classList.remove('badge-light-danger');
                                    }else if(response.status == 'warning'){
                                        toastr.warning(response.message);
                                    }else if(response.status == 'error'){
                                        toastr.error(response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
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

            initReservaionTable();
            handleSearchDatatable();
            handleFilterDatatable();
            handleResetForm();
            initToggleToolbar();
            handleDeleteRows();
            handleCancelReservation();
            handleVerfiedReservationPaynment();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTReservationsList.init();
});
