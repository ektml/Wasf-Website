<!-- Modal -->
<div class="modal fade " id="sendofferforreservation{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">
                @if( $request->offer()->exists()&& $request->offer->first()->status=='reject')
              <form action="{{route('freelanc.reservation.editoffer',$request->id)}}" method="GET">
               
                @else

                <form action="{{route('freelanc.reservation.sendoffer',$request->id)}}" method="GET">

                @endif
    @csrf
        <div class="my-3" >
            <h5 class="font-size-15 mb-3">write your offer</h5>
            <input type="text" id="offer" class="form-control" name="offer" />
        </div>
    
    <div class="btn-contianer d-flex justify-between align-items-center">
   <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">send</button>
  
    </div>
   
   
  

   
  </form>
  
              </div>
          
          </div>
      </div>
  
          </div>
    
  