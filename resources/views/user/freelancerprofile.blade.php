@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
freelanser name
@endsection
@section("header")
@endsection


@section("css")
<style>


input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input     [type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration {
    display: none;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

@media (max-width: 767px) {
    .aiz-uploader-search i {
        font-size: 23px;
        cursor: pointer;
        padding: 4px;
        margin-right: 5px;
        position: relative;
        z-index: 2;
        top: 3px;
    }

    .aiz-uploader-search input {
        position: absolute;
        z-index: 1;
        top: 0;
        right: 5px;
        left: 5px;
        width: calc(100% - 10px);
        height: 100%;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }

    .aiz-uploader-search.open input {
        visibility: visible;
        opacity: 1;
    }
}


@media (max-width: 767px) {
    .aiz-uploader-search i {
        font-size: 23px;
        cursor: pointer;
        padding: 4px;
        margin-right: 5px;
        position: relative;
        z-index: 2;
        top: 3px;
    }

    .aiz-uploader-search input {
        position: absolute;
        z-index: 1;
        top: 0;
        right: 5px;
        left: 5px;
        width: calc(100% - 10px);
        height: 100%;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }

    .aiz-uploader-search.open input {
        visibility: visible;
        opacity: 1;
    }
}

.search-icon {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
    overflow: hidden;
    white-space: nowrap;
    color: transparent;
    z-index: 3;
}
.search-icon:hover {
    color: transparent;
}
.search-icon::before,
.search-icon::after {
    content: "";
    position: absolute;
    -webkit-transition: opacity 0.3s;
    -moz-transition: opacity 0.3s;
    transition: opacity 0.3s;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.search-icon::before {
    top: 7px;
    left: 7px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid #686f7a;
}
.search-icon::after {
    height: 2px;
    width: 8px;
    background: #686f7a;
    bottom: 10px;
    right: 7px;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.search-icon span {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
.search-icon span::before,
.search-icon span::after {
    content: "";
    position: absolute;
    display: inline-block;
    height: 2px;
    width: 18px;
    top: 50%;
    margin-top: -1px;
    left: 50%;
    margin-left: -8px;
    background: #686f7a;
    opacity: 0;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
    -moz-transition: opacity 0.3s, -moz-transform 0.3s;
    transition: opacity 0.3s, transform 0.3s;
}
.search-icon span::before {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.search-icon span::after {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
.open .search-icon::before,
.open .search-icon::after {
    opacity: 0;
}
.open .search-icon span::before,
.open .search-icon span::after {
    opacity: 1;
}
.open .search-icon span::before {
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -ms-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
}
.open .search-icon span::after {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.mobile-search.is-visible {
    opacity: 1;
    visibility: visible;
    -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
    -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
    transition: opacity 0.3s 0s, visibility 0s 0s;
}


/*navbar*/
.aiz-navbar .search .input-group > select,
.aiz-navbar .search .bootstrap-select {
    min-width: 160px;
}

.aiz-navbar .search .input-group-prepend {
    min-width: 280px;
}

.aiz-navbar .menu a {
    color: #505050;
    font-weight: 500;
    font-size: 13px;
}
.aiz-navbar .menu a.btn-primary {
    color: #fff;
}
@media (max-width: 991px) {
    .front-header-search {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        left: 0;
        opacity: 0;
        transform: translateY(-100%);
        -webkit-transform: translateY(-100%);
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }
    .front-header-search.active {
        transform: translateY(0%);
        -webkit-transform: translateY(0%);
        opacity: 1;
    }
}
</style>
@endsection


@section("content")


<div class="d-lg-none ml-auto mr-0">
  <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
      <i class="las la-search la-flip-horizontal la-2x"></i>
  </a>
</div>

<div class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
  <div class="position-relative flex-grow-1">
      <form action="" method="GET" class="stop-propagation">
          <div class="d-flex position-relative align-items-center">
              <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                  <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
              </div>
              <div class="input-group">
                  <input type="text" class="border-0 border-lg form-control" id="search" name="keyword" @isset($query)
                      value="{{ $query }}"
                  @endisset placeholder="" autocomplete="off">
                  <div class="input-group-append d-none d-lg-block">
                      <button class="btn btn-primary" type="submit">
                          <i class="la la-search la-flip-horizontal fs-18"></i>
                      </button>
                  </div>
              </div>
          </div>
      </form>
      <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
          <div class="search-preloader absolute-top-center">
              <div class="dot-loader"><div></div><div></div><div></div></div>
          </div>
          <div class="search-nothing d-none p-3 text-center fs-16">

          </div>
          <div id="search-content" class="text-left">

          </div>
      </div>
  </div>
</div>

<div class="d-none d-lg-none ml-3 mr-0">
  <div class="nav-search-box">
      <a href="#" class="nav-box-link">
          <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
      </a>
  </div>
</div>
<a class="addrequesticon" href="">
    <i class="fa-solid fa-plus"></i>
    </a>
  <div class="products-page py-5">
        <div class="container">
         
            <section class="freelanc v2" >
   
                <div class="image">
                  <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                </div>
                <div class="info">
                  <div class="name">
                    <span>ahmed</span>
                        <div class="rate">
                          <i class="fa fa-star"></i>
                          <span>4,5</span>
                        </div> 
                  </div>
                  <div class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam velit alias ratione eaque dolores expedita ex repellat ducimus. Ratione quisquam molestiae iusto minima obcaecati tenetur delectus ex ipsam doloribus nulla.</div>
                  
                </div>
                <div class="totals">
                 <div class="projects">
                  <i class="fa-solid fa-list-check"></i>
                  <p>14 <sub>projects</sub></p>
                 </div>
                 <div class="productstotal">
                  <i class="fa-solid fa-dollar-sign"></i>
                  <p>14  <sub>products</sub></p>
                 </div>
                 <div class="photos"> 
                  <i class="fa-solid fa-image"></i>
                  <p>14  <sub>photos</sub></p>
                 </div>
              
                </div>
              
              </section>

            
           

       
         </div>

         <div class="categories pt-5 ms-3 ccs">
          <div class="container-fluid pt-5  px-3 ">
              <div class="servicex">
                  <div class="serv">
                      <div class="logo">
                          <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="txt">
                          Bannars
                      </div>
                  </div>
                  <div class="serv">
                      <div class="logo">
                          <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="txt">
                          Bannars
                      </div>
                  </div>
                  <div class="serv">
                      <div class="logo">
                          <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="txt">
                          Bannars
                      </div>
                  </div>
                  <div class="serv">
                      <div class="logo">
                          <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="txt">
                          Bannars
                      </div>
                  </div>
              </div>
          </div>
         </div>
         <div class="categories pt-3 ms-3 ccs">
            <div class="container-fluid py-5  px-3 position-relative ">


                <div class="section-header">
                    <h2>products</h2>
        
                </div>
                <button class="pre-btn">
                  <i class="fa fa-arrow-left"></i>
              </button>
              <button class="nxt-btn"><i class="fa fa-arrow-right"></i></button>
               
                <div class="products productscroll scrollable">
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
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
                                <div class="card-body">
                                  <h5 class="card-title">product name</h5>
                                  <div class="freelancer-info d-flex align-items-center ">
                                    <div class="image">
                                      <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                                    </div>
                                     <p class="card-text ">freelancer name</p>
                                  </div>
                                  <div  class="prod-likes ">
                                      <i class="fa-solid fa-heart align-self-center"></i>
                                      <span>123</span>
                                  </div>
                                
                                </div>
                     </div>
              </div>
            </div>
        </div>
         <div class="categories ccs ms-3 ">
            <div class="container-fluid py-2 px-3 scrollable-container position-relative">
                <div class="section-header">
                    <h2>photos</h2>
        
                </div>
               
                <button class="pre-btn">
                  <i class="fa fa-arrow-left"></i>
              </button>
              <button class="nxt-btn"><i class="fa fa-arrow-right"></i></button>
                <div class="products productscroll  scrollable">
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



<div class="reviews">
    <div class="container-fluid d-block">

        <div class="section-header px-4 ">
            <h2 class="text-black "> reviews <span class="text-black">(1234)</span></h2>

        </div>

        <div class="review freelanc ">

                <div class="image">
                  <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                </div>
                <div class="info">
                  <div class="name">
                    <span>ahmed</span>
                        <div class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                         
                        </div> 
                  </div>
                  <div class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam velit alias ratione eaque dolores expedita ex repellat ducimus. Ratione quisquam molestiae iusto minima obcaecati tenetur delectus ex ipsam doloribus nulla.</div>
                 
                </div>
        </div>
        <div class="review freelanc ">

                <div class="image">
                  <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                </div>
                <div class="info">
                  <div class="name">
                    <span>ahmed</span>
                        <div class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                         
                        </div> 
                  </div>
                  <div class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam velit alias ratione eaque dolores expedita ex repellat ducimus. Ratione quisquam molestiae iusto minima obcaecati tenetur delectus ex ipsam doloribus nulla.</div>
                 
                </div>
        </div>
        <div class="review freelanc ">

                <div class="image">
                  <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                </div>
                <div class="info">
                  <div class="name">
                    <span>ahmed</span>
                        <div class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                         
                        </div> 
                  </div>
                  <div class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam velit alias ratione eaque dolores expedita ex repellat ducimus. Ratione quisquam molestiae iusto minima obcaecati tenetur delectus ex ipsam doloribus nulla.</div>
                 
                </div>
        </div>
        <a href="" class=" text-center showmore">show more</a>
    </div>
</div>
        
  </div>

  
   

@endsection

@section("js")
    
@endsection





