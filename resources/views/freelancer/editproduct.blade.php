@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
edit product
@endsection
@section("header")
@endsection


@section("css")

<style>
  .hlafwidth{
   max-width:400px;
  }

  .fullwidth{
    width:100%;
  }

  .form{
    max-width:100% !important;
  }
  .requestservice .container .form form button[type="submit"] {
    position: relative;
    left: 0;
    width:200px;
}

.requestservice .container .form form button[type="submit"] +button{
    width:200px;  
}
</style>
@endsection

@section("nosearch","none !important")
@section("content")
    

<div class="requestservice">
<div class="container">

<div class="form px-3 ">
    <div class="section-header">
            <h2>edit product</h2>
        </div>
    <form action="{{route('freelanc.product.update',$product->id)}}" method="POST">
     
 @csrf
 @method('PUT')
      <div class="mb-4  hlafwidth">
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
    <div class="mb-4  hlafwidth">
        <label for="inputName" class="pb-2">Service</label>
        <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">

        </select>
        @error('service_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
    </div>
       <div class="mb-4 hlafwidth">
  <label for="price" class="form-label pd-2">price</label>
  <input type="text" class="form-control" id="price" name="price" placeholder="50 S.R">
</div>
<div class="mb-4 fullwidth">
    <label for="description" class="form-label mb-3">description</label>
    <input  class="form-control " id="description" placeholder="Write product description"  name="discription">
  </div> 
<div class="mb-4 hlafwidth">
    <label for="proprety" class="form-label mb-3 " id>properties</label>
    <div id="properties">
        <input  class="form-control " id="proprety" placeholder="Write product proprets"  name="property">
        
    </div>


    
  </div> 
       
<div class="mb-4  fullwidth">

  <h5  class="form-label pd-2">attachment</h5>
  <div class="d-flex flex-column flex-nowrap ">
    <span class="py-4">Maximun upload 200 kB</span>
{{-- <div class="d-flex">
    <label for="attachment" class="download"> 
<i class="fa-solid fa-arrow-down"></i></label>
  <input type="file" class="form-control" id="attachment" name="attachment" placeholder="persentation title">
</div> --}}
<div id="newfile" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
  <div class="accordion-body d-flex flex-column">
    <div class="file d-flex ">
        <div class="details d-flex ">
            <div class="img">
<i class="fa-regular fa-file-word"></i>
            </div>
            <div class="info">
                <h3>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod temporlorem
                    
                </h3>
                <div class="size">
                    521kB . PDF
                </div>
            </div>
         
        </div>
        <div class="tool">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </div>
    </div>
  
  </div>
</div>
  </div>
  
</div>
<div class="mb-4 halfwidth">

  <h5  class="form-label pd-2">product pictures</h5>
  <div class="d-flex flex-column flex-nowrap ">
    <span class="py-4">Maximun 3 pictures</span>

    <div class="d-flex hlafwidth ">
        <div class="d-flex">
            <label for="attachment" class="download"> 
                <i class="fa-regular fa-image"></i></label>
          <input type="file" class="form-control" id="attachment" name="attachment" placeholder="persentation title">
        </div>
        <div class="d-flex">
            <label for="attachment" class="download"> 
                <i class="fa-regular fa-image"></i></label>
          <input type="file" class="form-control" id="attachment" name="attachment" placeholder="persentation title">
        </div>
        <div class="d-flex">
            <label for="attachment" class="download"> 
                <i class="fa-regular fa-image"></i></label>
          <input type="file" class="form-control" id="attachment" name="attachment" placeholder="persentation title">
        </div>
    </div>

  
  </div>
  
</div>


    
<div class="d-flex justify-content-center align-items-center flex-column ">

  <button type="submit" class="btn  btn-modal  my-3 px-5  btn-model-primary position-none ">edit product</button>

  <button type="button"  data-bs-toggle='modal' data-bs-target="#suredeleteproduct" class="btn  modal-color-text  d-block my-3 px-5 ">delete product</button>


</div>
     
    </form>

</div>

</div>

</div>

<div class="modal fade " id="suredeleteproduct" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
             
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('freelanc.product.destroy',$product->id)}}"  method="POST">
                @csrf
                @method("DELETE")
      <h1 class="modal-title fs-5" >are you sure from delete this photo</h1>

      
     


      

      <div class="btn-contianer d-flex  justify-content-between  align-items-center my-3">
            
        <button class="btn  btn-modal modal-color-text border-0">move back</button>
        <button class="btn  btn-modal btn-model-primary" type="submit">delete</button>
       
</div>





</form>

          </div>
      
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

var i = 0;
       
       $("#add").click(function(){   
           ++i;
           $("#properties").append(' <input class="form-control" name="addMore['+i+']"[proprity]">');
       });
       
       $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
       });  
</script>

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