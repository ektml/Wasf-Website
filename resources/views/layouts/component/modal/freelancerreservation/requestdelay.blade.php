<div id="requestdelay{{ $request->id }}" class="modal offers fade" aria-hidden="true"   aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
    
        <div class="modal-header ">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    
        <div class="modal-body">
        
    <div class="row">
        <div class="col-6">
            <h5>This option is depend on
                customer acceptation </h5>
        </div>
    </div>
      
<form action="{{route('freelanc.reservation.postReservation',$request->id)}}"  method="POST">

    @csrf
        <div class="row">

            <div class="col-lg-6 col-md-6 col-12 ">
            <p class="delay-title">Delay to</p>


            <input type="date" name="delayto"min='{{now()->todatestring()}}' >


                
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <p class="delay-title">Reasons</p>


                <textarea name="reason" id="" cols="20" rows="8" class="delay"placeholder="max 50 words" ></textarea>
                
            </div>
        </div>
        <div class="btn-contianer d-flex flex-column-reverse  flex-lg-row   align-items-center my-3  gap-2 gap-lg-0" >
            
            <button class="btn  btn-modal modal-color-text border-0"style="width:196px;height:39px">move back</button>
            <button class="btn  btn-modal btn-model-primary"style="width:196px;height:39px" type="submit">send request</button>
           
    </div>
    </form>
    </div>
    </div>
    </div>
    
        <div  style="position:fixed ; bottom:0;right:0; font-size:30px">
            <button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{$request->id}}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
        </div>
    </div>
    
    