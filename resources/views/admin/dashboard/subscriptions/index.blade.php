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
                        {{translate('subscriptionTranslation.SubscriptionsList')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{translate('subscriptionTranslation.Dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('subscriptions.index') }}"
                               class="text-muted text-hover-primary">{{translate('subscriptionTranslation.Subscriptions')}}</a>
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
                                              rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                        <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                    <input type="text" data-kt-subscription-table-filter="search"
                                           class="form-control form-control-solid w-250px ps-14"
                                           placeholder="{{translate('subscriptionTranslation.Search')}}"
                                           />
                            </div>
                            <!--end::Search-->
                        </div>


                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
														</svg>
													</span>
                                    <!--end::Svg Icon-->{{translate('subscriptionTranslation.Filter')}}</button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bold">{{translate('subscriptionTranslation.FilterOptions')}}</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Separator-->
                                        <!--begin::Content-->
                                        <div class="px-7 py-5" data-kt-subscription-table-filter="form">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-semibold">{{translate('subscriptionTranslation.CourseName')}}</label>
                                                <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                                    <option></option>
                                                    @foreach($courses as $name => $id)
                                                    <option value="{{$name}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="reset">{{translate('subscriptionTranslation.Reset')}}</button>
                                                <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter">{{translate('subscriptionTranslation.Apply')}}</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Menu 1-->
                                <!--end::Filter-->
                                @can(CREATE_SUBSCRIPTION_PERMISSION)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_subscription">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                        <!--end::Svg Icon-->{{translate('courseTranslation.AddSubscription')}}
                                    </button>
                                @endcan
                            </div>


                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>{{translate('subscriptionTranslation.Selected')}}</div>
                                <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">{{translate('subscriptionTranslation.DeleteSelected')}}</button>
                            </div>
                            <!--end::Group actions-->

                            {{-- begin:Modal - Add Subscription --}}

                            <div class="modal fade" id="kt_modal_add_subscription" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">{{translate('courseTranslation.AddNewSubscription')}}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-kt-subscriptions-modal-action="close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                            fill="currentColor" />
                                                        <rect x="7.41422" y="6" width="16" height="2"
                                                            rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>

                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                            <!--begin::Form-->
                                            <form id="kt_modal_add_subscription_form" class="form"
                                                action="{{ route('subscriptions.store') }}" method="POST">
                                                @csrf

                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.Course')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <select name="course_id" class="form-select form-select-solid"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="{{translate('courseTranslation.Course')}}" required>
                                                            @foreach ($courses as $name => $id)
                                                                    <option value="{{ $id }}">{{ $name }}
                                                                    </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Input-->
                                                </div>

                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.User')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <select name="user_id" class="form-select form-select-solid"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="{{translate('courseTranslation.User')}}" required>
                                                            @foreach ($users as $user)
                                                                @if ($user->email_verified_at != null)
                                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Input-->
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">{{translate('courseTranslation.Price')}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" name="price"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="{{translate('courseTranslation.Price')}}" min="1"
                                                        />
                                                </div>
                                                <!--end::Input group-->





                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-subscriptions-modal-action="cancel">{{translate('courseTranslation.Cancel')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-kt-subscriptions-modal-action="submit">
                                                        <span class="indicator-label">{{translate('courseTranslation.Add')}}</span>
                                                        <span class="indicator-progress">{{translate('courseTranslation.Waiting')}}
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            {{-- end:Modal - Add Subscription --}}

                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->

                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_subscriptions">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                   data-kt-check-target="#kt_table_subscriptions .form-check-input"
                                                   value=""/>
                                        </div>
                                    </th>
                                    <th class="min-w-125px">{{translate('subscriptionTranslation.CourseName')}}</th>
                                    <th class="min-w-125px">{{translate('subscriptionTranslation.User')}}</th>
                                    <th class="min-w-125px">{{translate('subscriptionTranslation.Price')}}</th>
                                    <th class="min-w-125px px-10">{{translate('subscriptionTranslation.Status')}}</th>
                                    <th class="min-w-50px px-10">{{translate('subscriptionTranslation.PaynmentStatus')}}</th>
                                    <th class="text-end min-w-100px px-10">
                                        {{translate('subscriptionTranslation.Procedures')}}
                                    </th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                @foreach ($subscriptions as $subscription)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="{{$subscription->id}}"/>
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::Resource=-->
                                        <!--end::Resource=-->
                                        <!--begin::Role=-->

                                        <!--end::Role=-->
                                        <!--begin::Joined-->

                                        <td>{{ $subscription->course->name }}</td>
                                        <td>{{ $subscription->user->name }}</td>
                                        <td>{{ $subscription->price }}</td>
                                        <td data-status="status">
                                            <span id="subscriptionStatusSpan"
                                                @if ($subscription->isPending())
                                                    class="badge badge-light-success fw-bold px-4 py-3"
                                                @elseif ($subscription->isFinished() || $subscription->isCanceled())
                                                    class="badge badge-light-danger fw-bold px-4 py-3"
                                                @endif
                                            >{{ $subscription->status() }}</span>
                                        </td>


                                        <!--begin::Joined-->
                                        <td data-status="paynmentStatus">
                                            @if ($subscription->is_verified_payment == 1)
                                                <span id="subscriptionPaynmentStatusSpan"
                                                      class="badge badge-light-success fw-bold px-4 py-3"
                                                >{{translate('subscriptionTranslation.Paid')}}
                                                    </span>
                                            @elseif ($subscription->is_verified_payment == 0)
                                                <span id="subscriptionPaynmentStatusSpan"
                                                      class="badge badge-light-danger fw-bold px-4 py-3"
                                                >{{translate('subscriptionTranslation.NotPaid')}}
                                                    </span>
                                            @endif
                                        </td>
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                               data-kt-menu-trigger="click"
                                               data-kt-menu-placement="bottom-end">{{translate('subscriptionTranslation.Procedures')}}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                 data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                @can(READ_SUBSCRIPTION_PERMISSION)
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('subscriptions.show', $subscription->id) }}"
                                                       class="menu-link px-3">{{translate('subscriptionTranslation.Show')}}</a>
                                                </div>
                                                @endcan
                                                <!--end::Menu item-->
                                                <!--begin::Menu paid-->
                                                @can(VERIFY_PAYMENT_SUBSCRIPTION_PERMISSION)
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('subscriptions.verifiedSubscriptionPayment', $subscription->id) }}"
                                                          method="post" data-kt-subscription-table-filter="verifiedSubscriptionPayment_form">
                                                        @csrf
                                                        <a class="menu-link px-3"
                                                           data-kt-Subscription-table-filter="verfiedSubscriptionPaynment_row">
                                                            {{translate('subscriptionTranslation.Pay')}}</a>
                                                    </form>
                                                </div>
                                                @endcan
                                                <!--end::Menu paid-->
                                                <!--begin::Menu item-->
                                                @can(DELETE_SUBSCRIPTION_PERMISSION)
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                          method="post" data-kt-subscription-table-filter="delete_form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href=""
                                                           class="menu-link px-3"
                                                           data-kt-subscription-table-filter="delete_row">{{translate('subscriptionTranslation.Delete')}}</a>
                                                    </form>
                                                </div>
                                                @endcan
                                                @can(CANCEL_SUBSCRIPTION_PERMISSION)
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('subscriptions.cancel', $subscription->id) }}"
                                                        class="menu-link px-3" data-kt-subscription-table-filter="cancel-subscription">{{translate('subscriptionTranslation.Cancel')}}</a>
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

    @if(Cookie::get(APP_LOCALE) == 'ar')
        <script src="{{ asset('assets/js/custom/apps/subscriptions/list/table.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/subscriptions/list/table-en.js') }}"></script>
    @endif
@endpush
