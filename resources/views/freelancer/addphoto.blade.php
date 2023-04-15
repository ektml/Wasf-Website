@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
{{__('freelancerprofile.add photo')}}
@endsection
@section("header")
@endsection


@section("css")

<style>
  .hlafwidth {
    max-width: 400px;
  }

  .fullwidth {
    width: 100%;
  }

  .form {
    max-width: 100% !important;
    font-size: 22px;
  }

  /* .form label ,.form h5, .form input[placeholder]{
    font-size: 22px;
  } */

  .requestservice .container .form form button[type="submit"] {
    position: relative;
    left: 0;
    width: 200px;
  }

  .requestservice .container .form form button[type="submit"]+button {
    width: 200px;
  }

  label {
    font-weight: 600;
  }

  label span {
    font-weight: 300;
  }

  .location {
    position: relative;

  }
</style>
@endsection

@section("nosearch","none !important")
@section("content")


<div class="requestservice">
  <div class="container">

    <div class="form px-3">
      <div class="section-header">
        <h2>{{__('freelancerprofile.add photo')}}</h2>
      </div>
      <form action="{{route("freelanc.photo.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4 hlafwidth">

          <h5 class="form-label pd-2">{{__('freelancerprofile.upload photo')}}</h5>
          <div class="d-flex flex-column flex-nowrap ">
            <span class="py-4">{{__('freelancerprofile.Maximun upload 200 kB')}}</span>
            <div class="d-flex">
              <label for="attachment" class="download">
                <i class="fa-solid fa-arrow-down"></i></label>
              <input type="file" class="form-control" id="attachment" name="photo" placeholder="persentation title" ">
          </div>
               @error(" photo") <span class="error-message">{{$message}}</span>
              @enderror
            </div>

          </div>
          <div class="mb-4 hlafwidth">
            <label for="prodname" class="form-label pd-2"> {{__('freelancerprofile.photo name')}}</label>
            <input type="text" class="form-control" id="photoname" value="{{old('name')}}" name="name"
              placeholder="e.g wedding card">
            @error("name")
            <span class="error-message">{{$message}}</span>
            @enderror
          </div>

          <div class="mb-4 fullwidth">
            <label for="description" class="form-label mb-3">{{__('freelancerprofile.description')}}</label>
            <input class="form-control " id="description" placeholder="Write photo description" name="description"
              value="{{old('description')}}">
            @error("description")
            <span class="error-message">{{$message}}</span>
            @enderror
          </div>

          <div class="mb-4 hlafwidth">
            <label for="camera" class="form-label pd-2">
              {{__('freelancerprofile.camera brand')}}<span>({{__('freelancerprofile.optional')}})</span></label>
            <input type="text" class="form-control" id="camera_brand" name="camerabrand" placeholder="e.g cannon"
              value="{{old('camerabrand')}}">
            @error("camerabrand")
            <span class="error-message">{{$message}}</span>
            @enderror
          </div>
          <div class="mb-4 hlafwidth">
            <label for="lens" class="form-label mb-3 " id>{{__('freelancerprofile.lens type')}}
              <span>({{__('freelancerprofile.optional')}})</span></label>
            <input class="form-control " id="lens" placeholder="e.g 70-200 mm" name="lens" value="{{old('lens')}}">
            @error("lens")
            <span class="error-message">{{$message}}</span>
            @enderror
          </div>
          <div class="mb-4 hlafwidth">
            <label for="lens" class="form-label mb-3 ">{{__('freelancerprofile.size')}}</label>
            <div class="d-flex justify-content-between">
              <div>
                <input class="form-control w-100" id="sizewidth" placeholder="{{__('freelancerprofile.width')}}"
                  name="sizewidth" value="{{old('sizewidth')}}">
                @error("sizewidth")
                <span class="error-message">{{$message}}</span>
                @enderror
              </div>
              <div>
                <input class="form-control w-100" id="sizeheight" placeholder="{{__('freelancerprofile.height')}}"
                  name="sizeheight" value="{{old('sizeheight')}}">
                @error(" sizeheight") <span class="error-message">{{$message}}</span>
                @enderror

              </div>


            </div>

          </div>
          <div class="mb-4 hlafwidth">
            <label for="category"> {{__('freelancerprofile.size type')}}</label>
            <select name="sizetype" id="sizetype" class="form-select" aria-label="Default select example">
              <option value="px" @if ((old('sizetype')=='px' )) selected @else @endif>px</option>
              <option value="inc" @if ((old('sizetype')=='inc' )) selected @else @endif>inc</option>
              <option value="cm" @if ((old('sizetype')=='cm' )) selected @else @endif>cm</option>
            </select>
          </div>

          <div class="mb-4 hlafwidth">
            <label for="lens" class="form-label mb-3 " id> {{__('freelancerprofile.location')}}<span>(
                {{__('freelancerprofile.optional')}})</span></label>
            <div class="location">
              <input class="form-control " id="lens" placeholder="Search" name="location" value="{{old('location')}}">
              <button class="search-location" type="button">
                <i class="fa fa-search"></i>
              </button>

              @error("location")
              <span class="error-message">{{$message}}</span>
              @enderror
            </div>
          </div>


          <div class="d-flex justify-content-center align-items-center flex-column ">

            <button type="submit"
              class="btn  btn-modal  my-3 px-5  btn-model-primary position-none ">{{__('freelancerprofile.add photo')}}</button>

          </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section("js")

<script>


</script>

@endsection