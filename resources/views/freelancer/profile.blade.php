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
        <section class="freelanc v2" style="max-width: 1200px;">
            <div class="image">
                <img src="{{ asset('Admin3/assets/images/users/'.Auth::user()->profile_image) }}" alt="">
            </div>

            <div class="info w-100">
                <div class="name">
                    <span>{{ Auth::user()->name }}</span>
                    <div class="rate">
                        <i class="fa fa-star"></i>
                        <span> @if(
                            App\Models\Review::select('rate')->where('freelancer_id',Auth::user()->id)->count()>0)
                            {{round(App\Models\Review::select('rate')->where('freelancer_id',Auth::user()->id)->sum('rate')/  App\Models\Review::select('rate')->where('freelancer_id',Auth::user()->id)->count(),1)}}
                            @else
                            {{App\Models\Review::select('rate')->where('freelancer_id',Auth::user()->id)->count()}}
                            @endif</span>
                    </div>
                    <a href="#editfreelancerprofile" data-bs-toggle="modal"
                        class="editfreelancerprofile">
                        <i class="fa fa-edit" style="color: #000;"></i>
                    </a>
                </div>

                <di class="txt">{{ Auth::user()->bio }}</di>
            </div>


            <div class="totals">
                <a class="projects" href=" {{ route("freelanc.wallet") }}">
                    <p>{{__('freelancerprofile.wallet')}}</p>
                </a>

                <a class="productstotal" href="{{ route('freelanc.files') }}">
                    <p>{{__('freelancerprofile.My Files')}}</p>
                </a>

                <a class="photos" href="{{ route("freelanc.reviews") }}">
                    <p>{{__('freelancerprofile.Reviews')}} </p>
                </a>
            </div>
        </section>
    </div>

    <div class="categories pt-5 ms-3 ccs">
        <div class="container-fluid py-5   ">
            <div class="section-header">
                <h2>{{__('freelancerprofile.statics')}}</h2>
            </div>

            <div class="row">
                <div class="col-lg-6 col-12 ">
                    <div class="card card-static">
                        <div class="card-body row">
                            <div
                                class="d-flex justify-content-baseline align-items-center col-lg-6 col-sm-12 col-xs-12 chart-static">
                              
                                <div id="productcount"></div>

                                <div class="div px-3 static-info">
                                    <h3 class="bold">
                                        {{ $product_count }}
                                    </h3>
                                    <p class="text-black-50">{{__('freelancerprofile.products')}}</p>
                                </div>
                            </div>

                            <div
                                class="d-flex justify-content-baseline align-items-center  col-lg-6 col-sm-12 col-xs-12 chart-static">
                                <div id="photocount"></div>
                              

                                <div class="div px-3 static-info">
                                    <h3 class="bold">
                                        {{ $photo_count }}</h3>
                                    <p class="text-black-50">{{__('freelancerprofile.photos')}}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex justify-content-center col-12  ">

                    <div class="card w-100 ">
                        <div class="card-body card-body">
                            <h4 class="card-title bold">{{__('freelancerprofile.top 5 sales')}}</h4>

                            <div id="chart"></div>
                        </div>
                    </div>
                </div>


            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

    <div class="container-fluid py-5  px-3 ">
        <div class="section-header">
            <h2>{{__('freelancerprofile.services')}}</h2>
        </div>
    </div>

    <div class="servicex">
        <div class="serv">
            <a class="logo" href="#freelaceraddservice" data-bs-toggle="modal">
                <i class="fa fa-add" style="
                                color: #CDCDCD;
                                font-size: 101px;
                            "></i>
            </a>
        </div>

        @if(App\models\FreelancerService::where('freelancer_id',auth()->user()->id)->get()!=null)
        @foreach (App\models\FreelancerService::where('freelancer_id',auth()->user()->id)->get() as $serv)


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
            <h2>{{__('freelancerprofile.products')}}</h2>
            <a href="{{route("freelanc.product.index")}}" class="flex-1">{{__('freelancerprofile.see all')}}</a>
        </div>
    </div>
    <div class="container-fluid py-2 px-3 ">
        <div class="products productscroll">
            <a class="card card-plus" href="{{route("freelanc.product.create")}}">
                <div class="image-product "
                    style="display: flex; justify-content: center; align-items: center; color: #CDCDCD; background-color: #F8F8F8; border-radius: 18px; display: flex; flex-direction: column;">
                    <i class="fa fa-add " style="font-size: 70px;"></i>
                    <p>{{__('freelancerprofile.add new product')}} </p>
                </div>
                <div class="card-body"></div>
            </a>

            @foreach (App\Models\Product::where('freelancer_id', Auth::user()->id)->get() as $product)
            <div class="card">
                <div class="image-product">
                    <img src="{{ asset('assets/images/product/'.$product->img1) }}" class="card-img-top"
                        alt="product image">
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <div class="freelancer-info d-flex align-items-center ">
                    </div>

                    <div class="prod-likes justify-content-start ">
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
                <h2>{{__('freelancerprofile.photos')}}</h2>
                <a href="{{route("freelanc.photo.index")}}" class="flex-1">{{__('freelancerprofile.see all')}}</a>
            </div>
        </div>

        <div class="container-fluid py-2 px-3 ">
            <div class="products productscroll">
                <a class="card card-plus" href="{{route("freelanc.photo.create")}}">
                    <div class="image-product"
                        style="display: flex; justify-content: center; align-items: center; color: #CDCDCD; background-color: #F8F8F8; border-radius: 18px; display: flex; flex-direction: column;">
                        <i class="fa fa-add " style="font-size: 70px;"></i>
                        <p>{{__('freelancerprofile.add new photo')}}</p>
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
                        <div class="prod-likes ">
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

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



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



<script>
    var count=[]
    var names=[];
  @foreach ($sell_top as $top)
count.push({{$top->sells()->count()}})
names.push('{{$top->name}}')

  @endforeach
  function padArrayWithZeros(arr, desiredLength) {
 
  if (arr.length < desiredLength) {
    const zerosToAdd = desiredLength - arr.length;
    for (let i = 0; i < zerosToAdd; i++) {
      arr.push(0);
    }
  }
  return arr;
}

var selles=padArrayWithZeros(count,5);
var options = {
          series: [{
          name: 'Inflation',
          data: selles,
        }],
          chart: {
          height: 200,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val ;
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#f26b1d"]
          }
        },
        
        xaxis: {
          categories: names,
          position: 'bottom',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: false,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return val ;
            }
          }
        
        },
        background:'#333',
        title: {
          text: "{{__('freelancerprofile.top 5 sales')}}",
          floating: true,
          offsetY: 330,
          align: 'top',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        
</script>




<script>
    var options = {
  chart: {
    height: 280,
    type: "radialBar",
  },

  series: [{{$photo_count}}],
  colors: ["#d4d949"],
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
  labels: ["{{__('freelancerprofile.photos')}}"]
};

        var chart = new ApexCharts(document.querySelector("#photocount"), options);
        chart.render();
</script>




<script>
    // product
 
    var options = {
  chart: {
    height: 280,
    type: "radialBar",
  },

  series: [{{$product_count}}],
  colors: ["#f26b1d"],
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
  labels: ["{{__('freelancerprofile.products')}}"]
};


        var chart = new ApexCharts(document.querySelector("#productcount"), options);
        chart.render();
</script>
@endsection