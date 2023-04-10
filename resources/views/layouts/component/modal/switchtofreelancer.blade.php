<!-- in this page two Modal -->
<div class="modal fade modal-lg" id="switchtofreelancer" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h1 class=""  >switch your account</h1>
                    <p class="text-black-50">
                        Get a freelancer account with all features that help you to improve your work
                    </p>
                </div>

                <div class="row text-center">
                    <div class="feature d-flex flex-column justify-content-center align-items-center col-4">
                        <div class="images d-flex justify-content-between align-items-center">
                            <img src="{{asset("assets/images/Account-amico.png")}}" alt="">
                        </div>
                        <h3>Get free freelancer account</h3>
                    </div>

                    <div class="feature d-flex flex-column justify-content-center align-items-center col-4">
                        <div class="images d-flex justify-content-between align-items-center">
                            <img src="{{asset("assets/images/Mobile Marketing-pana.png")}}" alt="">
                        </div>
                        <h3>Deal immediately with your customer</h3>
                    </div>

                    <div class="feature d-flex flex-column justify-content-center align-items-center col-4">
                        <div class="images d-flex justify-content-between align-items-center">
                            <img src="{{asset("assets/images/Mobile apps-amico.png")}}" alt="">
                        </div>
                        <h3>Improve your work</h3>
                    </div>
                </div>

                <div class="btn-contianer d-flex flex-column justify-content-center align-items-center">
                <button type="button"  data-bs-target="#switchtofreelancersignup" data-bs-toggle="modal" class="btn  btn-modal  my-3 btn-model-primary ">start</button>
                <button class="btn text-black-50 " data-bs-dismiss="modal" type="button" >cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade modal-uk modal-lg " id="switchtofreelancersignup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>

            <div class="modal-body">
            <div class="text-center">
                <h1 class=""  >switch your account</h1>
                <p class="text-black-50">
                    Get a freelancer account with all features that help you to improve your work
                </p>
            </div>

            <form action="{{route('user.switchToFreelancer')}}" method="POST">
                <!-- phone input -->
                @csrf
                <div class=" mb-4 halfwidthinput">
                <label class="form-label" for="idnumber">ID number</label>
                <div class="">
                <input type="text" id="idnumber" class="form-control" name="id_number"  placeholder="**********"  value='{{old('id_number')}}'/>
                @error('id_number')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                </div>

                </div>
                <div class=" mb-5 halfwidthinput">
                <label class="form-label" for="br">Business register</label>
                <div class="">
                <input type="text" id="br" class="form-control" name="business_register"  placeholder="**********"  value='{{old('business_register')}}' />
                @error('business_register')
    <div class="alert alert-danger">{{ $message }}</div>
     @enderror
                </div>
                <span class="text-black-50">You can use "Ma'roof" number</span>
                </div>

                <div class="btn-contianer d-flex flex-column justify-content-center align-items-center">
                <button type="submit" class="btn  btn-modal  my-3 btn-model-primary">sign up</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
