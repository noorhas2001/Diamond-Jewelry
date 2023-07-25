<script>
    "use strict";

    let calendar;
    let validator;
    let data = {
        id: '',
        user_id: '',
        resource_id: '',
        eventName: '',
        startDate: '',
        endDate: '',
        orStartDate: '',
        orEndDate: '',
    };
    let modalTitle;
    let editForm;
    let addForm;
    let editModalTitle;
    let addModal;
    let editModal;
    let eventId;
    let eventResourceId
    let eventName;
    let edit_user_input;
    let edit_resource_input;
    let edit_pricing_option_input;
    let edit_startDate_input;
    let add_startDate_input;
    let submitButton;
    let diffDays;
    let difHours;
    let result;


    const locale = document.getElementById('locale');

    const element = document.getElementById('kt_modal_edit_reservation');
    editForm = element.querySelector('#kt_modal_edit_reservation_form');
    const viewElement = document.getElementById('kt_modal_view_event');
    const viewEventId = viewElement.querySelector('[data-kt-calendar="event_id"]');
    const viewEventName = viewElement.querySelector('[data-kt-calendar="event_name"]');
    const viewStartDate = viewElement.querySelector('[data-kt-calendar="event_start_date"]');
    const viewEndDate = viewElement.querySelector('[data-kt-calendar="event_end_date"]');
    const viewEditButton = viewElement.querySelector('#kt_modal_view_event_edit');
    const viewDeleteButton = viewElement.querySelector('#kt_modal_view_event_delete');
    const viewDeleteForm = document.querySelector('#kt_modal_delete_event_form');
    editModalTitle = element.querySelector('[data-kt-calendar="title"]');
    const closeButton = element.querySelector('[data-kt-reservation-modal-action="close"]');
    editModal = new bootstrap.Modal(element);

    const elementAdd = document.getElementById('kt_modal_add_reservation');
    addModal = new bootstrap.Modal(elementAdd);
    addForm = elementAdd.querySelector('#kt_modal_add_reservation_form');


    let startDateMod;
    let endDateMod
    let viewModal = new bootstrap.Modal(viewElement);


    const KTAppCalendar = function() {
        // Calendar variables
        let calendar;


        // Define variables
        const calendarEl = document.getElementById('kt_calendar_app');
        // Initialize the calendar with the events data
        const initCalendar = function() {
            var events = @json($events);
            const fullCalendarEvents = [];
            for (let i = 0; i < events.length; i++) {
                fullCalendarEvents.push({
                    id: events[i].id,
                    title: events[i].name,
                    user_id: events[i].user_id,
                    resource_id: events[i].resource_id,
                    start: events[i].start_date,
                    end: events[i].end_date,
                    color: events[i].color,
                });
            }

            calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: fullCalendarEvents, // Assign fetched events data
                locale: locale.value,
                editable: true,
                selectable: true,
                selectHelper: true,
                eventClick: function(arg) {
                    startDateMod = moment(arg.event.start).format('Do MMM, YYYY, h:mm A');
                    endDateMod = moment(arg.event.end).format('Do MMM, YYYY, h:mm A');

                    data.id = arg.event.id;
                    data.eventName = arg.event.title;
                    data.user_id = arg.event.extendedProps.user_id;
                    data.resource_id = arg.event.extendedProps.resource_id;
                    data.startDate = startDateMod;
                    data.endDate = endDateMod;
                    data.orStartDate = arg.event.start;
                    data.orEndDate = arg.event.end;

                    viewEventId.innerText = arg.event.id;
                    viewEventName.innerText = arg.event.title;
                    viewStartDate.innerText = startDateMod;
                    viewEndDate.innerText = endDateMod;

                    viewModal.show();
                },
                select: function(arg) {
                    const selectedDate = moment(arg.start).format('YYYY-MM-DD');
                    const currentDate = moment().format('YYYY-MM-DD');

                    if (moment(selectedDate).isSameOrAfter(currentDate)) {
                        add_startDate_input.value = arg.startStr;
                        addModal.show();
                    }
                },
            });
            calendar.render();
        };

        validator = FormValidation.formValidation(
            editForm, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'الاسم مطلوب'
                            }
                        }
                    },
                    'start_date': {
                        validators: {
                            notEmpty: {
                                message: 'تاريخ بدء الحجز مطلوب'
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
        viewDeleteButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "هل أنت متأكد أنك تريد حذف هذا الحجز ؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "نعم , قم بحذفه!",
                cancelButtonText: "لا , ارجع للخلف",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                if (result.value) {
                    // viewDeleteForm.action = "reservations/destroyFromCalendar/"+data.id;
                    // Remove current row
                    let Url = "reservations/destroyFromCalendar/" + data.id;
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: Url,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        data: {
                            '_method': 'delete'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                calendar.getEventById(data.id).remove();
                            } else if (response.status === 'warning') {
                                Swal.fire({
                                    text: response.message,
                                    icon: "warning",
                                    buttonsStyling: false,
                                    confirmButtonText: "حسنا، اذهب",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            } else if (response.status === 'error') {
                                toastr.error(response.message);
                            }
                            console.log(response.message)
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                    // viewDeleteForm.submit();
                    viewModal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your event was not deleted!.",
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

        // Handle edit button
        const handleEditButton = () => {
            viewEditButton.addEventListener('click', e => {
                e.preventDefault();
                viewModal.hide();
                handleEditEvent();
            });
        }

        const handleEditEvent = () => {
            // Update modal title
            editModalTitle.innerText = "تعديل الحجز";

            editModal.show();
            eventId.value = data.id ? data.id : '';
            eventName.value = data.eventName ? data.eventName : '';
            eventResourceId.value = data.resource_id ? data.resource_id : '';


            diffDays = parseInt((data.orEndDate - data.orStartDate) / (1000 * 60 * 60 * 24), 10);
            difHours = Math.round((data.orEndDate - data.orStartDate) / (1000 * 60 * 60));

            let date = new Date(data.orStartDate);
            let year = date.getFullYear();
            let month = date.getMonth() + 1;
            let day = date.getDate();
            let hours = date.getHours();
            let minutes = date.getMinutes();

            let formatDate = year + "-" + month + "-" + day + " " + hours + ":" + minutes;

            edit_startDate_input.value = formatDate ? formatDate : '';

            // Handle submit form
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status === 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable submit button whilst loading
                            submitButton.disabled = true;

                            // Simulate form submission
                            setTimeout(function() {
                                // Simulate form submission
                                submitButton.removeAttribute('data-kt-indicator');

                                // Show popup confirmation
                                Swal.fire({
                                    text: "تم تعديل الحجز بنجاح",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        editModal.hide();

                                        // Enable submit button after loading
                                        submitButton.disabled = false;

                                        // Remove old event
                                        calendar.getEventById(data.id).remove();

                                        // Add new event to calendar
                                        calendar.addEvent({
                                            id: eventId.value,
                                            title: eventName.value,
                                            user_id: data.user_id,
                                            resource_id: data
                                                .resource_id,
                                            start: edit_startDate_input
                                                .value,
                                            end: edit_startDate_input
                                                .value,
                                        });
                                        calendar.render();
                                        // Reset form for demo purposes only
                                        editForm.reset();
                                    }
                                });
                                editForm.action = "reservations/" + data.id;

                                editForm.submit(); // Submit form
                            }, 2000);
                        } else {
                            // Show popup warning
                            Swal.fire({
                                text: "للأسف يوجد بعض الأخطاء ، حاول مرة أخرى ",
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
        }


        // Handle close button
        const handleCloseButton = () => {
            // Edit event modal close button
            closeButton.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    text: "هل أنت متأكد من أنك تريد الإغلاق ؟ ",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم , اريد الاغلاق !",
                    cancelButtonText: "لا , ارجع للخلف ",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        editForm.reset(); // Reset form
                        editModal.hide(); // Hide modal
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "لم يتم إلفاء النموذج الخاص بك!",
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


        const initAddResource = () => {

            // Cancel button handler
            const cancelButton = elementAdd.querySelector('[data-kt-reservation-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "هل أنت متأكد أنك تريد الإلغاء؟",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، قم بإلغائها!",
                    cancelButtonText: "لا، ارجع",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        addForm.reset(); // Reset form
                        addModal.hide();
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
            const closeButton = elementAdd.querySelector('[data-kt-reservation-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();
                Swal.fire({
                    text: "هل أنت متأكد أنك تريد الإلغاء؟",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، قم بإلغائها!",
                    cancelButtonText: "لا، ارجع",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(result) {
                    if (result.value) {
                        addForm.reset(); // Reset form
                        addModal.hide();
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
        };

        return {
            // Public Functions
            init: function() {
                eventId = editForm.querySelector('[name="id"]');
                eventResourceId = editForm.querySelector('[name="resource_id"]');
                eventName = editForm.querySelector('[name="name"]');
                edit_pricing_option_input = editForm.querySelector('[name="pricing_option"]');
                edit_startDate_input = editForm.querySelector('[name="start_date"]');
                add_startDate_input = addForm.querySelector('[name="start_date"]');
                submitButton = editForm.querySelector('#kt_modal_edit_reservation_submit');


                initCalendar();
                handleEditButton();
                handleCloseButton();
                initAddResource();

            }
        };

    }();


    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTAppCalendar.init();
    });
</script>
