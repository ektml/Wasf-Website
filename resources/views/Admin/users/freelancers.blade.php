@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">مقدمي الخدمة</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> جميع مقدمي الخدمة</h4>
                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم مقدم الخدمة</th>
                                <th>الايميل</th>
                                <th>رقم الجوال</th>
                                <th>الرقم القومي</th>
                                <th>السجل الضريبي</th>
                                <th>الصورة الشخصية</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($freelancers as $key => $freelancer)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $freelancer->name }}</td>
                                <td>{{ $freelancer->email }}</td>
                                <td>{{ $freelancer->phone }}</td>
                                <td>{{ $freelancer->id_number }}</td>
                                <td>{{ $freelancer->business_register }}</td>
                                <td><img src="{{ asset('Admin3/assets/images/users/'.$freelancer->profile_image) }}" height="80"></td>
                                <td>
                                    <a href="#deleteFreelancer{{ $freelancer->id }}" class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-id="{{ $freelancer->id }}" data-name="{{ $freelancer->name }}"
                                        data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                                </td>

{{-- Delete Freelancer --}}
<div class="modal fade" id="deleteFreelancer{{ $freelancer->id }}" tabindex="-1" aria-labelledby="deleteFreelancerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
            <h5 class="modal-title">حذف مقدم خدمة</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('freelancers.destroy', $freelancer->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>هل انت متاكد من عملية الحذف ؟</h5><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control text-center text-white bg-danger" name="name" value="{{ $freelancer->name }}"  readonly>
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
                                <th class="text-danger text-center fw-bold" colspan="8">
                                    لا يوجد بيانات
                                </th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div><!-- end table-responsive -->
            </div>
        </div>
    </div>
</div><!-- end row -->


</div> <!-- container-fluid -->
</div>
@endsection
