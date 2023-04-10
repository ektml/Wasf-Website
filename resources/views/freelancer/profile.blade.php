@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
profile
@endsection
@section("header")
@endsection


@section("css")


@endsection


@section("content")

@include("layouts.component.modal.updatefreelancerprofile")
@include("layouts.component.modal.cashout")
@include("layouts.component.modal.feelanceraddservice")

<a class="addrequesticon" href="">
    <i class="fa-solid fa-plus"></i>
</a>

<div class="products-page py-5 px-md-4">
        <div class="container">
            <section class="freelanc v2"  style="max-width: 1200px;">
                <div class="image">
                    <img src="{{ asset('Admin3/assets/images/users/'.Auth::user()->profile_image) }}" alt="">
                </div>

                <div class="info w-100">
                    <div class="name">
                        <span>{{ Auth::user()->name }}</span>
                            <div class="rate">
                            <i class="fa fa-star"></i>
                            <span>4,5</span>
                            </div>
                            <a href="#editfreelancerprofile" data-bs-toggle="modal" style="display: flex;flex-grow:1;align-items: center;justify-content:flex-end;padding: 0 33px;font-size: 18px;position: absolute;top: 48px;right: -5px;">
                                <i class="fa fa-edit" style="color: #000;"></i>
                            </a>
                        </div>

                    <di class="txt">{{ Auth::user()->bio }}</di>
                </div>


            <div class="totals">
                <a class="projects" href=" {{ route("freelanc.wallet") }}">
                    <p>Wallet</p>
                </a>

                <a class="productstotal" href="{{ route('freelanc.files') }}">
                    <p>My files</p>
                </a>

                <a class="photos" href="{{ route("freelanc.reviews") }}">
                    <p>Reviews </p>
                </a>
            </div>
        </section>
    </div>

    <div class="categories pt-5 ms-3 ccs">
        <div class="container-fluid py-5   ">
            <div class="section-header">
                <h2>statics</h2>
            </div>

    <div class="row">
        <div class="col-lg-6 col-12 ">
            <div class="card card-static">
            <div class="card-body row">
                    <div class="d-flex justify-content-baseline align-items-center col-lg-6 col-sm-12 col-xs-12 chart-static">
                        <div class="text-center" dir="ltr">
                            <input class="knob" data-width="200" data-height="200" data-linecap=round
                                    data-fgColor="#4AB0D9" value="20" data-skin="tron" data-angleOffset="100"
                                    data-readOnly=true data-thickness=".1"/>
                        </div>

                        <div class="div px-3 static-info">
                            <h3 class="bold">{{ \App\Models\Product::where('freelancer_id', Auth::user()->id)->count() }}</h3>
                            <p class="text-black-50">products</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-baseline align-items-center  col-lg-6 col-sm-12 col-xs-12 chart-static">
                        <div class="text-center" dir="ltr">
                            <input class="knob" data-width="200" data-height="200" data-linecap=round
                                data-fgColor="#D4D949" value="12" data-skin="tron" data-angleOffset="100"
                                data-readOnly=true data-thickness=".1"/>
                        </div>

                        <div class="div px-3 static-info">
                            <h3 class="bold">{{ App\Models\Photo::where('freelancer_id', Auth::user()->id)->count() }}</h3>
                            <p class="text-black-50">photos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex justify-content-center col-12  ">
            <div class="card  ">
                <div class="card-body card-body-bar">
                    <h4 class="card-title bold">top 5 sales</h4>
                    <div id="sparkline2" data-colors="[&quot;#ffb88fb8&quot;]" class="text-center"><canvas style="display: inline-block; width: 231px; height: 200px; vertical-align: top;" width="231" height="200"></canvas></div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</div>

        <div class="container-fluid py-5  px-3 ">
            <div class="section-header">
                <h2>services</h2>
            </div>
        </div>

                <div class="servicex">
                    <div class="serv">
                        <a class="logo" href="#freelaceraddservice"  data-bs-toggle="modal">
                            <i class="fa fa-add" style="
                                color: #CDCDCD;
                                font-size: 101px;
                            "></i>
                        </a>
                    </div>

   @if(App\models\FreelancerService::where('freelancer_id',auth()->user()->id)->get()!=null)
                    @foreach (App\models\FreelancerService::where('freelancer_id',auth()->user()->id)->get() as  $serv)
                       

                    @if($serv->parent_id ==null)

                    <div class="serv">
                        <div class="logo">
                            <i class="fa-solid {{App\models\Category::find($serv->service_id)->icon}}"></i>
                        </div>
                        <div class="txt">
                            @if ( app()->getLocale()=='ar')
                            {{App\models\Category::find($serv->service_id)->title_ar}}
                                
                            @else
                            {{App\models\Category::find($serv->service_id)->title_en}}
                                
                            @endif
                        </div>
                    </div>
                    @else

                    <div class="serv">
                        <div class="logo">
                            <i class="{{App\models\Service::find($serv->service_id)->service_icon}}"></i>
                        </div>
                        <div class="txt">
                            @if ( app()->getLocale()=='ar')
                            {{App\models\service::find($serv->service_id)->service_ar}}
                                
                            @else
                            {{App\models\Service::find($serv->service_id)->service_en}}
                                
                            @endif
                            
                        </div>
                    </div>
                    @endif
                    @endforeach
                @endif
                </div>


                <div class="container-fluid py-2 px-3 ">   
        <div class="section-header">
            <h2>products</h2>
            <a href="{{route("freelanc.product.index")}}" class="flex-1">See all</a>
        </div>
                </div>
                <div class="container-fluid py-2 px-3 ">   
        <div class="products productscroll">
            <a class="card card-plus" href="{{route("freelanc.product.create")}}">
                <div class="image-product " style="display: flex; justify-content: center; align-items: center; color: #CDCDCD; background-color: #F8F8F8; border-radius: 18px; display: flex; flex-direction: column;">
                    <i class="fa fa-add " style="font-size: 70px;"></i>
                    <p>add New product</p>
                </div>
                <div class="card-body"></div>
            </a>

            @foreach (App\Models\Product::where('freelancer_id', Auth::user()->id)->get() as $product)
                <div class="card">
                    <div class="image-product">
                        <img src="{{ asset('assets/images/product/'.$product->img1) }}" class="card-img-top" alt="product image">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <div class="freelancer-info d-flex align-items-center ">
                        </div>

                        <div  class="prod-likes justify-content-start ">
                            <i class="fa-solid fa-heart align-self-center"></i>
                            <span>{{ $product->likes->count() }}</span> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                </div>

            @if(App\Models\User::find(auth()->user()->id)->is_photographer ==1 )
            <div class="categories ccs ms-3 ">
                <div class="container-fluid py-2 px-3 ">
                    <div class="section-header">
                        <h2>photos</h2>
                        <a href="{{route("freelanc.photo.index")}}" class="flex-1">See all</a>
                    </div>
                </div>
    
                <div class="container-fluid py-2 px-3 ">
                <div class="products productscroll">
                    <a class="card card-plus" href="{{route("freelanc.photo.create")}}">
                        <div class="image-product" style="display: flex; justify-content: center; align-items: center; color: #CDCDCD; background-color: #F8F8F8; border-radius: 18px; display: flex; flex-direction: column;">
                            <i class="fa fa-add " style="font-size: 70px;"></i>
                            <p>add new photo</p>
                        </div>
    
                        <div class="card-body">
                        </div>
                    </a>
    
                @foreach (App\Models\Photo::where('freelancer_id', Auth::user()->id)->get() as $photo)
                    <div class="card">
                        <div class="image-product">
                            <img src="{{ asset('assets/images/photo/'.$photo->photo) }}" class="card-img-top" alt="Photo">
                        </div>
    
                        <div class="card-body d-flex justify-content-between">
                            <h5 class="card-title">{{ $photo->name }}</h5>
                            <div  class="prod-likes ">
                                <i class="fa-solid fa-heart align-self-center"></i>
                                <span>{{ $photo->likes->count() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                </div>
            </div>
            @endif
        
    </div>


  </div>




@endsection

@section("js")
<script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<script src="{{asset('assets/js/pages/jquery-knob.init.js')}}"></script>



<script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{asset('assets/js/pages/sparklines.init.js')}}"></script>

<script>


const $categoryCheckboxes = $('.category-checkbox');
const $serviceCheckboxes = $('.service-checkbox');

// Add event listener to each service checkbox
$serviceCheckboxes.on('click', function() {
    // Get the parent category checkbox of this service checkbox
    const $parentCategory = $(`.category-checkbox[value="${$(this).data('parent')}"]`);
    
    // Check if at least one service checkbox is checked
    if ($(`.service-checkbox[data-parent="${$parentCategory.val()}"]:checked`).length > 0) {
        // If at least one service is checked, select the parent category checkbox
        $parentCategory.prop('checked', true);
    } else {
        // If no service is checked, unselect the parent category checkbox
        $parentCategory.prop('checked', false);
    }
});

$categoryCheckboxes.on('click', function() {
    // Get all service checkboxes within this category
    const $serviceCheckboxes = $(`.service-checkbox[data-parent="${$(this).val()}"]`);
    
    // Check/uncheck each service checkbox
    $serviceCheckboxes.prop('checked', this.checked);
});


</script>
@endsection





