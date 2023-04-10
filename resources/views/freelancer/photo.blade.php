@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
photo
@endsection
@section("header")
@endsection


@section("css")


<style>
.product-detail .row{
    flex-grow: 1;
    
}
.product-detail {
    width: 100%;

}

</style>

<link href="{{asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section("nosearch","none !important")

@section("content")

  <div class="product-page">
        <div class="container d-flex flex-column ">
            <div class="header d-flex align-items-center">
                <div class="title">
                    
                    <div class="info d-flex flex-column  ">
                        <h2 class="bold text-black">{{$photo->name}}</h2>
                       
                        <div class="rate">
                            <i class="fa fa-star"></i>
                            <span>3,4</span>
                          </div> 
                                
                              
                    </div>
                </div>
                
             <div class="service d-flex justify-content-end  flex-1">
                <div class="serv d-flex align-items-center">

                    <a href="{{route("freelanc.photo.edit",$photo->id)}}" style="
                    display: flex;
                    flex-grow: 1;
                    align-items: center;
                    justify-content: center;
                    padding: 12px;
                    margin: 0 15px;
                    border-radius: 50%;
                    background-color: #fafafa;
                "><i class="fa fa-edit" style="
                    color: #000;
                    font-size: 25px;
                "></i></a>

                    <div  class="prod-likes withborder py-2 px-3 rounded-pill">
                                  <i class="fa-solid fa-heart align-self-center"></i>
                                  <span>{{$photo->likes->count()}}</span>
                    </div>

                            
                </div>
                
             </div>

            </div>

<div class="contentporduct row  ">
             
    <div class = "card-wrapper  col-lg-5 col-md-6 col-sm-12 ">
      <div class = "card ">
        <!-- card left -->
        <div class = "product-imgs d-flex">
            <div class="product-detail">
              {{--  --}}

              <div class="card">
                <div class="card-body photo-card-body">
                    <div class="popup-gallery">
                        <div class="row">

                            <div class="col-12">
                                <a href="{{asset('assets/images/photo/'.$photo->photo)}}" title="$photo->name">
                                    <div class="img-fluid photo-place d-flex justify-content-end">
                                        <img src="{{asset('assets/images/photo/'.$photo->photo)}}" alt="" class="img-fluid d-block">
                                    </div>
                                </a>
                            </div>
                            </div>
                    </div>
                   
                    </div>
                </div>
            

              {{--  --}}
            </div>
        </div>
      </div>
    </div>
                <div class="description  col-lg-7 col-md-6 col-sm-12  d-flex flex-column ">
                    <div class="price bold fs-3">{{$photo->price}}<span class="curancy fs-6">
                        S.R
                    </span>

                    </div>
                    <div class="body">
                        {{$photo->description}}
                    </div>
                    <div class="proprity py-4" >
                        <h2  class="bold">proprities</h2>
                        <ul >
                            <li>camera: {{$photo->camera_brand}}</li>
                            <li>camra lens:{{$photo->lens_type}} </li>
                            <li>size: {{$photo->size_width}} {{$photo->size_height}}{{$photo->size_type}}</li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>

            
            
       </div>
 
      </div>
    </div>
 


@endsection

@section("js")
<script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- lightbox init js-->
<script src="{{asset('assets/js/pages/lightbox.init.js')}}"></script>

@endsection