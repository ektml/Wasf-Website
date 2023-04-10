<!-- Modal -->
<div class="modal fade modal-uk" id="signup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
               <h1 class="modal-title fs-5" >Sign up</h1>
                <form method="POST" action="{{ route('register') }}">
                  @csrf
          
  <!-- phone input -->
  <div class="form-outline mb-2 halfwidthinput">
    <label class="form-label" for="fullname">fullname</label>
    <div class="input-icon">
        <i class="fa-regular fa-user"></i>
    <input type="text" id="fullname" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" />
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    </div>
    
  </div>
  <div class="form-outline mb-2 halfwidthinput">
    <label class="form-label" for="phone">Phone number</label>
    <div class="input-icon">
        <i class="fa fa-mobile"></i>
    <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"value="{{old('phone')}}" name="phone" />
    @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
      @enderror


    </div>
    
  </div>
  <div class="form-outline mb-2 halfwidthinput">
    <label class="form-label" for="email">email</label>
    <div class="input-icon">
        <i class="fa-regular fa-envelope"></i>
    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"name="email" />
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    </div>
    
  </div>

  <!-- Password input -->
  <div class="form-outline mb-2 halfwidthinput">
    <label class="form-label" for="password">Password</label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
         <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"value="{{old('password')}}"name="password" /> 
         @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

   
    </div>
   
  </div>
  <div class="form-outline mb-2 halfwidthinput">
    <label class="form-label" for="confirm-pass">confirm password</label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
         <input type="password" id="confirm-pass" class="form-control" name="password_confirmation" /> 
         @error('password_confirmation')
         <div class="alert alert-danger">{{ $message }}</div>
         @enderror 
    </div>
   
  </div>
  <div class="form-outline mb-2 fullwidthinput d-flex ">

    <input type="checkbox" name="policy" id="policy" style="
    width: 20px;
    margin: 0 10px;
">
    <label class="form-label" for="policy" for="confirm-pass">By signing up you accept the <a href="#" class="privacy">Term of service</a>
       and <a href="#"class="privacy">Privacy policy</a>
       </label>
         
   
   
  </div>
   
    

  <!-- Submit button -->
  <div class="btn-contianer d-flex justify-between align-items-center">
 {{-- <button type="submit" class="btn  btn-modal  my-3 btn-model-primary">sign up</button> --}}
 <button  class="btn  btn-modal  my-3 btn-model-primary"
  type="submit">sign up</button>
 {{-- <button  class="btn  btn-modal  my-3 btn-model-primary"
 data-bs-target="#otp" data-bs-toggle="modal" type="button">sign up</button> --}}

  </div>
 

  <!-- Register buttons -->
  <div class="text-center">
    <p>have an account? 
      <button class="modal-color-text "data-bs-target="#login" data-bs-toggle="modal" type="button" >Log in</button></p>
  </div>
</form>

            </div>
           
        </div>
    </div>
</div>
</div>