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
            <h4 class="mb-0">الأقسام</h4>
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
                    data-bs-toggle="modal" href="#addCategory">اضافة قسم</a>
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم القسم عربي</th>
                                <th>اسم القسم انجليزي</th>
                                <th>الأيقونة</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->title_ar }}</td>
                                <td>{{ $category->title_en }}</td>
                                <td class="fs-3"><i class="fa {{ $category->icon }}"></i></td>
                                <td>
                                    <a href="#editCategory{{ $category->id }}" class="btn btn-warning btn-sm" data-bs-effect="effect-scale"
                                        data-id="{{ $category->id }}" data-title_en="{{ $category->title_en }}" data-title_ar="{{ $category->title_ar }}"
                                        data-bs-toggle="modal"><i class="fa fa-edit"></i></a>

                                    <a href="#deleteCategory{{ $category->id }}" class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-id="{{ $category->id }}" data-title_en="{{ $category->title_en }}" data-title_ar="{{ $category->title_ar }}"
                                        data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                                    </td>

{{-- Edit Category --}}
<div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">تعديل قسم</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label>اسم القسم عربي</label>
                        <input type="text" class="form-control text-end" id="title_ar" name="title_ar" value="{{ $category->title_ar }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>اسم القسم انجليزي</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $category->title_en }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>الأيقونة</label>
                        <select id="selectIcon" name="icon" class="form-control">
                            <option value="{{ $category->icon }}">{{ $category->icon }}</option>
                            <option value='fa-camera'>&#xf030;<i class="fa-thin fa-camera"></i></option>
                            <option value='fa-mobile'>&#xe1ee;<i class="fa-thin fa-mobile"></i></option>
                            <option value='fa-pen-nib'>&#xf5ad;<i class="fa-thin fa-pen-nib"></i></option>
                            <option value='fa-photo-film'>&#xf87c;<i class="fa-thin fa-photo-film"></i></option>
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


{{-- Delete Category --}}
<div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">حذف قسم</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>هل انت متاكد من عملية الحذف ؟</h5><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control text-center text-white bg-danger" name="title_ar" value="{{ $category->title_ar }} - {{ $category->title_en }}"  readonly>
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
        <th class="text-danger fw-bold" colspan="7">
            لا يوجد بيانات
        </th>
    </tr>
@endforelse
</tbody>
</table>
</div><!-- end table-responsive -->


{{-- Add Category --}}
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h5 class="modal-title">اضافة قسم</h5>
        </div>

            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label>اسم القسم عربي</label>
                    <input type="text" class="form-control text-end" id="title_ar" name="title_ar">
                </div>

                <div class="form-group mb-3">
                    <label>اسم القسم انجليزي</label>
                    <input type="text" class="form-control" id="title_en" name="title_en">
                </div>

                <div class="form-group mb-3">
                    <label>الأيقونة</label>
                    <select id="selectIcon" name="icon" class="form-control">
                        <option value="">اختر الأيقونة</option>
                        <option value='fa-camera'>&#xf030;<i class="fa-thin fa-camera"></i></option>
                        <option value='fa-mobile'>&#xe1ee;<i class="fa-thin fa-mobile"></i></option>
                        <option value='fa-pen-nib'>&#xf5ad;<i class="fa-thin fa-pen-nib"></i></option>
                        <option value='fa-photo-film'>&#xf87c;<i class="fa-thin fa-photo-film"></i></option>
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
