@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
  products
@endsection
@section("header")
@endsection


@section("css")

@endsection
@section("content")

<a class="addrequesticon" href="{{route('user.requestpublic')}}">
    <i class="fa-solid fa-plus"></i>
</a>

<div class="products-page">
    <div class="container-fluid d-flex">
        <div class="category-table">
            <ul class="category">
                @foreach ($categories as $category)
                @if( empty($category->services->first()))
                <li><a href="{{route('products',['cat_id'=>$category->id])}}"
                    @if(isset($cat_id) && $cat_id==$category->id)
                    class="active"
                    @endif >{{ $category->title_en }}</a></li>
                    @else
                    <li><a href="#" class="linktosubcategory @if(isset($cat_id) && $cat_id==$category->id)
                    active
                        @endif" data-id='{{$category->id}}'>{{ $category->title_en }}</a></li>
                    @endif
                @endforeach
            </ul>

            @foreach (App\Models\Category::all() as $category)
            <div class="subcategorys" id="subcategorys{{$category->id}}">
                <div class="d-flex px-3">
                    <button type="button" class="closesubcategory" data-id='{{$category->id}}'>
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </div>

                <div class="d-flex flex-column">
                    @foreach ( $category->services as  $service)
                    <a href="{{route('products',['cat_id'=>$category->id,'subcat_id'=>$service->id])}}"
                        @if(isset($subcat_id)&&$subcat_id==$service->id)
                            class="active"
                        @endif
                        >{{$service->service_en}}</a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="product-table">
            <div class="filtercontainer d-flex align-items-baseline justify-content-start mb-2">
                <div class="filter d-flex align-items-baseline">
                    <button class=" filter-button btn d-flex align-items-center justify-content-between">
                    <i class="fa-solid fa-arrow-up-wide-short"></i>
                        <span >sort by:</span>
                    </button>
                    <span class="px-2">All</span>
                </div>

                <div class="filter-items">
                    <form name="filter-products" id="filter-products">
                    <div name="sort" id="sort">
                        <div>
                            <input type="checkbox" name="sort" value="product_newest"
                            @if (isset($_GET['sort']) && $_GET['sort'] == "product_newest") selected="" @endif>
                            <label class="bold">Newest</label>
                        </div>

                        <div>
                            <input type="checkbox" name="sort" value="product_rate"
                            @if (isset($_GET['sort']) && $_GET['sort'] == "product_rate") selected="" @endif>
                            <label class="bold">Higher Rating</label>
                        </div>

                        <div>
                            <input type="checkbox" name="sort" value="product_price"
                            @if (isset($_GET['sort']) && $_GET['sort'] == "product_price") selected="" @endif>
                            <label class="bold">Price: Low to High</label>
                        </div>

                        <div class="btn-contianer d-flex justify-content-center align-items-center">
                            <button type="submit" class="border-0 btn-modal my-3 btn-model-primary">apply</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        <div class="products">
            @foreach ($products as $product)
                <a  href='{{route('product', $product->id)}}'class="card">
                    <div class="image-product">
                        <img src="{{asset('assets/images/product/'.$product->img1) }}" class="card-img-top" alt="product image">
                            @auth
                        <button type="button" data-type="product" data-id="{{$product->id}}"
                        onclick="likes(this)"
                        class="hart @if ($product->likes->where("user_id", auth()->user()->id)->count())
                            active
                        @endif"><i class="fa fa-heart"></i></button>
                        @else
                        <button class="hart" type="button" data-bs-target="#login" data-bs-toggle="modal"><i class="fa fa-heart"></i></button>
                        @endauth
                        @auth
                        <button class="addtochart" data-id="{{$product->id}}" onclick="addcart(this)">add to cart</button>
                        @else
                        <button class="addtochart">add to cart</button>
                        @endauth
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <div class="freelancer-info d-flex align-items-center ">
                            <div class="image">
                                <img src="{{ asset("Admin3/assets/images/users/".App\Models\User::where('id', $product->freelancer_id)->first()->profile_image) }}" alt="">
                            </div>
                            <p class="card-text">{{ \App\Models\User::where('id', $product->freelancer_id)->first()->name }}</p>
                        </div>

                        <div class="prod-likes">
                            <i class="fa-solid fa-heart align-self-center"></i>
                            <span>{{ $product->likes->count() }}</span>
                        </div>
                    </div>
                </a> <!-- card -->
                @endforeach
            </div>

            <div class="text-end p-4">
                {{-- {{ $products->links() }} --}}
            </div>
    </div>
    </div>
</div>
@endsection

@section("js")
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
    console.log(data);
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
    var token= $('meta[name="csrf_token"]').attr('content');
    $.ajax({
 type: "GET",
  url: "{{ URL::to('user/addcart')}}/" + id,
  data:{'type':type},
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  dataType: "json",
  success: function(data) {
    console.log(data);
    if(data['action']=="add"){
        $(e).addClass("active");
    }else if(data['action']=="delete"){
        $(e).removeClass("active");
    }
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


{{-- Filter --}}
<script>
$(document).ready(functon(){
    $("#filter").on("change", function(){
        this.form.submit();

    });
});
</script>

@endsection
