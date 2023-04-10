<!-- Modal -->
<div class="modal modal-uk fade " id="userrejectreservationoffer{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body p-3">
      <form>
        <h1 class="modal-title fs-5  top-0"  style="text-align: center;">By rejecting this offer the freelancer can send you another one
            </h1>
            <p class="text-black-50" style="text-align: center;"> Do you want to receive new offer or cancel whole reserve? </p>
  
        
       

  
        
   
        <div class="btn-contianer d-flex flex-lg-row flex-column-reverse   justify-content-between  align-items-center my-3">
            <form action="{{route('user.reservation.cancel',$request->id)}}" method="POST">


                <button type="submit" class="btn  btn-modal modal-color-text border-0">cancel reservation</button>

            </form>
            <form action="{{route('user.reservation.rejectOffer',$request->id)}}" method="POST">
            @csrf
                <button class="btn  btn-modal btn-model-primary" type="submit">recive new offer</button>

            </form>
           
           
    </div>
   
   
  

   
  </form>
  
              </div>
          
          </div>
      </div>
  
          </div>
    
  