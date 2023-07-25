"use strict";

$("#kt_modal_add_course_datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});


// Class definition
var KTCoursesList = function () {


    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()

    // Add Resource
    let handleAddCourse = () => {
        const element = document.getElementById('kt_modal_add_course');
        const form = element.querySelector('#kt_modal_add_course_form');
        const modal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
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
                'hours': {
                  validators: {
                    notEmpty: {
                      message: 'عدد الساعات مطلوب'
                    }
                  }
                },
                'resource_id': {
                  validators: {
                    notEmpty: {
                      message: 'المورد مطلوب'
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
                'lecture_hours': {
                  validators: {
                    notEmpty: {
                      message: 'ساعات المحاضرة مطلوبة'
                    }
                  }
                },
                // ToDo : make validator ( At least one day need to be checked )

                // 'course_days[]': {
                //   validators: {
                //     callback: {
                //       message: 'Please select at least one day.',
                //       callback: function() {
                //         const checkboxes = document.querySelectorAll('input[name="course_days[]"]');
                //         let isChecked = false;

                //         checkboxes.forEach((checkbox) => {
                //           if (checkbox.checked) {
                //             isChecked = true;
                //           }
                //         });

                //         return isChecked;
                //       }
                //     }
                //   }
                // }
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
        const submitButton = element.querySelector('[data-kt-courses-modal-action="submit"]');
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
        const cancelButton = element.querySelector('[data-kt-courses-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-courses-modal-action="close"]');
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

    // Filter Datatable

    // Reset Filter


    // Delete subscirption

    // Init toggle toolbar


    // Toggle toolbars


    return {
        // Public functions
        init: function () {
            handleAddCourse();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTCoursesList.init();
});
