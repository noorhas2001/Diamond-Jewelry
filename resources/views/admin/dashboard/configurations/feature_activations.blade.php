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
                        قائمة الاعدادات</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}"
                               class="text-muted text-hover-primary">{{translate('subscriptionTranslation.Dashboard')}}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('features.index') }}"
                               class="text-muted text-hover-primary">الاعدادات</a>
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
                                <form action="{{ route('features.index') }} " method="GET">
                                    <input type="text" data-kt-resource-table-filter="search"


                                           class="form-control form-control-solid w-250px ps-14"
                                           placeholder="بحث عن اعدادات"
                                           name="keyword"/>
                                </form>
                            </div>
                            <!--end::Search-->
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_resources">
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
                                    <th class="min-w-125px">الاسم</th>
                                    <th class="min-w-125px">الحالة</th>
                                    <th class="text-end min-w-100px px-10">
                                        الاجراءات
                                    </th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                @foreach($featureFlags as $featureFlag)

                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1"/>
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <td>{{ $featureFlag->name }}</td>
                                        <td data-kt-features-table-filter="enabled_column">{{ $featureFlag->enabled ? 'Yes' : 'No' }}</td>

                                        <td class="text-end min-w-100px px-10">
                                            @can('update', $featureFlag)
                                                <form action="{{ route('features.update') }}" method="POST" style="display: inline-block;" data-kt-features-table-filter="active_form">
                                                    @csrf
                                                    <input type="hidden" date-id="id" value="{{ $featureFlag->id }}">
                                                    <div class="form-check form-check-solid form-switch form-check-custom">
                                                        <input class="form-check-input w-40px h-20px" type="checkbox" data-kt-features-table-filter="active_row" id="featureToggle" name="featureToggle" {{ $featureFlag->enabled ? 'checked' : '' }} >
                                                    </div>
                                                </form>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            {{ $featureFlags->links() }}
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
    <script>
        $(document).ready(function() {
            const activeButtons = document.querySelectorAll('[data-kt-features-table-filter="active_row"]');
            activeButtons.forEach(d => {
                d.addEventListener('change', function (e) {
                    const parent = e.target.closest('tr');
                    const activeForm =  parent.querySelector('[data-kt-features-table-filter="active_form"]');
                    let Url = activeForm.action;
                    let method = activeForm.method;
                    let featureId = activeForm.querySelector('[date-id="id"]').value;
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let enabledColumn = parent.querySelector('[data-kt-features-table-filter="enabled_column"]');
                    $.ajax({
                        url: Url,
                        type: method,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        data: {
                            '_method':'put',
                            id:featureId
                        },
                        success: function(response) {
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                if(response.enabled == 0 ){
                                    enabledColumn.innerText = 'No';
                                }else{
                                    enabledColumn.innerText = 'Yes';
                                }
                            }else if(response.status == 'warning'){
                                toastr.warning(response.message);
                            }else if(response.status == 'error'){
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error if needed
                        }
                    });
                })
            })

        });
    </script>
@endpush


