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
    .product-detail .row {
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

                    <div class="prod-likes withborder py-2 px-3 rounded-pill">
                        <i class="fa-solid fa-heart align-self-center"></i>
                        <span>{{$photo->likes->count()}}</span>
                    </div>


                </div>

            </div>

        </div>

        <div class="contentporduct row  ">

            <div class="card-wrapper  col-lg-5 col-md-6 col-sm-12 ">
                <div class="card ">
                    <!-- card left -->
                    <div class="product-imgs d-flex">
                        <div class="product-detail">
                            {{--  --}}

                            <div class="card">
                                <div class="card-body photo-card-body">
                                    <div class="popup-gallery">
                                        <div class="row">

                                            <div class="col-12">
                                                <a href="{{asset('assets/images/photo/'.$photo->photo)}}"
                                                    title="$photo->name">
                                                    <div class="img-fluid photo-place d-flex justify-content-end">
                                                        <img src="{{asset('assets/images/photo/'.$photo->photo)}}"
                                                            alt="" class="img-fluid d-block">
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
                        {{__('translate.S.R')}}
                    </span>

                </div>
                <div class="body">
                    {{$photo->description}}
                </div>
                <div class="proprity py-4">
                    <h2 class="bold">{{__('freelancerprofile.properties')}}</h2>
                    <ul>
                        <li>{{__('freelancerprofile.camera brand')}}: {{$photo->camera_brand}}</li>
                        <li>camra lens:{{$photo->lens_type}} </li>
                        <li>size: {{$photo->size_width}} {{$photo->size_height}}{{$photo->size_type}}</li>

                    </ul>
                </div>

            </div>
        </div>




        <div class="card-body row pb-4">
            <div class="d-flex justify-content-baseline align-items-center col-lg-6 col-sm-12 col-xs-12 chart-static">

                <div id="productview"></div>

                <div class="div px-3 static-info">
                    <h3 class="bold">
                        {{ $photo->view }}
                    </h3>
                    <p class="text-black-50">{{__('freelancerprofile.views')}}</p>
                </div>
            </div>

            <div class="d-flex justify-content-baseline align-items-center  col-lg-6 col-sm-12 col-xs-12 chart-static">
                <div id="productsell"></div>


                <div class="div px-3 static-info">
                    <h3 class="bold">
                        {{ $photo->sells()->count() }}</h3>
                    <p class="text-black-50">{{__('freelancerprofile.sell')}}</p>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // product

    let view=createchart({{ $photo->view }},"{{__('freelancerprofile.views')}}",["#f26b1d"])
    let sells=createchart( {{ $photo->sells()->count() }},"{{__('freelancerprofile.sell')}}",["#f26b1d"])
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