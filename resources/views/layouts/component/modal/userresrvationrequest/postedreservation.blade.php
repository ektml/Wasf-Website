<!-- Modal -->
<div class="modal fade suredelete" id="posted{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">
            <h5 style="font-weight:900;font-size:16px"><span>{{ App\Models\User::where('id', $request->freelancer_id)->first()->name}}</span>   want to delay your reservation
to
<span>{{$request->delay->first()->delayto}}</span>

</h5>
<p style="font-weight:300; word-break:keep-all"> <span style="font-weight:900">the reason is</span> {{$request->delay()->first()->reason}}</p>

<p style="font-weight:300; word-break:keep-all">Do you want to accept new schedule?</p>
<div class="btn-contianer d-flex  justify-content-between  align-items-center my-3">
            
      <form method="POST" action="{{route('user.reservation.cancel',$request->id)}}">
        @csrf
      
            <button class="btn  btn-modal modal-color-text border-0" type="submit" style="width:170px; height:39px;" >Reject</button>
           
   

  </form>
      <form method="POST" action="{{route('user.reservation.acceptdelay',$request->id)}}">
        @csrf
      
            <button class="btn  btn-modal btn-model-primary" type="submit"style="width:170px; height:39px;"  >Accept</button>
           
   

  </form>
</div>
              </div>
          
          </div>
      </div>
  
          </div>
    
  