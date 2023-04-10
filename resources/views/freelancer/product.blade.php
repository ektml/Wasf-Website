@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
product
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
@endsection
@section("nosearch","none !important")

@section("content")

  <div class="product-page">
        <div class="container d-flex flex-column ">
            <div class="header d-flex align-items-center">
                <div class="title">
                    
                    <div class="info d-flex flex-column  ">
                        <h2 class="bold text-black">product name </h2>
                       
                        <p class="text-black-50">categroyname , supcategory name</p>
                                
                              
                    </div>
                </div>
                
             <div class="service d-flex justify-content-end  flex-1">
                <div class="serv d-flex align-items-center">

                    <a href="{{route("freelanc.editproduct")}}" style="
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
                                  <span>123</span>
                    </div>

                            
                </div>
                
             </div>

            </div>

<div class="contentporduct row  ">
             
    <div class = "card-wrapper  col-lg-6 col-md-6 col-sm-12 ">
      <div class = "card ">
        <!-- card left -->
        <div class = "product-imgs d-flex">
            <div class="product-detail">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill" href="#product-1" role="tab">
                                <img src="{{asset('assets/images/Component5.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                            </a>
                            <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2" role="tab">
                                <img src="{{asset('assets/images/comp.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                            </a>
                            <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2" role="tab">
                                <img src="{{asset('assets/images/comp.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="tab-content position-relative" id="v-pills-tabContent">

                          
                            <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                <div class="product-img">
                                    <img src="{{asset('assets/images/Component5.png')}}" alt="" class="img-fluid mx-auto d-block" data-zoom="assets/images/Component5.png">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product-2" role="tabpanel">
                                <div class="product-img">
                                    <img src="{{asset('assets/images/comp.png')}}" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product-2" role="tabpanel">
                                <div class="product-img">
                                    <img src="{{asset('assets/images/comp.png')}}" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                      
                        
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
                <div class="description  col-lg-6 col-md-6 col-sm-12  d-flex flex-column ">
                    <div class="price">53<span class="curancy">
                        S.R
                    </span>

                    </div>
                    <div class="body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam culpa reprehenderit veniam sequi, exercitationem ipsum voluptates sed, soluta et voluptate perspiciatis distinctio quaerat aut. Rem autem aut illum eveniet voluptatibus.
                    </div>
                    <div class="proprity py-4" >
                        <h2 >proprities</h2>
                        <ul >
                            <li>File type: PDF, PSD</li>
                            <li>Programs used: illustrator, InDesign </li>
                            <li>File size: A4</li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>

            
            
       </div>
 
      </div>
    </div>
 


@endsection

@section("js")
    
@endsection