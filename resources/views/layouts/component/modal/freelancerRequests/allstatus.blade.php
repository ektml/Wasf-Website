<div class="modal offers fade" id="freelancerallstatus{{$request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
            
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
          <div class="div d-flex justify-content-start px-4">
              <div class="d-flex flex-column">
                <h3 class="mb-0 font-bold">{{$request->random_id}}</h3>

                
                @if ( $request->status =='Cancel by customer')
                <span class="cancel  text-danger">cancel</span>
                @elseif($request->status =='Finished')
                <span class="finish ">{{$request->status}}</span>
                @elseif($request->status =='Completed')
                <span class="text-black text-warning">{{$request->status}}</span>
                @elseif($request->status =='Pending')
                <span class="text-black-50 text-warning">{{$request->status}}</span>
                @else
                
                @endif
                {{-- <span class="inprogress">{{$request->status}}</span> --}}
              </div>
              <div class="align-slef-end" style="
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: flex-end;
">
<a  href="#" data-bs-toggle="offcanvas" data-bs-target="#chat" aria-controls="offcanvasRight">
    <i class="uil-comments-alt"  style="font-size:20px;"></i>
</a>


              </div>
          </div>
          <div class="d-flex flex-column px-5">
            <div class="d-flex justify-content-between">
                <p class=" mb-0" >{{__('request.customer name')}}</p>
                <p class="fw-900 mb-0">
               {{APP\Models\User::find($request->user_id)->name}}
            </div>
            <div class="d-flex justify-content-between">
                <p class=" mb-0" >{{__('request.category')}}</p>
                <p class="fw-900 mb-0">
               @if (App::getLocale() =="ar")
               {{App\Models\Category::where('id', $request->category_id)->first()->title_ar }}</p>
               @else
               {{App\Models\Category::where('id', $request->category_id)->first()->title_en }}</p>
               @endif
            </div>

            <div class="d-flex justify-content-between">
                <p class=" mb-0">{{__('request.service')}}</p>
                <p class="fw-900 mb-0">
                    @if(App\Models\Service::where('id', $request->service_id)->exists())
                    @if (App::getLocale() =="ar")
                    {{ App\Models\Service::where('id', $request->service_id)->first()->service_ar }}</p>
                    @else
                    {{ App\Models\Service::where('id', $request->service_id)->first()->service_en }}</p>
                    @endif
                    @endif
  
            </div>

            <div class="d-flex justify-content-between">
                <p class=" mb-0" >{{__('request.title')}}</p>
                <p class="fw-900 mb-0">{{ $request->title }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <p class=" mb-0">{{__('request.due date')}}</p>
                <p class="fw-900 mb-0 ">{{ $request->due_date }}</p>
            </div>
          </div>
          <div class="d-flex flex-column px-3 bg-blue ">
            <span class="flex-grow-1 fs-5 font-bold ">{{__('request.description')}}</span>
            <p class="flex-grow-1">{{ $request->description }}</p>
          </div>
  
          <div class="d-flex flex-column px-3">
            <p class="fs-5 font-bold">attachment</p>
            <div class="d-flex flex-column px-2 ">
                @foreach (  $request->file()->get() as $file)
                <a class="file d-flex mb-2" href="{{route('download',$file->url)}}">
                    <div class="details d-flex ">
                        <div class="img">
                            <i class="fa-regular fa-file-word"></i>
                        </div>

                        <div class="info">
                            <p class="mb-0">{{ $file->name }}</p>
                            <div class="size">{{ $file->size}}kB .{{ $file->type }}</div>
                        </div>
                    </div>
                </a>  <!-- end offerPending modal -->
                @endforeach
                </div>
        </div>
        @if($request->status =='Pending' || $request->status =='Reject')
        <div class="px-2">
            <h5 class="text-black border-top mt-2 pt-2 ">Total price</h5>
        <div class="d-flex justify-content-between">
            <p class=" mb-0">price</p>
       
            @if($request->offer->where('freelancer_id',auth()->user()->id)->first()!=null)
        
            <p class="fw-900 mb-0 text-black">
                <button  data-bs-toggle="modal" type="button" data-bs-target="#sendofferforrequest{{$request->id}}"
                style="
                 border-radius: 50%;
                 padding: 1px 5px;
                 background-color: #fff;
                 border: none; "
                
                 ><i class="fa-solid fa-pen fa-bounce" style="color: #eb3d1e;"></i></button>
                 {{$request->offer->where('freelancer_id',auth()->user()->id)->first()->price}} 
                 
                 <span class="text-black-50 mx-1">SR</span></p>
            @endif
        </div>
        </div>

        <div class="btn-contianer d-flex flex-column justify-content-center align-items-center my-3">
          
            <form action="{{route('freelanc.requests.cancel',$request->id)}}" method="GET">
                @csrf
    
    
                  <button class="btn-cormoz btn-modal border-0"type="submit" >Cancel</button>
                </form>
           
           
             </div>

        @endif

        @if(empty($request->review->first()))
       
        @else
        <div class="myreview flex-column py-3">
            <div class="d-flex">
                <h5 class="flex-grow-1 fw-900">your review</h5>
                
                <div class="d-flex flex-grow-1 justify-content-end align-items-center">

                    @for ( $i=$request->review->first()->rate ;$i>0; $i-- )
                   
                    <i class="fa fa-star active"></i>
                  
                    
                    @endfor
                    @for ($i=5-$request->review->first()->rate ;$i>0; $i-- )
                    <i class="fa fa-star"></i>
                        
                    @endfor
                   
                </div>
            </div>

            <p>
                {{$request->review->first()->pragraph}}
            </p>
        </div>

        @endif

       
        </div>
       
      </div>
      
    </div>
<div  style="position:fixed ; bottom:0;right:0; font-size:30px">
   
        <button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{$request->id}}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
        
                
 
</div>
    
  </div>




 