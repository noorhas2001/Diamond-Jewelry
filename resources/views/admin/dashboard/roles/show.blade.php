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
                        {{ translate('staffTranslation.ListofStaffsroles') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.Dashboard') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('roles.index') }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.roles') }}</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('roles.show', $role->id) }}"
                                class="text-muted text-hover-primary">{{ translate('staffTranslation.View') }}</a>
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
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                        <!--begin::Card-->
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="mb-0">{{ $role->name }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Permissions-->
                                @foreach ($role->permissions as $permission)
                                    <div class="d-flex flex-column text-gray-600">
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>{{ $permission->name }}
                                        </div>
                                    </div>
                                @endforeach

                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0">
                                @can(UPDATE_ROLE_PERMISSION)
                                <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update_role">{{ translate('staffTranslation.EditRole') }}</button>
                                @endcan
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                        <!--begin::Modal-->
                        <!--begin::Modal - Update role-->
                        <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">{{ translate('staffTranslation.UpdateRole') }}</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-roles-modal-action="close">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                        height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                        fill="currentColor" />
                                                    <rect x="7.41422" y="6" width="16" height="2"
                                                        rx="1" transform="rotate(45 7.41422 6)"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="modal-body scroll-y mx-5 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_update_role_form" class="form"
                                            action="{{ route('roles.update', $role->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                id="kt_modal_update_role_scroll" data-kt-scroll="true"
                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                data-kt-scroll-max-height="auto"
                                                data-kt-scroll-dependencies="#kt_modal_update_role_header"
                                                data-kt-scroll-wrappers="#kt_modal_update_role_scroll"
                                                data-kt-scroll-offset="300px">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                        <span
                                                            class="required">{{ translate('staffTranslation.Rolename') }}</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid"
                                                        placeholder="Enter a role name" name="name"
                                                        value="{{ $role->name }}" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Permissions-->
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="fs-5 fw-bold form-label mb-2">{{ translate('staffTranslation.RolePermissions') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Table wrapper-->
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                            <!--begin::Table body-->
                                                            <tbody class="text-gray-600 fw-semibold">
                                                                <!--begin::Table row-->
                                                                <tr>
                                                                    <td class="text-gray-800">
                                                                        {{ translate('staffTranslation.AdministratorAccess') }}
                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Allows a full access to the system"></i>
                                                                    </td>
                                                                    <td>
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                            class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="kt_roles_select_all" />
                                                                            <span class="form-check-label"
                                                                                for="kt_roles_select_all">{{ translate('staffTranslation.SelectAll') }}</span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </td>
                                                                </tr>
                                                                <!--end::Table row-->
                                                                <!--begin::Table row-->
                                                                @foreach ($permissions as $name => $id)
                                                                    <!--begin::Table row-->
                                                                    <tr>
                                                                        <!--begin::Label-->
                                                                        <td class="text-gray-800">{{ $name }}</td>
                                                                        <!--end::Label-->
                                                                        <!--begin::Options-->
                                                                        <td>
                                                                            <!--begin::Wrapper-->
                                                                            <div class="d-flex">
                                                                                <!--begin::Checkbox-->
                                                                                <label
                                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                    <input class="form-check-input name"
                                                                                           @if($role->hasPermissionTo($name)) checked @endif
                                                                                        type="checkbox"
                                                                                        name="permission[]"
                                                                                        value="{{ $id }}" />
                                                                                </label>
                                                                                <!--end::Checkbox-->

                                                                            </div>
                                                                            <!--end::Wrapper-->
                                                                        </td>
                                                                        <!--end::Options-->
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                @endforeach
                                                                <!--end::Table row-->
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table wrapper-->
                                                </div>
                                                <!--end::Permissions-->
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-kt-roles-modal-action="cancel">{{ translate('staffTranslation.Discard') }}</button>
                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-roles-modal-action="submit">
                                                    <span
                                                        class="indicator-label">{{ translate('staffTranslation.Submit') }}</span>
                                                    <span
                                                        class="indicator-progress">{{ translate('staffTranslation.PleaseWait') }}
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
                        <!--end::Modal - Update role-->
                        <!--end::Modal-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-10">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header pt-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="d-flex align-items-center">
                                        {{ translate('staffTranslation.UsersAssigned') }}
                                        <span class="text-gray-600 fs-6 ms-1">({{ $role->users->count() }})</span>
                                    </h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->

                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0"
                                    id="kt_roles_view_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_roles_view_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-50px">{{ translate('staffTranslation.ID') }}</th>
                                            <th class="min-w-150px">{{ translate('staffTranslation.USER') }}</th>
                                            <th class="min-w-125px">{{ translate('staffTranslation.JoinedDate') }}</th>
                                            <th class="text-end min-w-100px">{{ translate('staffTranslation.Actions') }}
                                            </th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-600">

                                        @foreach ($role->users as $user)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td>
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::ID-->
                                                <td>{{ $user->id }}</td>
                                                <!--begin::ID-->
                                                <!--begin::User=-->
                                                <td class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->

                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    @can(READ_STAFF_PERMISSION)
                                                    <div class="d-flex flex-column">
                                                        <a href="{{route('staffs.show' , $user->id)}}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                        <span>{{ $user->email }}</span>
                                                    </div>
                                                    @endcan
                                                    <!--begin::User details-->
                                                </td>
                                                <!--end::user=-->
                                                <!--begin::Joined date=-->
                                                <td>{{ $user->created_at }}</td>
                                                <!--end::Joined date=-->
                                                <!--begin::Action=-->
                                                <td class="text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light btn-active-light-primary"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">{{ translate('staffTranslation.Actions') }}
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        @can(READ_STAFF_PERMISSION)
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('staffs.show', $user->id) }}"
                                                                class="menu-link px-3">{{ translate('staffTranslation.View') }}</a>
                                                        </div>
                                                        @endcan
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                                <!--end::Action=-->
                                            </tr>










                                            <!--begin::Checkbox-->

                                            <!--end::Checkbox-->
                                            <!--begin::ID-->

                                            <!--end::Joined date=-->
                                            <!--begin::Action=-->
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
@push('scripts')

    @if (App::getLocale() == 'ar')
        <script src="{{ asset('assets/js/custom/apps/roles/view/update-role.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/custom/apps/roles/view/update-role.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/roles/view/view.js') }}"></script>
    @endif

@endpush
