@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
{{$photo->name}}
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
                        <h2 class="bold text-black">{{$photo->name}} </h2>
                       
                        <div class="freelancer-info d-flex ">
                            <div class="d-flex ">
                                <div class="image">
                              <img src="{{asset('Admin3/assets/images/users/'.$freelancer->profile_image)}}" alt="{{$photo->name}}">
                            </div>
                             <p class="card-text ">{{$freelancer->name}} <span class="text-black-50 px-2">|</span></p>
                          </div>
                          <div  class="freelacer-rate">
                              <i class="fa-solid fa-star align-self-center"></i>
                              <span>       @if( App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count()>0)
                                {{App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->sum('rate') / App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count()}}
                            @else
    {{App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count()}}
                            @endif </span>
                          </div>
                            </div>
                              
                    </div>
                </div>
                
                <div class="service d-flex justify-content-end  flex-1">
                    <div class="serv d-flex align-items-center">
                        <div  class="prod-likes withborder py-2 px-3 rounded-pill">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>
                                        
                                 {{$photo->likes->count()}}
                                      </span>
                                  </div>
    
                                  {{-- <form action="">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#addcart"class="btn  btn-modal  my-3 btn-model-primary">add to chart</button>
                                  </form> --}}

                                  @auth

                                  @if(!$photo->sells()->where('user_id',auth()->user()->id)->exists())
                                     @if ($photo->carts()->where('user_id',auth()->user()->id)->exists())
                                     <button class="btn  btn-modal  my-3 btn-model-primary"  data-id="{{$photo->id}}" onclick="addcart(this)"data-type='photo'>in cart</button>  
                                     @else
                                     <button class="btn  btn-modal  my-3 btn-model-primary"  data-id="{{$photo->id}}" onclick="addcart(this)"data-type='photo'>add to cart</button>
                                     @endif
                            
                                  @else
                                  <button class="btn  btn-modal  my-3 btn-model-primary" > you paid</button>
                                  @endif
    
                                    
                                  @else
                                  <button class="btn  btn-modal  my-3 btn-model-primary" data-bs-target="#login2" data-bs-toggle="modal" >add to cart</button>
                                  @endauth
    
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
                                <div class="price bold fs-3">53<span class="curancy fs-6">
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
                                        <li>size: {{$photo->size_width}}   {{$photo->size_height}}{{$photo->size_type}}</li>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>

            
            {{-- <div class="similar ">
                <div class="section-header d-flex  ">
            <h2 class="me-auto">similar products</h2>

            <a href="#" class="flex-1">See all</a>
            </div>
            <div class="product-table">
            <div class="row">
              <div class="card-container col-xs-12 col-sm-6 col-md-4 col-lg-3" >
                <div class="card">
                  <div class="image-product">
                     <img src="https://media.architecturaldigest.com/photos/57c7003fdc03716f7c8289dd/master/pass/IMG%20Worlds%20of%20Adventure%20-%201.jpg" class="card-img-top" alt="product image">
                     <button class="hart ">
                      <i class="fa fa-heart"></i>
                     </button>
                     <button class="addtochart">
                      add to cart
                     </button>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="card-title">product name</h5>
                       
                        <div  class="prod-likes ">
                            <i class="fa-solid fa-heart align-self-center"></i>
                            <span>123</span>
                        </div>
                      
                      </div>
                 </div>
              </div>
            
              </div>
          </div>
            </div> --}}




            <div class="similar ">
                <div class="section-header d-flex  ">
            <h2 class="me-auto">similar photos</h2>

          
            </div>
            <div class="product-table">
            <div class="row">

                @forelse ( $similar as $s )

                    <div class="card col-xs-12 col-sm-12 col-md-6 col-lg-4" style="max-width: 300px">
                      <div class="image-product  im-product" >
                        <img src="{{asset('assets/images/photo/'.$s->photo) }}" class="card-img-top" alt="product image">
                        @auth
                        <button type="button" data-type="photo" data-id="{{$s->id}}"

                            onclick="likes(this)"
                        class="hart   @if ($s->likes->where("user_id",auth()->user()->id)->count())
                                active
                            @endif"><i class="fa fa-heart"></i></button>
                               @else
                               <button  class="hart" type="button" data-bs-target="#login2" data-bs-toggle="modal"><i class="fa fa-heart"></i></button>
                              @endauth

                              @auth

                              @if(!$s->sells()->where('user_id',auth()->user()->id)->exists())
                                 @if ($s->carts()->where('user_id',auth()->user()->id)->exists())
                                 <button class="addtochart active"  data-id="{{$s->id}}" onclick="addcart(this)"data-type='photo'>in cart</button>  
                                 @else
                                 <button class="addtochart"  data-id="{{$s->id}}" onclick="addcart(this)"data-type='photo'>add to cart</button>
                                 @endif
                        
                              @else
                              <button class="addtochart active" > you paid</button>
                              @endif

                                
                              @else
                              <button class="addtochart" data-bs-target="#login2" data-bs-toggle="modal" >add to cart</button>
                              @endauth

                          
                       
                        </div>
                                <div class="card-body">
                                  <h5 class="card-title">{{$s->name}}</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                        <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $s->freelancer_id)->first()->profile_image) }}" alt="">
                                    </div>
                                     <p class="card-text ">{{\APP\models\User::find($s->freelancer_id)->name}}</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>{{$s->likes->count()}}</span>
                                  </div>
                                
                                </div>
                     </div>
                    
    
                @empty
                    <span>no photo</span>
                @endforelse
              

                 {{-- end card --}}
              
            
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





<script>
    $(".filter-button").click(function(){
        $(".filter-items").toggle();
    });



function likes(e){
// $(this).toggleClass("active");
var id =$(e).attr('data-id');
 var  type =$(e).attr('data-type');
var token= $('meta[name="csrf_token"]').attr('content');
$.ajax({
 type: "GET",
  url: "{{ URL::to('user/addorremovelikes')}}/" + id,
  data:{'type':type},
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  dataType: "json",
  success: function(data) {
    
    if(data['action']=="add"){
        $(e).addClass("active");
    }else if(data['action']=="delete"){
        $(e).removeClass("active");

    }
  }

  });


}

function addcart(e){
    var id =$(e).attr('data-id');
    var  type =$(e).attr('data-type');
    var token= $('meta[name="csrf_token"]').attr('content');
    $.ajax({
 type: "GET",
  url: "{{ URL::to('user/addtocart')}}/" + id,
  data:{'type':type},
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  dataType: "json",
  success: function(data) {
    console.log(data);
    if(data['status']){
        $(e).addClass("active");
        $(e).text('in cart');

        $('#cart-count').html(parseInt($('#cart-count').html())+1);
        $(document).ready(function(){
            $('#addcart').modal('show');
        });
        
    }else{

        toastr.warning(data['message']); // Debugging statement
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); // Debugging statement
        }

  });
}

$(document).ready(function () {
    $(".category a.linktosubcategory").click(function(e){
    e.preventDefault();
    var id=$(this).attr('data-id');
    $("#subcategorys"+id).toggle();

    $('.subcategorys').not($("#subcategorys"+id)).hide();
    })

    $('.closesubcategory').click(function(e){
        var id=$(this).attr('data-id');
    $("#subcategorys"+id).hide();

    });
});
    </script>
@endsection