<div class="modal offers fade  modal-uk pay" id="pay{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <h1>payment method</h1>
      <div class="d-flex align-items-center
      justify-content-center py-4">
        <div class="paytype visaicon">
            <i class="fa-brands fa-cc-visa"></i>
          <span>
            <i class="fa-solid fa-check"></i>
          </span>
        </div>
        <div class="paytype apayicon">
            
              <i class="fa-brands fa-apple-pay"></i>
          <span>
            <i class="fa-solid fa-check"></i>
          </span>
        </div>
        <div class="paytype active  walleticon">
         <i class="fa-solid fa-wallet"></i>
          <span>
            <i class="fa-solid fa-check"></i>
          </span>
        </div>
      </div>
   

      <div class="visa paycard">

        <div class="visaloader"></div>
        {{-- <form action="" method="POST">
          <input type="hidden" name="paytype" value="visa">
         
    
   <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="holder">holderholder name</label>
    
        
    <input type="text" id="holder" class="form-control" name="holder_name" />
   
  </div>
           <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="holder">Card number</label>
    
        
    <input type="text" id="holder" class="form-control" name="card_number" />
    
  </div>
           <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="holder">exp</label>
    
        
    <input type="text" id="holder" class="form-control" name="exp" />
    
  </div>
  <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="holder">cvv</label>
   
    <input type="text" id="holder" class="form-control" name="cvv" />
   
  </div>
      
  <div class="btn-contianer d-flex justify-content-center align-items-center">
    <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
   
     </div>
       
        </form> --}}
      </div>
      <div class="apay paycard">
        <form action="">


  <div class="btn-contianer d-flex justify-content-center align-items-center">
    <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
   
     </div>
       
        </form>
      </div>
      <div class="wallet  paycard" >
        @if($request->offer->first()->price >App\Models\User::find(auth()->user()->id)->wallet->total)

        
        <div class="wallet-empty" style="height:100%">
        <div class=" d-flex flex-column align-items-center justify-content-center w-100" style="height:100%" >

        
          <img src="{{asset('assets/images/wallet.png')}}" alt="wallet not enought" style="width:100px">

          <p style="color:#011C26;" class="text-center py-3">Your wallet is empty
            or haven't enough balance</p>
        </div>
      
      </div>
@else
<div class="wallet-pay">
  <form action="{{route('user.reservation.pay',$request->id)}}" method="GET" class=" d-flex flex-column justify-content-end" >
    @csrf
    <input type="hidden" name="paytype" value="wallet">
  

    <div class="btn-contianer d-flex justify-content-center align-items-center">
      <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
     
       </div>

    </form>
</div>

     @endif   

       
     </div>
       
       
      </div>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>



  <!-- Modal -->
<div class="modal fade " id="paydone" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              
                
            </div>
            <div class="modal-body ">
            <div class="d-flex flex-column justify-content-center align-items-center py-3 my-3">
              
            
           
    
              <div class="position-relative checkemo">
                  <div class="checkemoorange"></div>
                  <div class="checkemowhite">
                      <i class="fa-solid fa-check"></i>
                  </div>
              </div>
           
              <h4 class="inprogress">Your reservation confirmed successfully</h4>

          </div>
      
    

 
 



            </div>
        
        </div>
    </div>

</div>