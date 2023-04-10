<div class="modal offers fade" id="freelancerreservationcompleted{{ $request->id }}" aria-hidden="true"  aria-labelledby="staticBackdropLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="div d-flex justify-content-start px-4">
                <div class="d-flex flex-column">
                    <h3 class="mb-0 font-bold">{{ $request->random_id }}</h3>
                    <span class="text-black">{{ $request->status }}</span>
                </div>

                <div class="align-slef-end" style="flex-grow: 1;display: flex;align-items: center;justify-content: flex-end;">
                    <a  href="#" data-bs-toggle="offcanvas" data-bs-target="#chat" aria-controls="offcanvasRight">
                        <i class="uil-comments-alt"  style="font-size:20px;"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex flex-column px-5">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">Customer Name</p>
                    <p class="fw-900 mb-0 text-black">{{ App\Models\User::where('id', $request->user_id)->first()->name }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">Occasion</p>
                    <p class="fw-900 mb-0 text-black">{{ $request->occasion }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">Due Date</p>
                    <p class="fw-900 mb-0 text-black">{{date_format(new dateTime($request->date_time),'d/m/Y')}}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="mb-0">Time</p>
                    <div class="d-flex">
                        <span class="text-black-50 mx-1">From</span>
                        <p class="fw-900 mb-0 text-black">{{ \Carbon\Carbon::parse($request->from)->format('h:i A') }}</p>
                        <span class="text-black-50 mx-1">To</span>
                        <p class="fw-900 mb-0 text-black">{{ \Carbon\Carbon::parse($request->to)->format('h:i A') }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">Location</p>
                    <p class="fw-900 mb-0 text-black"><i class="fa fa-location"></i>{{ $request->location }}</p>
                </div>

                <h5 class="text-black border-top pt-2">Total price</h5>
                <div class="d-flex justify-content-between">
                    <p class=" mb-0">Price</p>
                    <p class="fw-900 mb-0 text-black">{{$request->offer->first()->price}}<span class="text-black-50 mx-1">SR</span></p>
                </div>


                @if(empty($request->review->first()))
                <div class="btn-contianer d-flex flex-column justify-between align-items-center my-3">
                    <button class="btn btn-modal btn-model-primary" type="button" data-bs-toggle="modal" data-bs-target="#review{{$request->id}}">Rate</button>
                </div>
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

    
</div>
<div  style="position:fixed ; bottom:0;right:0; font-size:30px"><button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{$request->id}}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
</div>
</div>
