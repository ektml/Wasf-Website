<!-- Modal -->
<div class="modal fade suredelete" id="surdeletereservation{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">
      <form method="POST" action="{{route('user.reservation.cancel',$request->id)}}">
        @csrf
        <h1 class="modal-title fs-5" >are you sure from cancling this reservation</h1>
  
        
       

  
        
   
        <div class="btn-contianer d-flex  justify-content-between  align-items-center my-3">
            
            <button class="btn  btn-modal modal-color-text border-0"type="button" class="btn btn-secondary" data-bs-dismiss="modal">move back</button>
            <button class="btn  btn-modal btn-model-primary" type="submit" >cancel reservation</button>
           
    </div>
   
   
  

   
  </form>
  
              </div>
          
          </div>
      </div>
  
          </div>
    
  