@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">الطلبات</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">الطلبات العامة</h4>
                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>اسم مقدم الخدمة</th>
                                <th>حالة الطلب</th>
                                <th>القسم</th>
                                <th>الخدمة</th>
                                <th>اسم الطلب</th>
                                <th>المرفق</th>
                                <th>الوصف</th>
                                <th>تاريخ الاستحقاق</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($public_requests as $key => $request)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $request->user->name }}</td>

                                @if ($request->freelancer_id == null)
                                    <td>لم يتقدم أحد</td>
                                @else
                                    <td>{{ $request->User::where('id', $request->freelancer_id)->first()->name }}</td>
                                @endif

                                @if ($request->freelancer_id == null)
                                    <td class="bg-secondary">Pending</td>
                                @else
                                    <td class="bg-warning">In Process</td>
                                @endif

                                <td>{{ $request->category->title_ar }} - {{ $request->category->title_en }}</td>
                                <td>{{ $request->service->service_ar }} - {{ $request->service->service_en }}</td>
                                <td>{{ $request->title }}</td>
                                <td>{{ $request->attachment }}</td>
                                <td>{{ $request->description }}</td>
                                <td>{{ $request->due_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <th class="text-danger text-center fw-bold" colspan="10">
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
