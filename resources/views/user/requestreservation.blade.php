@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
request reservation
@endsection
@section("header")
@endsection

@section("css")
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/select2/css/select2.min.cs')}}" rel="stylesheet">
<link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css')}}" rel="stylesheet">


<style>
    .container{
        display: block !important;
    }
</style>

@endsection

@section("nosearch","none !important")
@section("content")


<div class="requestservice   private">
<div class="container">
    <div class="section-header ">
        <h2>request service from
            <span class="px-3 fs-3">{{ $freelancer->name }}</span>
        </h2>
    </div>
<div class="form px-3">

    <form action="{{ route('user.requestreservation.store', $freelancer->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="occation">What is the occasion</label>
            <input type="text" name="occasion" class="form-control" id="occation" placeholder="eg.wedding">
        </div>

        <div class="mb-4">
            <label for="v" class="pb-2">date&time</label>
            <div>
                <input type="date" name="date_time" class="form-control" id="datepicker-inline"
                 min="{{date_format(now(),'Y-m-d')}}">
            </div>
        </div>

        <div class="mb-4 hlafwidth d-flex justify-content-between  px-3">
            <div class="d-flex flex-column">
                <label for="from" class="form-label mb-3">from</label>
                <input type="time" class="form-control" id="from" placeholder="width" name="from">
            </div>

            <div class="d-flex flex-column">
                <label for="to" class="form-label mb-3 " >to</label>
                <input type="time" class="form-control" id="to" placeholder="width" name="to">
            </div>
        </div>


        <label class="form-label">location</label>
        <div class="location" style="position: relative;">
            <input class="form-control" id="location" placeholder="Search" name="location">
            <button class="search" style="position: absolute;top: 0;right: 0;background-color: #fff;border: 0;">
                <i class="fa-solid fa-location-dot text-black-50"></i>
            </button>
        </div>
        <button type="submit" class="btn btn-modal my-3 px-5 btn-model-primary request-button">request</button>
    </form>
</div>
</div>
</div>
@endsection


@section("js")
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>

<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js"')}}"></script>

<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
@endsection
