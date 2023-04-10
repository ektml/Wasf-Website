@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">تفاصيل المدفوعات</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>اسم مقدم الخدمة</th>
                                <th>القسم</th>
                                <th>الخدمة</th>
                                <th>المنتج</th>
                                <th>سعر الخدمة</th>
                                <th>تاريخ البدء</th>
                                <th>تاريخ الانتهاء</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($payments as $key => $payment)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ App\Models\User::where('id', $payment->user_id)->first()->name }}</td>
                                <td>{{ App\Models\User::where('id', $payment->freelancer_id)->first()->name }}</td>
                                <td>{{ App\Models\Category::where('id', $payment->category_id)->first()->title_en }} - {{ App\Models\Category::where('id', $payment->category_id)->first()->title_ar }}</td>
                                <td>{{ App\Models\Service::where('id', $payment->service_id)->first()->service_en }} - {{ App\Models\Service::where('id', $payment->service_id)->first()->service_ar }}</td>
                                <td>{{ App\Models\Product::where('id', $payment->product_id)->first()->name }}</td>
                                <td>{{ App\Models\Product::where('id', $payment->product_id)->first()->price }}</td>
                                <td>{{ App\Models\Requests::where('id', $payment->request_id)->first()->created_at }}</td>
                                <td>{{ App\Models\Requests::where('id', $payment->request_id)->first()->due_date }}</td>
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
