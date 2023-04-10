@extends("layouts.home.index")
@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
request private service
@endsection
@section("header")
@endsection
@section("css")
@endsection
@section("nosearch","none !important")
@section("content")


<div class="requestservice private">
    <div class="container">
        <div class="section-header ">
            <h2>request service from <span class="px-3">{{ App\Models\User::where('id', $freelancer->id)->first()->name }}</span> </h2>
        </div>

        <div class="form px-3">
            <form action="{{ route('user.request.store',$freelancer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
        
                <div class="mb-4">
                    <label for="inputName">Category</label>
                    <select name="category_id" id="category_id" class="form-control SlectBox @error('category_id') is-invalid @enderror" onclick="console.log($(this).val())"
                        onchange="console.log('change is firing')">
                        <option value="" selected disabled>Choose Category</option>
                        @foreach ($categories as $category)
                        @if(app()->getLocale()=='ar')
                        <option value="{{ $category->id }}"> {{ $category->title_ar }}</option>

                        @else
                        <option value="{{ $category->id }}"> {{ $category->title_en }}</option>

                        @endif
                        @endforeach
                    </select>
                    @error('category_id')<div class="alert alert-danger fs-small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="inputName" class="pb-2">Service</label>
                    <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">

                    </select>
                    @error('service_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="form-label pd-2">title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="persentation title">
                    @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <h5 class="form-label pd-2">attachment</h5>
                    <div class="d-flex flex-column flex-nowrap ">
                        <span class="text-danger py-4">Maximun upload 200 kB*</span>
                        <div class="d-flex">
                            <label for="attachment" class="download">
                                <i class="fa-solid fa-arrow-down"></i>
                            </label>
                            <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror" id="attachment">
                            @error('attachment')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label mb-3">description</label>
                    <textarea name="description" class="form-control w-100 @error('description') is-invalid @enderror" rows="3" placeholder="Descripe"></textarea>
                    @error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="date" class="form-label mb-3">due date</label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date"  min="{{date_format(now(),'Y-m-d')}}">
                    @error('due_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
                   <input type="hidden"  name="type" value="private">
                <button type="submit" class="btn btn-modal my-3 px-5 btn-model-primary request-button " >request</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section("js")
<script>
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var CategoryId = $(this).val();
            if (CategoryId) {
                $.ajax({
                    url: "{{ URL('user/category') }}/" + CategoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#service_id').empty();
                        $.each(data, function(key, value) {
                            $('#service_id').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
