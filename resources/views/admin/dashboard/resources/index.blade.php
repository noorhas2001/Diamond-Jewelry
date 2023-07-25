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
                        {{translate('resourceTranslation.ResourceList')}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('dashboard')}}"
                               class="text-muted text-hover-primary">{{translate('resourceTranslation.Dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('resources.index')}}"
                               class="text-muted text-hover-primary">{{translate('resourceTranslation.Resources')}}</a>
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
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                          height="2" rx="1"
                                          transform="rotate(45 17.0365 15.1223)"
                                          fill="currentColor"/>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                    <input
                                       type="text" data-kt-resource-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-14"
                                       placeholder="{{translate('resourceTranslation.SearchResource')}}"
                                    />

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-resource-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
														</svg>
													</span>
                                    <!--end::Svg Icon-->{{translate('reservationTranslation.Filter')}}</button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{translate('reservationTranslation.FilterOptions')}}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-resources-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{translate('resourceTranslation.Category')}}</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                                <option></option>
                                                @foreach($categories as $name => $id)
                                                    <option value="{{$name}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-resources-table-filter="reset">{{translate('reservationTranslation.Reset')}}</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-resources-table-filter="filter">{{translate('reservationTranslation.Apply')}}</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                @can(CREATE_RESOURCE_PERMISSION)
                                <!--begin::Add Resource-->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_resource">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16"
                                              height="2" rx="1"
                                              transform="rotate(-90 11.364 20.364)"
                                              fill="currentColor"/>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                              fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->{{translate('resourceTranslation.AddResource')}}
                                </button>
                                <!--end::Add Resource-->
                                @endcan
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-resource-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-resource-table-select="selected_count"></span>{{translate('resourceTranslation.Selected')}}
                                </div>
                                <button type="button" class="btn btn-danger"
                                        data-kt-resource-table-select="delete_selected">{{translate('resourceTranslation.DeleteSelected')}}
                                </button>
                            </div>
                            <!--end::Group actions-->

                            <!--begin::Modal - Add resource-->
                            <div class="modal fade" id="kt_modal_add_resource" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_resource_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">{{translate('resourceTranslation.AddResource')}}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                 data-kt-resources-modal-action="close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137"
                                                          width="16" height="2" rx="1"
                                                          transform="rotate(-45 6 17.3137)"
                                                          fill="currentColor"/>
                                                    <rect x="7.41422" y="6" width="16"
                                                          height="2" rx="1"
                                                          transform="rotate(45 7.41422 6)"
                                                          fill="currentColor"/>
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
                                            <form id="kt_modal_add_resource_form" class="form"
                                                  action="{{route('resources.store')}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                     id="kt_modal_add_resource_scroll" data-kt-scroll="true"
                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                     data-kt-scroll-max-height="auto"
                                                     data-kt-scroll-dependencies="#kt_modal_add_resource_header"
                                                     data-kt-scroll-wrappers="#kt_modal_add_resource_scroll"
                                                     data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="d-block fw-semibold fs-6 mb-5">{{translate('resourceTranslation.Image')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Image placeholder-->
                                                        <style>.image-input-placeholder {
                                                                background-image: {{asset('assets/img/avatar.jpeg')}};
                                                            }

                                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                                background-image: {{asset('assets/img/avatar.jpeg')}};
                                                            }</style>
                                                        <!--end::Image placeholder-->
                                                        <!--begin::Image input-->
                                                        <div
                                                            class="image-input image-input-outline image-input-placeholder"
                                                            data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-125px h-125px"
                                                                 style="background-image: {{asset('assets/img/avatar.jpeg')}};"></div>
                                                            <!--end::Preview existing avatar-->
                                                            <!--begin::Label-->
                                                            <label
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="change"
                                                                data-bs-toggle="tooltip"
                                                                title="{{translate('resourceTranslation.ImageChange')}}">
                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file" name="avatar"
                                                                       accept=".png, .jpg, .jpeg"/>
                                                                <input type="hidden" name="avatar_remove"/>
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Cancel-->
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="cancel"
                                                                data-bs-toggle="tooltip"
                                                                title="{{translate('resourceTranslation.ImageRemove')}}">
<i class="bi bi-x fs-2"></i>
</span>
                                                            <!--end::Cancel-->
                                                            <!--begin::Remove-->
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="remove"
                                                                data-bs-toggle="tooltip"
                                                                title="{{translate('resourceTranslation.ImageRemove')}}">
<i class="bi bi-x fs-2"></i>
</span>
                                                            <!--end::Remove-->
                                                        </div>
                                                        <!--end::Image input-->
                                                        <!--begin::Hint-->
                                                        <div class="form-text">{{translate('resourceTranslation.AllowedFile')}}
                                                        </div>
                                                        <!--end::Hint-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.ResourceName')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="name"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.ResourceName')}}" required/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group select category-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.Category')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <!--begin::Col-->
                                                        <div class="col-6">
                                                            <select name="category_id"
                                                                    class="form-select form-select-solid"
                                                                    data-control="select2"
                                                                    data-hide-search="true"
                                                                    data-placeholder="{{translate('resourceTranslation.Category')}}" required>
                                                                @foreach ($categories as $name => $id)
                                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group select category-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="fw-semibold fs-6 mb-2">{{translate('resourceTranslation.Description')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="description"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.Description')}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">{{translate('resourceTranslation.NumberSeats')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="number_seats"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               value="1"
                                                               min="1"
                                                               required
                                                        />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="fw-semibold fs-6 mb-2">{{translate('resourceTranslation.HourPrice')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="price_by_hour"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                               min="1"
                                                        />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" fw-semibold fs-6 mb-2">{{translate('resourceTranslation.DayPrice')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="price_by_day"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                               min="1"
                                                        />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" fw-semibold fs-6 mb-2">{{translate('resourceTranslation.WeekPrice')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="price_by_weak"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                               min="1"
                                                        />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" fw-semibold fs-6 mb-2">{{translate('resourceTranslation.MonthPrice')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="price_by_month"
                                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                                               placeholder="{{translate('resourceTranslation.CreditCard')}}"
                                                               min="1"
                                                        />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                            data-kt-resources-modal-action="cancel">{{translate('resourceTranslation.Cancel')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            data-kt-resources-modal-action="submit">
                                                        <span class="indicator-label">{{translate('resourceTranslation.Add')}}</span>
                                                        <span class="indicator-progress">{{translate('resourceTranslation.Waiting')}}
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                            <!--end::Modal - Add resource-->

                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="table-responsive">
                        <!--begin::Table-->
                            <table class="table align-middle fs-6 gy-5" id="kt_table_resources">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                   data-kt-check-target="#kt_table_resources .form-check-input"
                                                   value="1"/>
                                        </div>
                                    </th>
                                    <th class="min-w-125px">{{translate('resourceTranslation.Resource')}}</th>
                                    <th class="min-w-125px">{{translate('resourceTranslation.Price')}}</th>
                                    <th class="min-w-125px">{{translate('resourceTranslation.NumberSeats')}}</th>
                                    <th class="min-w-125px">{{translate('resourceTranslation.num_reservation')}}</th>
                                    <th class="min-w-125px">{{translate('resourceTranslation.num_reservation_times')}}</th>
                                    <th class="text-end min-w-100px px-10">{{translate('resourceTranslation.Procedures')}}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($resources as $resource)
                                <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="{{$resource->id}}"/>
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::Resource=-->
                                        <td class="d-flex align-items-center" style="margin-top: 25px">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a @can(READ_RESOURCE_PERMISSION) href="{{route('resources.show' , $resource->id)}}" @endcan>
                                                    <div class="symbol-label">
                                                        <img
                                                            src="{{asset($resource->imageUrl() ?? 'assets/img/avatar.jpeg')}}"
                                                            alt="Emma Smith"
                                                            class="w-100"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Resource details-->
                                            <div class="d-flex flex-column">
                                                <a @can(READ_RESOURCE_PERMISSION) href="{{route('resources.show' , $resource->id)}} @endcan"
                                                   class="text-gray-800 text-hover-primary mb-1">{{$resource->name}}</a>
                                                <span>{{$resource->category->name}}</span>
                                            </div>
                                            <!--begin::Resource details-->
                                        </td>
                                        <!--end::Resource=-->
                                        <!--begin::Role=-->
                                        <td>
                                            <h6 style="display: inline-block">{{translate('resourceTranslation.Hour')}} : </h6> <span>{{$resource->price_by_hour}}</span><br>
                                            <h6 style="display: inline-block">{{translate('resourceTranslation.Day')}}  : </h6> <span>{{$resource->price_by_day}}</span><br>
                                            <h6 style="display: inline-block">{{translate('resourceTranslation.Week')}} : </h6> <span>{{$resource->price_by_weak}}</span><br>
                                            <h6 style="display: inline-block">{{translate('resourceTranslation.Month')}}  : </h6> <span>{{$resource->price_by_month}}</span><br>
                                        </td>
                                        <!--end::Role=-->
                                        <!--begin::Joined-->
                                        <td>{{$resource->number_seats}}</td>
                                        <!--begin::Joined-->
                                        <!--begin::Reservations-->
                                        <td class="px-12">
                                            <a @can(READ_RESOURCE_PERMISSION) href="{{route('resources.show' , $resource->id)}}" @endcan>
                                                {{count($resource->reservations)}}
                                            </a>
                                        </td>
                                        <!--begin::Reservations-->
                                        <!--begin::Reservations Times-->
                                        <td>{{count($resource->reservationTimes)}}</td>
                                        <!--begin::Reservations Times-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{translate('resourceTranslation.Procedures')}}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="currentColor"/>
                                                </svg>
                                                </span>
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div
                                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                    @can(READ_RESOURCE_PERMISSION)
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{route('resources.show', $resource->id)}}"
                                                           class="menu-link px-3">{{translate('resourceTranslation.Show')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    @endcan
                                                    @can(DELETE_RESOURCE_PERMISSION)
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <form action="{{route('resources.destroy', $resource->id)}}" method="post"
                                                              data-kt-resources-table-filter="delete_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input hidden="hidden" data-canDeleted="canDeleted" value="{{$resource->canDeleted()}}">
                                                            <a href="#"
                                                               class="menu-link px-3"
                                                               data-kt-resources-table-filter="delete_row">{{translate('resourceTranslation.Delete')}}</a>
                                                        </form>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    @endcan
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

                <!--begin::Modal - Add schedule-->
                <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">اضافة حجز</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                     data-kt-users-modal-action="close">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                      height="2" rx="1"
                                                                      transform="rotate(-45 6 17.3137)"
                                                                      fill="currentColor"/>
																<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                      transform="rotate(45 7.41422 6)"
                                                                      fill="currentColor"/>
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
                                <form id="kt_modal_add_schedule_form" class="form"
                                      action="{{route('reservations.store')}}" method="POST">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold form-label mb-2">اسم الحجز</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" name="name"
                                        />
                                        {{-- <input type="hidden" class="d-none form-control form-control-solid" name="resource_id" value="{{$resources->name}}"/> --}}
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <div class="fv-row mb-7">
                                        <label for="pricing_option">الحجز عن طريق :</label>
                                        <select class="form-select form-select-sm form-select-solid"
                                                name="pricing_option" id="pricing_option" onclick="showInputField()">
                                            {{-- @if($resources->price_by_hour != 0) --}}
                                            <option value="price_by_hour">الحجز عن طريق الساعات</option>
                                            {{-- @endif --}}
                                            {{-- @if($resources->price_by_day != 0) --}}
                                            <option value="price_by_day">الحجز عن طريق الايام</option>
                                            {{-- @endif --}}
                                            {{-- @if($resources->price_by_weak != 0) --}}
                                            <option value="price_by_weak">الحجز عن طريق الاسابيع</option>
                                            {{-- @endif --}}
                                            {{-- @if($resources->price_by_month != 0) --}}
                                            <option value="price_by_month">الحجز عن طريق الاشهر</option>
                                            {{-- @endif --}}
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <input
                                            placeholder="ادخل عدد الساعات"
                                            class="form-control form-control-solid"
                                            type="text" name="price_by_hour_input" id="price_by_hour_input"
                                            style="display:none;">


                                        <input
                                            placeholder="ادخل عدد الايام"
                                            class="form-control form-control-solid"
                                            type="text" name="price_by_day_input" id="price_by_day_input"
                                            style="display:none;">


                                        <input
                                            placeholder="ادخل عدد الاسابيع"
                                            class="form-control form-control-solid"
                                            type="text" name="price_by_weak_input" id="price_by_weak_input"
                                            style="display:none;">


                                        <input
                                            placeholder="ادخل عدد الاشهر"
                                            class="form-control form-control-solid"
                                            type="text" name="price_by_month_input" id="price_by_month_input"
                                            style="display:none;">

                                    </div>


                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">تاريخ بداية الحجز</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Select a date & time."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="ادخل تاريخ بدء الحجز" name="start_date"
                                               id="kt_modal_add_schedule_datepicker"/>
                                        <!--end::Input-->
                                    </div>

                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-resources-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-resources-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
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
                <!--end::Modal - Add schedule-->

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
@push('scripts')

@if(Cookie::get(APP_LOCALE) == 'ar')
    <script src="{{asset('assets/js/custom/apps/resources/list/table.js')}}"></script>
@else
    <script src="{{asset('assets/js/custom/apps/resources/list/table-en.js')}}"></script>
@endif
    <script>
        function showInputField() {
            var select = document.getElementById("pricing_option");
            var selectedOption = select.options[select.selectedIndex].value;

            // Hide all input fields first
            document.getElementById("price_by_hour_input").style.display = "none";
            document.getElementById("price_by_day_input").style.display = "none";
            document.getElementById("price_by_weak_input").style.display = "none";
            document.getElementById("price_by_month_input").style.display = "none";

            // Show the input field that matches the selected option
            if (selectedOption == "price_by_hour") {
                document.getElementById("price_by_hour_input").style.display = "block";
            } else if (selectedOption == "price_by_day") {
                document.getElementById("price_by_day_input").style.display = "block";
            } else if (selectedOption == "price_by_weak") {
                document.getElementById("price_by_weak_input").style.display = "block";
            } else if (selectedOption == "price_by_month") {
                document.getElementById("price_by_month_input").style.display = "block";
            }
        }
    </script>
@endpush
