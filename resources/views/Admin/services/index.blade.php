@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Edit'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Edit') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Delete'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Delete') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">الخدمات</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-success btn-sm mb-4" data-bs-effect="effect-scale"
                    data-bs-toggle="modal" href="#addService">اضافة خدمة</a>
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم الخدمة انجليزي</th>
                                <th>اسم الخدمة عربي</th>
                                <th>الأيقونة</th>
                                <th>القسم</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($services as $key => $service)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $service->service_en }}</td>
                                <td>{{ $service->service_ar }}</td>
                                <td class="fs-3"><i class="fa {{ $service->service_icon }}"></i></td>
                                <td>{{ $service->category->title_ar }} - {{ $service->category->title_en }}</td>
                                <td>
                                    <a href="#editService{{ $service->id }}" class="btn btn-warning btn-sm" data-bs-effect="effect-scale"
                                        data-id="{{ $service->id }}" data-service_en="{{ $service->service_en }}" data-service_ar="{{ $service->service_ar }}"
                                        data-bs-toggle="modal"><i class="fa fa-edit"></i></a>

                                    <a href="#deleteService{{ $service->id }}" class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-id="{{ $service->id }}" data-service_en="{{ $service->service_en }}" data-service_ar="{{ $service->service_ar }}"
                                        data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                                    </td>

{{-- Edit Service --}}
<div class="modal fade" id="editService{{ $service->id }}" tabindex="-1" aria-labelledby="editserviceerviceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">تعديل خدمة</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('services.update', $service->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label>اسم الخدمة عربي</label>
                        <input type="text" class="form-control text-end" id="service_ar" name="service_ar" value="{{ $service->service_ar }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>اسم الخدمة انجليزي</label>
                        <input type="text" class="form-control" id="service_en" name="service_en" value="{{ $service->service_en }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>الأيقونة</label>
                        <select id="selectIcon" name="service_icon" class="form-control">
                            <option value="{{ $service->service_icon }}">{{ $service->service_icon }}</option>
                            <option value='fa-camera'>&#xf030;<i class="fa-thin fa-camera"></i></option>
                            <option value='fa-mobile'>&#xe1ee;<i class="fa-thin fa-mobile"></i></option>
                            <option value='fa-pen-nib'>&#xf5ad;<i class="fa-thin fa-pen-nib"></i></option>
                            <option value='fa-photo-film'>&#xf87c;<i class="fa-thin fa-photo-film"></i></option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>القسم</label>
                        <select class="form-control">
                            @if ($service->category->id == $service->id)
                                <option>{{ $service->category->title_ar }} - {{ $service->category->title_en }}</option>
                            @else
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title_ar }} - {{ $category->title_en }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">تعديل</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end-modal -->


{{-- Delete Service --}}
<div class="modal fade" id="deleteService{{ $service->id }}" tabindex="-1" aria-labelledby="deleteServiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">حذف قسم</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('services.destroy', $service->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>هل انت متاكد من عملية الحذف ؟</h5><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control text-center bg-danger" name="service_ar" value="{{ $service->service_ar }} - {{ $service->service_en }}"  readonly>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-danger">حذف</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end-modal -->

</td>
    </tr>
@empty
    <tr>
        <th class="text-danger text-center fw-bold" colspan="6">
            لا يوجد بيانات
        </th>
    </tr>
@endforelse
</tbody>
</table>
</div><!-- end table-responsive -->

{{-- Add Service --}}
<div class="modal fade" id="addService" tabindex="-1" aria-labelledby="addServiceLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h5 class="modal-title">اضافة خدمة</h5>
        </div>

            <div class="modal-body">
                <form action="{{ route('services.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label>اسم الخدمة انجليزي</label>
                    <input type="text" class="form-control" id="service_en" name="service_en">
                </div>

                <div class="form-group mb-3">
                    <label>اسم الخدمة عربي</label>
                    <input type="text" class="form-control text-end" id="service_ar" name="service_ar">
                </div>

                    <div class="form-group mb-3">
                        <label>الأيقونة</label>
                        <select id="selectIcon" name="service_icon" class="form-control">
                            <option value="">اختر الأيقونة</option>
                            <option value='fa-camera'>&#xf030;<i class="fa-thin fa-camera"></i></option>
                            <option value='fa-mobile'>&#xe1ee;<i class="fa-thin fa-mobile"></i></option>
                            <option value='fa-pen-nib'>&#xf5ad;<i class="fa-thin fa-pen-nib"></i></option>
                            <option value='fa-photo-film'>&#xf87c;<i class="fa-thin fa-photo-film"></i></option>
                        </select>
                    </div>

                <div class="form-group mb-3">
                    <label>القسم</label>
                    <select name="category_id" class="form-control">
                        <option value="">اختر القسم</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title_ar }} - {{ $category->title_en }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">اضافة</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- end-modal -->

                </div>
            </div>
        </div>
    </div>
</div><!-- end row -->
</div> <!-- container-fluid -->

@endsection
