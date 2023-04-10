@extends("layouts.home.homepage")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
home
@endsection
@section("header")
@endsection
@section("css")
@endsection

@section("content")

@auth
<a class="addrequesticon" href="{{route('user.requestpublic')}}">
    <i class="fa-solid fa-plus"></i>
</a>  
@else
<a class="addrequesticon" href="#login2"  data-bs-toggle="modal">
    <i class="fa-solid fa-plus"></i>
</a>
@endauth

<div class="messages pt-3">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-4 message d-flex flex-column align-items-center justify-content-center text-center mb-5">
               <img src="{{asset("assets/images/20943451.png")}}" alt="" class=" mx-auto mb-3" >
               <div class="text">
                <h3 class="fw-bold text-uppercase"> message 1</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora accusamus cum a tempore alias veritatis repudiandae in fugiat. Nemo dicta vitae aliquam, eius aperiam qui corporis enim voluptas molestias in!</p>
               </div>
            </div>
            <div class="col-lg-4 message d-flex flex-column align-items-center justify-content-center text-center mb-5">
               <img src="{{asset("assets/images/8055.png")}}" alt="" class="mx-auto mb-3" >
               <div class="text">
                <h3 class="fw-bold text-uppercase">message 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora accusamus cum a tempore alias veritatis repudiandae in fugiat. Nemo dicta vitae aliquam, eius aperiam qui corporis enim voluptas molestias in!</p>
               </div>
            </div>
            <div class="col-lg-4 message d-flex flex-column align-items-center justify-content-center text-center mb-5">
               <img src="{{asset("assets/images/Wavy_Bus-15_Single-06.png")}}" alt="" class=" mx-auto mb-3" >
               <div class="text">
                <h3 class="fw-bold text-uppercase"> message 3</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora accusamus cum a tempore alias veritatis repudiandae in fugiat. Nemo dicta vitae aliquam, eius aperiam qui corporis enim voluptas molestias in!</p>
               </div>
            </div>
        </div>
    </div>
</div>



<div class="categories pt-3">
    <div class="container py-3 scrollable-container">
        <div class="section-header">
            <h2>categories</h2>
            <a href="{{route('products')}}">See all</a>
        </div>

        <button class="pre-btn">
            <i class="fa fa-arrow-left"></i>
        </button>
        <button class="nxt-btn"><i class="fa fa-arrow-right"></i></button>

        <div class="scrollable d-flex" >
            @forelse  ($categories as $category)
                <div class="category ">
                    <div class="image"><i class="fa {{ $category->icon }}"></i></div>
                    <p>{{ $category->title_en }}</p>
                </div>
                @empty

                <p class=" w-100  text-center " style="height: 150px"> no freelancer</p>
                @endforelse
        </div>
    </div>
</div> <!-- End Category Section -->

<div class="freelancers pt-3">
    <div class="container py-3 scrollable-container">
        <div class="section-header">
            <h2>Top freelancers</h2>
            <a href="{{route('freelancers')}}">See all</a>
        </div>

        <button class="pre-btn">
            <i class="fa fa-arrow-left"></i>
        </button>
        <button class="nxt-btn"><i class="fa fa-arrow-right"></i></button>

        <div class="scrollable" style="gap:15px">
            @forelse ($freelancers as $freelancer)
            <a href="{{route('showFreelancerDetails',$freelancer->id)}}">
                <div class="freelancer " style="align-items:flex-start;">
                    <div class="image">
                        <img src="{{ asset("Admin3/assets/images/users/".$freelancer->profile_image) }}" alt="">
                    </div>
                    <div class="info px-2" >
                        <div class="name text-capitalize">{{ $freelancer->name }}</div>
                        <div class="rate">
                            <i class="fa fa-star"></i>
                            <div class="rate-precntage">
                                @if( App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count()>0)
                                {{round(App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->sum('rate')/  App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count(),1)}}
                            @else
  {{App\Models\Review::select('rate')->where('freelancer_id',$freelancer->id)->count()}}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
                @empty

                <p class=" w-100  text-center " style="height: 150px"> no freelancer</p>
                @endforelse
            
        </div>
    </div>
</div><!-- end freelnce -->

<!-- start about us -->
<div class="abouts pt-3">
    <div class="container py-3">
        <div class="section-header">
            <h2>about us</h2>
        </div>
        <div class="about-data">
            <div style=" border-image-width:10px;border-image: url('assets/images/navbg.png') 30 30 round; display:flex;align-items:center;justify-content:center;padding:20px"><img src="{{asset("assets/images/newlogo2.png")}}" alt=""></div>

            <div class="about-text ">
                {{ App\Models\AboutUs::first()->paragraph}}
            </div>
        </div>
    </div>
</div><!-- end about us -->


<!-- start contact us -->
<div class="contacts pt-3">
    <div class="container py-3">
        <div class="section-header">
            <h2>contact us</h2>
        </div>

        <div class="row">
            <div class="form-contact col-12 col-lg-6 col-md-6">
                <form action="">
                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="phone">phone number</label>
                        <input class="form-control w-100" type="text" placeholder="05XXXXXXXX">
                    </div>

                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="phone">subject</label>
                        <input  class="form-control w-100" type="text"placeholder="Subject">
                    </div>

                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="phone" >message</label>
                        <input class="form-control w-100" place-holder="Write your message here" type="text">
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill">send</button>
                    </form>
                </div>

                <div class="col-6 contact-img">
                    <img src="{{asset("assets/images/Messages-rafiki.png")}}" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")

@endsection
