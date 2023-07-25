"use strict";

$("#kt_modal_add_schedule_datepicker_two").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});

// Class definition
const KTResourcesUpdateDetails = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_update_details');
    const form = element.querySelector('#kt_modal_update_reservation_form');
    const modal = new bootstrap.Modal(element);

    let table = document.getElementById('kt_table_reservations');
    let datatable;

    let initReservationTable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 4,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 4 }, // Disable ordering on column 6 (actions)
            ],
            fixedColumns: {
                left: 1,

            }
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            handleDeleteRows();
            handleCancelReservation();

        });
    }
    // Init add schedule modal
    const initUpdateDetails = () => {

        // Close button handler
        const closeButton = element.querySelector('[data-kt-reservations-modal-action="close"]');
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
                    modal.hide(); // Hide modal
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

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-reservations-modal-action="cancel"]');
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
                    modal.hide(); // Hide modal
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

        const validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'الاسم مطلوب'
                            }
                        }
                    },
                    'category_id': {
                        validators: {
                            notEmpty: {
                                message: 'التصنيف مطلوب'
                            }
                        }
                    },
                    'number_seats': {
                        validators: {
                            notEmpty: {
                                message: 'عدد المقاعد مطلوب'
                            }
                        }
                    },
                    'price': {
                        validators: {
                            notEmpty: {
                                message: 'السعر مطلوب'
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
        const submitButton = element.querySelector('[data-kt-reservations-modal-action="submit"]');
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
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
                })
            }

        });
    };


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
                    text: "هل انت متاكد انك تريد الغاء وقت الحجز " + reservationName,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، ألغي وقت الحجز!",
                    cancelButtonText: "لا ، ارجع للخلف",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: Url,
                            type: 'GET',
                            success: function (response) {
                                if (response.status == 'success') {
                                    toastr.success(response.message);
                                    let StatusSpan = StatusTd.getElementsByTagName('span')[0]
                                    StatusSpan.innerText = 'Canceled'
                                    StatusSpan.classList.add('badge-light-danger');
                                    StatusSpan.classList.remove('badge-light-success');
                                    console.log(StatusSpan);
                                } else if (response.status == 'warning') {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "حسنا، اذهب",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                } else if (response.status == 'error') {
                                    toastr.error(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        })
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: " وقت الحجز " + reservationName + " لم يتم الغاؤه",
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
        })
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
                const deletForm = parent.querySelector('[data-kt-reservation-table-filter="delete_form"]');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد حذف  وقت الحجز" + reservationName + "?",
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
                        if (statusElement.innerText === 'Pending') {
                            Swal.fire({
                                text: "لا يمكن حذف الحجوزات الفعالة",
                                icon: "warning",
                                buttonsStyling: false,
                                confirmButtonText: "حسنا، اذهب",
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
                            })

                        }

                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: reservationName + " لم يتم حذفها .",
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

    return {
        // Public functions
        init: function () {
            initUpdateDetails();
            handleDeleteRows();
            initReservationTable();
            handleCancelReservation();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTResourcesUpdateDetails.init();
});
