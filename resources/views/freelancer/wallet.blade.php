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
  .files{
    padding-top:30px;
    padding-bottom:30px;
  }
</style>
@endsection


@section("content")
  
<div class="files">
    <div class="container">
        <div class="waltinfo d-flex ">

            <div class="flex-grow-1 cash">
                 <div class="section-header ">
            <h2>wallet </h2>
        </div>
                <div class="hoverdiv d-flex justify-content-around align-items-baseline py-3" >
                    <div class="wall d-flex flex-column">
                        <p class="total">total</p>
                        <P class="number" style="font-size:37px">{{$total_wallet}}<span>
                            SR
                        </span>
                            </P>
                    </div>
                    <button class="btn" data-bs-target="#cashout" data-bs-toggle="modal" type="button">cashout</button>
                </div>
            </div>
            <div class="flex-grow-1 hestory">
                 <div class="section-header ">
            <h2>wallet history </h2>
        </div>
        <div class="hest mx-2">
             
{{--  --}}

<div class="accordion" id="accordionPanelsStayOpenExample">


  @forelse ( $user_wallet_hestory as $wh )
    
  <div class="accordion-item">
    <h2 class="accordion-header d-flex align-items-center justify-content-between p-2" id="panelsStayOpen-headingOne">
        <div  class= "info d-flex flex-column">
        <p class="text-black-100 p-0 m-0">{{$wh->status}}</p>
        <p class="text-black-50">{{date_format(new dateTime($wh->created_at),'d/m/Y ')}}</p>
        </div>
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#refund{{$wh->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <div class="number">

          @if ($wh->user_id == auth()->user()->id && $wh->status !='refund')
             
             -

          @else
            +
          @endif
            
            <span >{{$wh->total}}</span>
            <span>RS</span>
        </div>
      </button>
    </h2>
    <div id="refund{{$wh->id}}" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
        <div style="max-width:100%">



        

        </div>
      </div>
    </div>
  </div>

  @empty
    
  @endforelse
  
 


</div>


            {{--  --}}
        </div>
            </div>

        </div>
   
    </div>
</div>

@endsection

@section("js")
    
@endsection