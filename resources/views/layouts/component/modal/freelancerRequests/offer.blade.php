<!-- Modal -->
<div class="modal fade " id="sendofferforrequest{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">

      
        @if( $request->offer()->exists()&& $request->offer->where('freelancer_id',auth()->user()->id)->first())
        <form action="{{route('freelanc.requests.editoffer',$request->id)}}" method="POST">
         
          @else

          <form  action="{{route('freelanc.sendoffer',$request->id)}}" method="POST">

          @endif
        @csrf

        <input type="hidden" name="type" value='
        @if(isset($request->type) && in_array($request->type,['public','private' ]))
       request 
        @else
       reservation 
        @endif
        ' />
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
    
  