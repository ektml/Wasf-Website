@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
edit photo
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
    font-size: 22px;
  }

  /* .form label ,.form h5, .form input[placeholder]{
    font-size: 22px;
  } */

  .requestservice .container .form form button[type="submit"] {
    position: relative;
    left: 0;
    width:200px;
}

.requestservice .container .form form button[type="submit"] +button{
    width:200px;  
}
label{
    font-weight: 600; 
}

label span{
    font-weight: 300;
}

.location{
    position: relative;

}
.search{
    position: absolute;
    top:0;
    right:0;
    background-color: #fff;
    color: #C0C0C0;
    border: none;
}
</style>
@endsection

@section("nosearch","none !important")
@section("content")
    

<div class="requestservice">
<div class="container">

<div class="form px-3">
    <div class="section-header">
            <h2>edit photo</h2>
        </div>
    <form action="{{route('freelanc.photo.update',$photo->id)}}" method="POST"enctype="multipart/form-data">
     @csrf
     @method("PUT")
     <div class="mb-4 hlafwidth">

      <h5  class="form-label pd-2">upload photo</h5>
      <div class="d-flex flex-column flex-nowrap ">
        <span class="py-4">Maximun upload 200 kB</span>
    <div class="d-flex">
        <label for="attachment" class="download"> 
    <i class="fa-solid fa-arrow-down"></i></label>
      <input type="file" class="form-control" id="attachment" name="photo" placeholder="persentation title" ">
    </div>
         @error("photo")
             <span class="error-message">{{$message}}</span>
         @enderror
      </div>
      
    </div>
 <div class="mb-4 hlafwidth">
<label for="prodname" class="form-label pd-2">photo name</label>
<input type="text" class="form-control" id="photoname" value="{{$photo->name}}" name="name" placeholder="e.g wedding card">
@error("name")
             <span class="error-message">{{$message}}</span>
@enderror
</div>

<div class="mb-4 fullwidth">
<label for="description" class="form-label mb-3">description</label>
<input  class="form-control " id="description" placeholder="Write photo description"  name="description" value="{{$photo->description}}">
@error("description")
             <span class="error-message">{{$message}}</span>
@enderror
</div> 

<div class="mb-4 hlafwidth">
<label for="camera" class="form-label pd-2">camera brand<span>(optional)</span></label>
<input type="text" class="form-control" id="camera_brand"  name="camerabrand" placeholder="e.g wedding card" value="{{$photo->camera_brand}}">
@error("camerabrand")
             <span class="error-message">{{$message}}</span>
@enderror
</div>
<div class="mb-4 hlafwidth">
<label for="lens" class="form-label mb-3 " id>lens type <span>(optional)</span></label>
<input  class="form-control " id="lens" placeholder="e.g 70-200 mm"  name="lens"
value="{{$photo->lens_type}}">
@error("lens")
<span class="error-message">{{$message}}</span>
@enderror
</div> 
<div class="mb-4 hlafwidth">
<label for="lens" class="form-label mb-3 " >size</label>
<div class="d-flex justify-content-between">
<div>
  <input  class="form-control w-100" id="sizewidth" placeholder="width"  name="sizewidth"
  value="{{$photo->size_width}}">
  @error("sizewidth")
  <span class="error-message">{{$message}}</span>
@enderror
</div>
  <div>
    <input  class="form-control w-100" id="sizeheight" placeholder="height"  name="sizeheight" value="{{$photo->size_height}}">
    @error("sizeheight")
    <span class="error-message">{{$message}}</span>
    @enderror

  </div>
  
  
</div>

</div> 
<div class="mb-4 hlafwidth">
<label for="category">size type </label>
<select name="sizetype" id="sizetype"class="form-select" aria-label="Default select example">
   <option value="px" @if ($photo->size_type=='px')
     selected
   @else
     
   @endif>px</option>
   <option value="inch"@if (($photo->size_type=='inch'))
   selected
 @else
   
 @endif>inch</option>
   <option value="cm"@if (($photo->size_type=='cm'))
   selected
 @else
   
 @endif>cm</option>
</select>
</div>

<div class="mb-4 hlafwidth">
  <label for="lens" class="form-label mb-3 " id>location<span>(optional)</span></label>
  <div class="location" >
      <input  class="form-control " id="lens" placeholder="Search"  name="location"value="{{$photo->location}}" >
      <button class="search" type="button">
          <i class="fa fa-search"
          ></i>
      </button>

      @error("location")
      <span class="error-message">{{$message}}</span>
  @enderror
  </div>
</div>


      <div class="d-flex justify-content-center align-items-center flex-column ">

        <button type="submit" class="btn  btn-modal  my-3 px-5  btn-model-primary position-none ">edit photo</button>
     
        <button type="button"  class="btn  modal-color-text  d-block my-3 px-5 "  data-bs-toggle="modal" data-bs-target="#suredeletephoto">delete photo</button>


      </div>
 
     


    </form>

</div>

</div>

</div>
<div class="modal fade " id="suredeletephoto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
             
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('freelanc.photo.destroy',$photo->id)}}"  method="POST">
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


</script>

@endsection