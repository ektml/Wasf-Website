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
            <h4 class="mb-0">نسبة عمولة المالك</h4>
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
                    data-bs-toggle="modal" href="#addPercentage">اضافة نسبة عمولة جديدة</a>
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم المالك</th>
                                <th>العمولة</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($percentages as $key => $percentage)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $percentage->name }}</td>
                                <td>{{ $percentage->type }}{{ $percentage->percentage }}</td>
                                <td>
                                    <a href="#editPercentage{{ $percentage->id }}" class="btn btn-warning btn-sm" data-bs-effect="effect-scale"
                                        data-bs-toggle="modal"><i class="fa fa-edit"></i></a>

                                    <a href="#deletePercentage{{ $percentage->id }}" class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                                    </td>

{{-- Edit Percentage --}}
<div class="modal fade" id="editPercentage{{ $percentage->id }}" tabindex="-1" aria-labelledby="editPercentageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">تعديل النسبة</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('ownerPercentage.update', $percentage->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label>رقم النسبة</label>
                        <input type="text" class="form-control text-end" id="percentage" name="percentage" value="{{ $percentage->percentage }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>نوع النسبة</label>
                        <select id="type" name="type" class="form-control">
                            <option value="">اختر نوع النسبة</option>
                            <option value="%">%</option>
                            <option value="$">$</option>
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


{{-- Delete Percentage --}}
<div class="modal fade" id="deletePercentage{{ $percentage->id }}" tabindex="-1" aria-labelledby="deletePercentageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">حذف قسم</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('ownerPercentage.destroy', $percentage->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>هل انت متاكد من عملية الحذف ؟</h5><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control text-center text-white bg-danger" name="percentage" value="{{ $percentage->percentage }}{{ $percentage->type }}"  readonly>
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


{{-- Add Percentage --}}
<div class="modal fade" id="addPercentage" tabindex="-1" aria-labelledby="addPercentageLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h5 class="modal-title">اضافة نسبة</h5>
        </div>

            <div class="modal-body">
                <form action="{{ route('ownerPercentage.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label>رقم النسبة</label>
                    <input type="text" class="form-control" id="percentage" name="percentage">
                </div>

                <div class="form-group mb-3">
                    <label>نوع النسبة</label>
                    <select id="type" name="type" class="form-control">
                        <option value="">اختر نوع النسبة</option>
                        <option value="%">%</option>
                        <option value="$">$</option>
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
