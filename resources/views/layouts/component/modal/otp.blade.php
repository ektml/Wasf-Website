{{-- <!-- Modal -->
<div class="modal fade modal-uk" id="otp" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                 
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">
                 <h1 class="modal-title fs-5" >Enter verification code</h1>
                  <form method="POST" action="">
                    @csrf
    <!-- phone input -->
    <div class="form-outline mb-2halfwidthinput ">
        <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 >
        <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 >
        <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 >
        <input class="otp" type="text" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 >
     
      </div>
      
 
   
  
 
   
    
     
      
  
    <!-- Submit button -->
    <div class="btn-contianer d-flex justify-between align-items-center">
   <button type="submit" class="btn  btn-modal  my-3 btn-model-primary">verify</button>
  
    </div>
   
  
    <!-- Register buttons -->
    <div class="text-center">
      <p>did't receive the code 
        <button class="modal-color-text "data-bs-target="#login" data-bs-toggle="modal" type="button" >00:59</button></p>
    </div>
  </form>
  
              </div>
          </div>
          </div>
      </div>
  </div>
  </div> --}}




  <div class="modal fade" id="otp" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h1 class="modal-title" >Enter verification code</h1>
            <p class="modal-title-discrip">We sent you a verification code via SMS.</p>
            <form method="POST" action="">
              @csrf
<!-- phone input -->

<div class="d-flex otpinupts ">

    <div class="form-outline inutpfiledotp  mb-2 halfwidthinput  ">
        <input class="otp" type="text"   maxlength=1 >
      
      </div>
      <div class="form-outline mb-2 halfwidthinput  inutpfiledotp ">
      
        <input class="otp" type="text"  maxlength=1 >
      
      
      </div>
      <div class="form-outline mb-2 halfwidthinput inutpfiledotp  ">
       
        <input class="otp" type="text"  maxlength=1 >
        
      
      </div>
      <div class="form-outline mb-2 halfwidthinput inutpfiledotp  ">
        
        <input class="otp" type="text"  maxlength=1 >
      
      </div>
</div>

<!-- Submit button -->
<div class="btn-contianer d-flex justify-content-center ">
<button type="submit" class="btn  btn-modal  my-3 btn-model-primary">verify</button>

</div>


<!-- Register buttons -->
<div class="text-center">
<p>did't receive the code 
  <button class="modal-color-text "data-bs-target="#login" data-bs-toggle="modal" type="button" >00:59</button></p>
</div>
</form>
        </div>
        
      </div>
    </div>
  </div>

