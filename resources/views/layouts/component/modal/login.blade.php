<!-- Modal -->
<div class="modal fade modal-uk" id="login" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <h1 class="modal-title fs-5" >Log in</h1>
  <!-- phone input -->
  <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="phone1">Phone number</label>
    <div class="input-icon">
        <i class="fa fa-mobile"></i>
    <input type="text" id="phone1" class="form-control" name="phone" />
    </div>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4 halfwidthinput">
    <label class="form-label" for="password1">Password</label>
    <div class="input-icon">
        <i class="fa fa-light fa-lock"></i>
         <input type="password" id="password1" class="form-control" name="password" />
        <button class="modal-color-text text-black-50 forget-pass" data-bs-target="#forgetpassword"  type="button"
        data-bs-toggle="modal" >Forgot password?</button>
    </div>
  
  </div>

  <!-- 2 column grid layout for inline styling -->
  

    
      <!-- Simple link -->
      
    

  <!-- Submit button -->
  <div class="btn-contianer d-flex justify-content-center align-items-center">
 <button type="submit" class=" border-0 btn-modal  my-3 btn-model-primary ">Log in</button>

  </div>
 
 

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member?  <button class="modal-color-text "data-bs-target="#signup" data-bs-toggle="modal" type="button" >sign up</button></p>
    
  </div>
</form>

            </div>
        
        </div>
    </div>

        </div>
  
