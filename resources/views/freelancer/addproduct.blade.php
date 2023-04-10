@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
add product
@endsection
@section("header")
@endsection


@section("css")
<style>
    /* .requestservice .container .form form button[type="submit"] {
        position: relative;
        left: 120%;
    }

    @media(max-width:767px) {
        .requestservice .container .form form button[type="submit"] {
            position: relative;
            left: 30%;
        }
    }

    @media(max-width:400px) {
        .requestservice .container .form form button[type="submit"] {
            position: relative;
            left: 0%;
        }
    } */
</style>
@endsection

@section("nosearch","none !important")
@section("content")


<div class="requestservice">
    <div class="container">

        <div class="form px-3">
            <div class="section-header">
                <h2>add product</h2>
            </div>

            <form class="repeater" action="{{route('freelanc.product.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="inputName">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control SlectBox @error('category_id') is-invalid @enderror"
                        onclick="console.log($(this).val())" onchange="console.log('change is firing')">
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
                    <select name="service_id" id="service_id"
                        class="form-control @error('service_id') is-invalid @enderror">

                    </select>
                    @error('service_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="prodname" class="form-label pd-2">product name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="prodname"
                        value='{{old('name')}}' name="name" placeholder="e.g wedding card">
                    @error('name')
                    <span class="text-red">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label pd-2">price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        value='{{old('price')}}' name="price" placeholder="50 S.R">
                    @error('price')
                    <span class="text-red">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label mb-3">description</label>
                    <input class="form-control @error('description') is-invalid @enderror " id="description"
                        placeholder="Write product description" value='{{old('description')}}' name="description">
                    @error('description')
                    <span class="text-red">{{$message}}</span>
                    @enderror
                </div>








                <div class="propritys mb-3" style="width:100%">
                    <label for="proprety" class="form-label mb-3 " id>properties</label>

                    <div data-repeater-list="group-a" class="proprity">
                        <div data-repeater-item class="row ">

                            <div class="mb-3 col-10 d-flex flex-column justify-content-center">



                                <div class="prop-key">
                                    <input class="form-control " placeholder="e.g File size, programs used"
                                        name="prop_key">
                                </div>
                                <div class="prop-value">
                                    <input class="form-control " placeholder="values" name="prop_value">
                                </div>

                            </div>



                            <div class="col-2 align-self-center">
                                <div class="d-grid">
                                    {{-- <input data-repeater-delete type="button" class="btn btn-primary delete-propity" value="delete"/> --}}
                                    <button data-repeater-delete type="button" class="btn delete-propity">
                                        <i class="fa-solid fa-minus fa-lg" style="color: #e82517;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input data-repeater-create type="button"
                        class="btn add-propity btn-success   border-0 mt-3 mt-lg-0" value="Add" />
                    @error('group-a')
                    <span class="text-red">{{$message}}</span>
                    @enderror

                </div>





                {{-- proprity --}}
                <div class="mb-4">
                    <h5 class="form-label pd-2">attachment</h5>
                    <div class="d-flex flex-column flex-nowrap ">
                        <span class="py-4">Maximun upload 200 kB</span>
                        <div class="d-flex">
                            <label for="attachment" class="download">
                                <i class="fa-solid fa-arrow-down"></i></label>
                            <input type="file" @error('attachment') is-invalid @enderror class="form-control"
                                id="attachment" name="attachment" value='{{old('attachment')}}'
                                placeholder="persentation title">
                            @error('file')
                            <span class="text-red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="form-label pd-2">product pictures</h5>
                    <div class="d-flex flex-column flex-nowrap ">
                        <span class="py-4">Maximun 3 pictures</span>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label for="attachment2" class="download">
                                    <i class="fa-regular fa-image"></i></label>
                                <input type="file" class="form-control @error('img1') is-invalid @enderror"
                                    id="attachment2" name="img1" value='{{old('img1')}}'
                                    placeholder="persentation title">
                            </div>
                            <div class="d-flex">
                                <label for="attachment3" class="download">
                                    <i class="fa-regular fa-image"></i></label>
                                <input type="file" class="form-control @error('img2') is-invalid @enderror"
                                    id="attachment3" name="img2" value='{{old('img2')}}'
                                    placeholder="persentation title">
                            </div>
                            <div class="d-flex">
                                <label for="attachment4" class="download">
                                    <i class="fa-regular fa-image"></i></label>
                                <input type="file" class="form-control @error('img3') is-invalid @enderror"
                                    id="attachment4" name="img3" value='{{old('img3')}}'
                                    placeholder="persentation title">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column ">

                    <button type="submit" class="btn  btn-modal  my-3 px-5  btn-model-primary ">add product</button>
                  
                  
                  </div>
               
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-repeater.int.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/app.js')}}"></script> --}}



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
                        if(data!='[]'){
                            console.log(data);
                        $.each(data, function(key, value) {
                            $('#service_id').append('<option value="' +
                                key + '">' + value + '</option>');
                        });}else{

                           
                            $('#service_id').append('<option value=""> on service </option>'); 
                        }
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
{{-- <script >
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var catId = $(this).val();
            if (catId) {
                $.ajax({
                    url: "{{ URL::to('freelancer/category') }}/" + catId,
type: "GET",
dataType: "json",
success: function(data) {
if(data){
$('#service_id').removeAttr("disabled");
console.log($('select[name="service_id"]'))
$('#service_id').empty();
$.each(data, function(key, value) {
$('#service_id').append('<option value="' +
                                key + '">' + value + '</option>');
});
}else{
$('#service_id').append("<option value''>no service</option>")
$('#service_id').attr("disabled","disabled");
}

},
});
} else {
console.log('AJAX load did not work');
}
});
});
</script> --}}


<script>
    $(document).ready(function() {
  // Get all the .proprity elements
  var newProprityCount = $('.proprity').length;
  var count=1;
  // Check if there is only one .proprity element on page load
  if (newProprityCount === 1) {
    // Hide the delete button
    $('.proprity .delete-propity').hide();
  }

  // Add a click event listener to the "add property" button
  $('.propritys').on('click', '.add-propity', function() {
  // Get the new count of .proprity elements
  
  // Check if there is more than three .proprity elements
  
  count++;
  if (count >= 4) {
    // Hide the add button
    $('.propritys .add-propity').hide();
  }
});

  // Add a click event listener to the "delete property" button
  $('.proprity').on('click', '.delete-propity', function() {
    // Get the new count of .proprity elements
    count--;

    if (count <= 4) {
    // Hide the add button
    $('.propritys .add-propity').show();
  }

    var newProprityCount = $('.proprity').length;
    // Check if there is only one .proprity element
    console.log(newProprityCount);
    if (newProprityCount === 1) {
      // Hide the delete button
      $('.proprity:last-child .delete-propity').hide();
    }
  });
});
</script>
@endsection