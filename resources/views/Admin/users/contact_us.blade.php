@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">العملاء</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">جميع العملاء</h4>
                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>الايميل</th>
                                <th>رقم الجوال</th>
                                <th>الموضوع</th>
                                <th>الرسالة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($contact_requests as $key => $request)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->user->email }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->subject }}</td>
                                <td>{{ $request->message }}</td>
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
            </div>
        </div>
    </div>
</div><!-- end row -->
</div> <!-- container-fluid -->
</div>
@endsection
