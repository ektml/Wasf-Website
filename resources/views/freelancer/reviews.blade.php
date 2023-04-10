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




</style>
@endsection

@section("nosearch","none !important")
@section("content")
<a class="addrequesticon" href="">
    <i class="fa-solid fa-plus"></i>
    </a>
<div class="reviews">
    <div class="container d-block">

        <div class="section-header px-4">
            <h2 class="text-black "> reviews <span class="text-black">(1234)</span></h2>

        </div>

        
    @forelse ( App\Models\Review::where('freelancer_id',auth()->user()->id)  as  $review )
    <div class="review freelanc ">

        <div class="image">
            <img src="{{asset("Admin3/assets/images/users/".App\Models\User::find($review->user_id)->profile_image)}}" alt="">
        </div>
        <div class="info">
            <div class="name">
            <span>{{App\Models\User::find($review->user_id)->name}}</span>
                <div class="rate">

                    
                   
                    @for ( $i=$review->rate ;$i>0; $i-- )
                           
                    <i class="fa fa-star active"></i>
                  
                    
                    @endfor
                    @for ($i=5-$review->rate ; $i>0; $i-- )
                    <i class="fa fa-star" style="color:#777"></i>
                        
                    @endfor

                </div>
            </div>
            <div class="txt">{{$review->pragraph}}</div>

        </div>
</div>
    @empty
        
    @endforelse
        <a href="" class=" text-center showmore">show more</a>
    </div>
</div>


@endsection

@section("js")
    
@endsection