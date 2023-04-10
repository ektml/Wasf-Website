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
            <h4 class="mb-0">معلومات عن موقعنا</h4>
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
                    data-bs-toggle="modal" href="#addInfo">اضافة معلومات</a>
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>المعلومات</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($infos as $key => $info)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $info->paragraph }}</td>
                                <td>
                                    <a href="#editInfo{{ $info->id }}" class="btn btn-warning btn-sm" data-bs-effect="effect-scale"
                                        data-bs-toggle="modal"><i class="fa fa-edit"></i></a>

                                    <a href="#deleteInfo{{ $info->id }}" class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                                    </td>

{{-- Edit Info --}}
<div class="modal fade" id="editInfo{{ $info->id }}" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">تعديل معلومات الموقع</h5>
            </div>

            <div class="modal-body">
                <form action="{{route('about_us.update', $info->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                <div class="form-group mb-3">
                    <label>المعلومات</label>
                    <textarea name="paragraph" id="paragraph" class="form-control text-end" rows="10">{{ $info->paragraph }}</textarea>
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


{{-- Delete Info --}}
<div class="modal fade" id="deleteInfo{{ $info->id }}" tabindex="-1" aria-labelledby="deleteInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">حذف معلومات الموقع</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('about_us.destroy', $info->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>هل انت متاكد من عملية الحذف ؟</h5><br>
                        <input type="hidden" name="id" id="id" value="">
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

{{-- Add Info --}}
<div class="modal fade" id="addInfo" tabindex="-1" aria-labelledby="addInfoLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h5 class="modal-title">اضافة معلومة</h5>
        </div>

            <div class="modal-body">
                <form action="{{ route('about_us.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label>المعلومات</label>
                    <textarea name="paragraph" id="paragraph" class="form-control text-end" rows="10"></textarea>
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
</div><!-- end row -->
</div> <!-- container-fluid -->
</div>
@endsection
