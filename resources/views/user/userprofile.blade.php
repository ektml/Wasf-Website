@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
profile page
@endsection
@section("header")
@endsection


@section("css")

@endsection


@section("content")
@include("layouts.component.modal.updateuserprofile")
@include("layouts.component.modal.cashout")

<div class="userprofile">
    <div class="container">
        <div class="section-header ">
            <h2>user profile </h2>
        </div>

        <div class="row personinfo">
            <div class="col-6">
                <div class="d-flex">
                    <div class="profimg">
                        <img src="{{ asset("Admin3/assets/images/users/".Auth::user()->profile_image) }}" alt="" class="rounded-circle">
                    </div>

                    <div class="d-flex flex-column px-3">
                        <h3 class="fw-900 text-black">{{ Auth::user()->name }}</h3>
                        <span class="text-black-50">{{ Auth::user()->email }}</span>
                        <span class="text-black-50">{{ Auth::user()->phone }}</span>
                    </div>
                </div>
            </div>

            <div class="col-6 d-flex justify-content-end">
                <button  class="btn1" data-bs-toggle="modal" href="#edituserprofile" role="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        </div>

        <div class="waltinfo d-flex flex-sm-wrap mb-5">
            <div class="flex-grow-1 cash">
                <div class="section-header ">
                    <h2>wallet </h2>
                </div>

                <div class="hoverdiv d-flex justify-content-around align-items-baseline py-3" >
                    <div class="wall d-flex flex-column">
                        <p class="total">Total</p>
                        <P class="number">{{$user->wallet->total}}<span>
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
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                 
  @forelse ( $user_wallet_hestory as $wh )
    
  <div class="accordion-item">
    <h2 class="accordion-header d-flex align-items-center justify-content-between p-2" id="panelsStayOpen-headingOne">
        <div  class= "info d-flex flex-column">
        <p class="text-black-100 p-0 m-0">{{$wh->status}}</p>
        <p class="text-black-50">{{ date_format($wh->created_at,'Y-m-d ')}}</p>
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
</div>
</div>
</div>


<div class="files d-flex">
    <div class="section-header width-0 p-2">
        <h2>Files</h2>
    </div>

    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#newfile" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
           <span class="px-2">New</span>
      
            </button>
          </h2>

          <div id="newfile" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body d-flex flex-column">

                
          @foreach ($files_current as $curfile )
          <div class="file d-flex ">
            <div class="details d-flex ">
                <div class="img">
                    @if($curfile->type=='word')
                    <i class="fa-regular fa-file-word"></i>
                    @elseif($curfile->type=='pptx' ||$curfile->type=='ppt')
                    <i class="fa-regular fa-file-powerpoint"></i>
                    @elseif($curfile->type =='pdf')
                    <i class="fa-regular fa-file-pdf"></i>
                     @else
                     <i class="fa-regular fa-file"></i>
                    @endif
                </div>
                <div class="info">
                    <h3>
                        {{$curfile->name}}

                    </h3>
                    <div class="size">
                        {{$curfile->size}} . {{$curfile->type}}
                    </div>
                </div>

            </div>
            <div class="tool">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>
        </div>
          @endforeach
             
      
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#last-monthfile" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
            <span class="px-2"> Last month</span>
            </button>
          </h2>
          <div id="last-monthfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
                @foreach ($files_lastmonth as $lastfile )
                <div class="file d-flex ">
                  <div class="details d-flex ">
                      <div class="img">
                        @if($lastfile->type=='word')
                        <i class="fa-regular fa-file-word"></i>
                        @elseif($lastfile->type=='pptx' ||$lastfile->type=='ppt')
                        <i class="fa-regular fa-file-powerpoint"></i>
                        @elseif($lastfile->type =='pdf')
                        <i class="fa-regular fa-file-pdf"></i>
                         @else
                         <i class="fa-regular fa-file"></i>
                        @endif
                      </div>
                      <div class="info">
                          <h3>
                              {{$lastfile->name}}
      
                          </h3>
                          <div class="size">
                              {{$lastfile->size}} . {{$lastfile->type}}
                          </div>
                      </div>
      
                  </div>
                  <div class="tool">
                      <i class="fa-solid fa-ellipsis-vertical"></i>
                  </div>
              </div>
                @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#oldfile" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
            <span class="px-2"> Older</span>
            </button>
          </h2>
          <div id="oldfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                @foreach ($files_old as $lastfile )
                <div class="file d-flex ">
                  <div class="details d-flex ">
                      <div class="img">
                      @if($lastfile->type=='word')
                     <i class="fa-regular fa-file-word"></i>
                     @elseif($curfile->type=='pptx' ||$curfile->type=='ppt')
                     <i class="fa-regular fa-file-powerpoint"></i>
                     @elseif($lastfile->type =='pdf')
                     <i class="fa-regular fa-file-pdf"></i>
                      @else
                      <i class="fa-regular fa-file"></i>
                     @endif
                      </div>
                      <div class="info">
                          <h3>
                              {{$lastfile->name}}
      
                          </h3>
                          <div class="size">
                              {{$lastfile->size}} . {{$lastfile->type}}
                          </div>
                      </div>
      
                  </div>
                  <div class="tool">
                      <i class="fa-solid fa-ellipsis-vertical"></i>
                  </div>
              </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>

@endsection

@section("js")

@endsection
