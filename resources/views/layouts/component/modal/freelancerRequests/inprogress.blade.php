<div class="modal offers fade" id="freelancerorderinprogress{{$request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
            
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
          <div class="div d-flex justify-content-start px-4">
              <div class="d-flex flex-column">
                <h3 class="mb-0 font-bold">{{$request->random_id}}</h3>
                <span class="inprogress">{{$request->status}}</span>
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
  
          <div class="d-flex flex-column px-3 ">
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
         
          <div class="btn-contianer d-flex flex-column justify-between align-items-center my-3">
           
          <form action="{{route('freelanc.finishrequest',$request->id)}}" method="GET">

            <button class=" btn-accept border-0 btn-modal rounded-pill mx-2"type="submit" >Finish</button>
          
          </form>
            
          </div>
             
         

       
        </div>
       
      </div>
      
    </div>
<div  style="position:fixed ; bottom:0;right:0; font-size:30px">
   
        <button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{$request->id}}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
        
                
 
</div>
    
  </div>




 