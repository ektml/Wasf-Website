@extends("layouts.home.index")

@section("og-title")
{{$product->title}}
@endsection
@section("og-description")
{{$product->description}}
@endsection
@section("og-image")
{{ asset('assets/images/product/'.$product->img1) }}
@endsection
@section("title")
product
@endsection
@section("header")
@endsection


@section("css")


<style>
    .product-detail .row {
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
                    <h2 class="bold text-black">{{$product->name}} </h2>

                    <p class="text-black-50">
                        @if(app()->getLocale()=='ar')
                        {{   App\Models\Category::findorfail($product->cat_id)->title_ar}}
                        @else
                        {{   App\Models\Category::findorfail($product->cat_id)->title_en }}
                        @endif
                        ,


                        @if($product->service_id !=null)
                        @if(app()->getLocale()=='ar')
                        {{   App\Models\Service::findorfail($product->service_id)->service_ar }}

                        @else

                        {{   App\Models\Service::findorfail($product->service_id)->service_en }}
                        @endif
                        @endif
                    </p>


                </div>
            </div>

            <div class="service d-flex justify-content-end  flex-1">
                <div class="serv d-flex align-items-center">

                    <a href="{{route("freelanc.product.edit",$product->id)}}" style="
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

                    <div class="prod-likes withborder py-2 px-3 rounded-pill">
                        <i class="fa-solid fa-heart align-self-center"></i>
                        <span>{{$product->likes->count()}}</span>
                    </div>


                </div>

            </div>

        </div>

        <div class="contentporduct row  ">

            <div class="card-wrapper  col-lg-6 col-md-6 col-sm-12 ">
                <div class="card ">
                    <!-- card left -->
                    <div class="product-imgs d-flex">
                        <div class="product-detail">
                            <div class="row">
                                <div class="col-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill"
                                            href="#product-1" role="tab">
                                            <img src="{{ asset('assets/images/product/'.$product->img1) }}" alt=""
                                                class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                        <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2"
                                            role="tab">
                                            <img src="{{ asset('assets/images/product/'.$product->img2) }}" alt=""
                                                class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                        <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2"
                                            role="tab">
                                            <img src="{{ asset('assets/images/product/'.$product->img3) }}" alt=""
                                                class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>

                                    </div>
                                </div>

                                <div class="col-9">
                                    <div class="tab-content position-relative" id="v-pills-tabContent">


                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{ asset('assets/images/product/'.$product->img1) }}" alt=""
                                                    class="img-fluid mx-auto d-block"
                                                    data-zoom="assets/images/Component5.png">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product-2" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{ asset('assets/images/product/'.$product->img2) }}" alt=""
                                                    class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product-2" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{ asset('assets/images/product/'.$product->img3) }}" alt=""
                                                    class="img-fluid mx-auto d-block">
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
                <div class="price">{{$product->price}}<span class="curancy">
                        {{__('translate.S.R')}}
                    </span>

                </div>
                <div class="body">
                    {{$product->description}}
                </div>
                <div class="proprity py-4">
                    <h2>{{__('freelancerprofile.properties')}}</h2>

                    <ul>
                        @foreach ( $product->proprity()->get() as $proprity )
                        <li>{{$proprity->key}}: {{$proprity->value}}</li>

                        @endforeach


                    </ul>
                </div>

            </div>
        </div>




        <div class="card-body row pb-4">
            <div class="d-flex justify-content-baseline align-items-center col-lg-6 col-sm-12 col-xs-12 chart-static">

                <div id="productview"></div>

                <div class="div px-3 static-info">
                    <h3 class="bold">
                        {{ $product->view }}
                    </h3>
                    <p class="text-black-50">{{__('freelancerprofile.views')}}</p>
                </div>
            </div>

            <div class="d-flex justify-content-baseline align-items-center  col-lg-6 col-sm-12 col-xs-12 chart-static">
                <div id="productsell"></div>


                <div class="div px-3 static-info">
                    <h3 class="bold">
                        {{ $product->sells()->count() }}</h3>
                    <p class="text-black-50">{{__('freelancerprofile.sell')}}</p>
                </div>
            </div>


        </div>
    </div>

</div>

</div>
</div>



@endsection

@section("js")

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // product

    let view=createchart({{ $product->view }},"{{__('freelancerprofile.views')}}",["#f26b1d"])
    let sells=createchart( {{ $product->sells()->count() }},"{{__('freelancerprofile.sell')}}",["#f26b1d"])
    var chart = new ApexCharts(document.querySelector("#productview"), view);
        chart.render();
    var chart = new ApexCharts(document.querySelector("#productsell"), sells);
        chart.render();



    function createchart( count , name, color ){

    var options = {
  chart: {
    height: 280,
    type: "radialBar",
  },

  series: [count],
  colors: color,
  plotOptions: {
    radialBar: {
      hollow: {
        margin: 0,
        size: "70%",
        // background: "#293450",
        total: {
                show: true,
                label: 'Total',
                formatter: function (w) {
                  return 249;
                }
              }
      },
      track: {
        dropShadow: {
          enabled: true,
          top: 2,
          left: 0,
          blur: 4,
          opacity: 0.15
        }
      },
      dataLabels: {
        name: {
          offsetY: -10,
          color: "#000",
          fontSize: "13px"
        },
        value: {
          color: "#000",
          fontSize: "30px",
          show: true,
          formatter: function (val) {
            return val 
          }
        }
      }
    }
  },
  fill: {
    type: "gradient",
    gradient: {
      shade: "dark",
      type: "vertical",
      gradientToColors: ["#f26b1d"],
      stops: [0, 100]
    }
  },
  stroke: {
    lineCap: "round"
  },
  labels: [name]
};

return options;
    }

       
</script>
@endsection