@extends('Admin.layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">ادارة السحب النقدي</h4>
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
                                <th>المبلغ المراد سحبه</th>
                                <th>الحالة</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($cashs as $key => $cash)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ App\Models\User::where('id', $cash->user_id)->first()->name }}</td>
                                <td>{{ $cash->total }}</td>
                                <td>{{ $cash->status }}</td>
                                <form action="{{ route('cash_withdrawal.status', $cash->id) }}" method="post">
                                    @csrf
                                    <td>
                                        <input type="submit" name="status" value="Accepted" class="btn btn-success btn-sm">
                                        <input type="submit" name="status" value="Rejected" class="btn btn-danger btn-sm">
                                    </td>
                                </form>
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
