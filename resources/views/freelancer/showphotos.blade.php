@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
all photo
@endsection
@section("header")
@endsection


@section("css")


<style>
.edit{
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #ffffffd9;
    color: #312f2f;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    font-size: 20px;
}


.card{
    box-shadow: none;
}

.products-page .container-fluid .product-table {
    width: 100%;
}
.products-page .container-fluid .product-table .products {
    width: 100%;
    display: flex;
    justify-content:flex-start;
}
</style>
@endsection


@section("content")

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Edit'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Edit') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Delete'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
        <strong>{{ session()->get('Delete') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<a class="addrequesticon" href="#">
<i class="fa-solid fa-plus"></i>
</a>
  <div class="products-page">
        <div class="container-fluid  px-5 d-flex  flex-column">
            <div class="section-header">
                <h2>photos</h2>
                
            </div>
          <div class="product-table" >
             
               <div class="products">

                <a class="card" href="{{route("freelanc.photo.create")}}"> 
                    <div class="image-product " style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    color: #CDCDCD;
                    background-color: #F8F8F8;
                    border-radius: 18px;
                    display: flex;
                     flex-direction: column;
                ">
                                
                                        <i class="fa fa-add " style="
                    font-size: 70px;
                    
                "></i>
                             <p>add new photo</p>           
                                        </div>
                            <div class="card-body">
                               
                            </div>
                 </a>

                 @forelse ($photos as $photo )
                 <a href="{{route("freelanc.photo.show",$photo->id)}}">
                 <div class="card">
                    <div class="image-product">
                       <img src="{{asset("assets/images/photo/".$photo->photo)}}" class="card-img-top" alt="product image">
                       <a href="{{route("freelanc.photo.edit",$photo->id)}}"class="edit">
                          <i class="fa fa-pencil"></i>
                       </a>
                      </div>
                              <div class="card-body d-flex justify-content-between">
                                <h5 class="card-title">{{$photo->name}}</h5>
                               
                                <div  class="prod-likes ">
                                    <i class="fa-solid fa-heart align-self-center"></i>
                                    <span>
                                       {{ $photo->likes->count()}}
                                    </span>
                                </div>
                              
                              </div>
                   </div>
                </a>
                 @empty
                        
                 @endforelse
              

             
          </div>
               </div>
          
            
          </div>
            
       
  </div>
      </div>
    </div>
 


@endsection

@section("js")
    
@endsection