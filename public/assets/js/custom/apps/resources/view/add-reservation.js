"use strict";

$("#kt_modal_add_schedule_datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});

// Class definition
const KTResourcesAddSchedule = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_schedule');
    const form = element.querySelector('#kt_modal_add_schedule_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    const initAddSchedule = () => {

        // Init flatpickr -- for more info: https://flatpickr.js.org/

        // Init tagify -- for more info: https://yaireo.github.io/tagify/
        const tagifyInput = form.querySelector('#kt_modal_add_schedule_tagify');
        new Tagify(tagifyInput, {
            whitelist: ["sean@dellito.com", "brian@exchange.com", "mikaela@pexcom.com", "f.mitcham@kpmg.com.au", "olivia@corpmail.com", "owen.neil@gmail.com", "dam@consilting.com", "emma@intenso.com", "ana.cf@limtel.com", "robert@benko.com", "lucy.m@fentech.com", "ethan@loop.com.au"],
            maxTags: 10,
            dropdown: {
                maxItems: 20,           // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
            }
        });

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
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
                    'user_id': {
                        validators: {
                            notEmpty: {
                                message: 'اسم المستخدم مطلوب'
                            }
                        }
                    },
                    'pricing_option': {
                        validators: {
                            notEmpty: {
                                message: 'حدد خيار الحجز'
                            }
                        }
                    },
                    'start_date': {
                        validators: {
                            notEmpty: {
                                message: 'تاريخ بدء الحجز مطلوب'
                            },
                            callback: {
                                message: 'يجب ان يكون تاريخ البدء بعد الان ',
                                callback: function (input) {
                                    const startDate = new Date(input.value);
                                    const now = new Date();
                                    return startDate > now;
                                }
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

        // Revalidate country field. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="event_invitees"]')).on('change', function () {
            // Revalidate the field when an option is chosen
            validator.revalidateField('event_invitees');
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-resources-modal-action="close"]');
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
        const cancelButton = element.querySelector('[data-kt-resources-modal-action="cancel"]');
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

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-resources-modal-action="submit"]');
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
        const cancelButtons = document.querySelectorAll('[data-kt-reservation-table-filter="cancel-reservation"]');
        cancelButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = e.target.closest('tr');
                const reservationName = parent.querySelectorAll('td')[1].innerText;
                const Url = e.target.href;
                const StatusTd = parent.querySelector('[data-status="status"]');
                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد إلغاء الحجز "+ reservationName,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، ألغي الحجز!",
                    cancelButtonText: "لا ، ارجع للخلف",
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
                });
            })
        })
    }

    return {
        // Public functions
        init: function () {
            initAddSchedule();
            handleCancelReservation();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTResourcesAddSchedule.init();
});

