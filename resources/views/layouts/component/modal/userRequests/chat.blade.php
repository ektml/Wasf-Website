<div class="offcanvas offcanvas-end chat" tabindex="-1" id="chat{{$request->id}}" aria-labelledby="offcanvasRightLabel" data-id={{$request->id}}  data-type='
    @if(isset($request->type) && in_array($request->type,['public','private' ]))
   request 
    @else
   reservation 
    @endif
    '
    data-to="
    @if(auth()->user()->id ==$request->user_id)
    {{$request->freelancer_id}}

    @else
    {{$request->user_id}}
    @endif
    "
    >
    <div class="offcanvas-header d-flex">
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <div class="d-flex flex-row-reverse chat-head">
                @if(auth()->user()->id ==$request->user_id) 
                <img src="{{asset("Admin3/assets/images/users/".App\Models\User::where('id', $request->freelancer_id)->first()->profile_image)}}" alt="" class="rounded-circle avatar-sm">
                <div class="d-flex flex-column">
                    <h5 class=""><a href="#" class="text-dark">
                       {{App\Models\User::where('id',$request->freelancer_id)->first()->name}}
                  
                        
                    @else
                    
                    <img src="{{asset('Admin3/assets/images/users/'.App\Models\User::where('id',$request->user_id)->first()->profile_image)}}" alt="" class="rounded-circle avatar-sm">
                    <div class="d-flex flex-column">
                        <h5 class=""><a href="#" class="text-dark">
                    
                            {{App\Models\User::where('id',$request->user_id)->first()->name}}
                    @endif
                    
                    
                    </a>
                </h5>
                    

                    @if($request->status == 'Pending')
                    <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'In Process')
                    <p class="status inprogress" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Waiting')
                    <p class="status inprogress" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Finished')
                    <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status}}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status== 'Completed')
                    <p class="status gray text-black" data-color="C4C3C3">{{$request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @endif
                </div>

            </div>
        
        
           
        
      
      
    </div>
    <div class="offcanvas-body" >
      

  <div class="conversation">
    
    <div class="tenor-gif-embed" data-postid="5345658" data-share-method="host" data-aspect-ratio="1" data-width="100%" data-hide-gif-attribution="true">
        <script type="text/javascript" async src="https://tenor.com/embed.js"></script></div>
    {{-- <div class="rightcont">
        <div class="chat-txt rightside">
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed eum officia at, nulla qui sequi vitae adipisci quibusdam assumenda ea ad voluptatibus sapiente aliquam 
            </p>
            <span>5:30</span>
        </div>
    </div>
    
 <div class="leftcont">
    <div class=" chat-txt leftside">
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed eum officia at, nulla qui sequi vitae adipisci quibusdam assumenda ea ad voluptatibus sapiente aliquam 
        </p>
        <span>5:30</span>
    </div>
 </div> --}}
   
  </div>
       

   <div class="control">
    <div>
      <form action="">
       
      <button class="sendfile">
        <i class="fa-solid fa-paperclip"></i>
      </button>
      </form>

    </div>
    
    {{-- <form class="sendmessage  senmessage{{$request->id}}" onsubmit="event.preventDefault(); "> --}}
    <form class="sendmessage" onsubmit="event.preventDefault(); return sendmessage(this);">
        @csrf
        <input type="hidden" value="{{$request->id}}" name="request_id">
        <input type="hidden" value='
        @if(isset($request->type) && in_array($request->type,['public','private' ]))
       request 
        @else
       reservation 
        @endif
        '  name="type">
        <input type="hidden" value="@if(auth()->user()->id ==$request->user_id)
        {{$request->freelancer_id}}
        @else
        {{$request->user_id}}
        @endif" name="to">
       <input type="text" class="rounded-pill  messageinput"  name="message">
        <button class="rounded-circle sendtext" type="submit">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
    
   </div>

    </div>
  </div>