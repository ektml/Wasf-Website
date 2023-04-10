<!-- Modal -->
<div class="modal modal-uk fade" id="cashout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <div class="modal-body">

        <form method="POST" action="{{ route('register') }}">
            @csrf
                 <h1 class="modal-title fs-5" >Cash out</h1>
      <div class=" seeamount mb-3">
      <p>cashout Amount</p>
      <div class="d-flex justify-content-around">
  
          <div class="text-black-50">

            <input  type="number" value="0">
              
          </div>
          <button id="seeamount" class="btn-noborder">All</button>
      </div>
  </div>

                    
  
    <div class=" mb-2">
      <label class="form-label" for="bankname">Bank name</label>
      <div class="">
      <input type="text" id="bankname" class="form-control" name="bankname" />
      </div>
      
    </div>
    <div class=" mb-2">
      <label class="form-label" for="accountnumber">Account number</label>
      <div class="">
      <input type="text" id="accountnumber" class="form-control" name="accountnumber" />
      </div>
      
    </div>
    <div class=" mb-2">
      <label class="form-label" for="iban">IBAN</label>
      <div class="">
      <input type="text" id="iban" class="form-control" name="iban" />
      </div>
      
    </div>
  
       <!-- Submit button -->
    <div class="btn-contianer d-flex justify-content-between align-items-center">
   <button type="submit" class="btn  btn-modal  my-3 btn-model-primary">Transfer</button>
  
    </div>
   
  
    <!-- Register buttons -->
    <div class="text-center">
        <button class="modal-color-text
        "data-bs-dismiss="modal" aria-label="Close"type="button" >cancel</button></p>
    </div>
  </form>
    </div>
  
  
  
  
    </div>
      </div>
    </div>