<div class="modal  modal-uk  fade" id="editfreelancerprofile" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h1 class="modal-title fs-5">{{__('freelancerprofile.edit profile')}}</h1>
                <form action="{{ route('freelanc.updateFreelancerProfile', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-outline imgcontainer mb-2">
                        <label class="profileimage form-label text-center  rounded-circle" for="imageprofile">
                            <img id="photoprofilefreelacer" name="profile_image" class="rounded-circle"
                                name="profile_image"
                                src="{{ asset("Admin3/assets/images/users/".Auth::user()->profile_image) }}" alt="">
                            <div class=" layout d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </label>
                        <input type="file" id="imageprofile" name="profile_image"
                            onchange="document.getElementById('photoprofilefreelacer').src = window.URL.createObjectURL(this.files[0])" />
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="fullname2">{{__('translate.fullname')}}</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" id="fullname2" class="form-control" name="name"
                                value="{{ Auth::user()->name }}" />
                        </div>
                        @error("name")
                        <span class="error-message"> {{$message}}</span>

                        @enderror
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="phone2">{{__('translate.Phone number')}}</label>
                        <div class="input-icon">
                            <i class="fa fa-mobile"></i>
                            <input type="text" id="phone2" class="form-control" name="phone"
                                value="{{ Auth::user()->phone }}" />
                            @error("photo")
                            <span class="error-message"> {{$message}}</span>

                            @enderror
                        </div>
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="email2">{{__('translate.email')}}</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email2" class="form-control" name="email"
                                value="{{ Auth::user()->email }}" />
                            @error("email")
                            <span class="error-message"> {{$message}}</span>

                            @enderror
                        </div>
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="bio">{{__('translate.Bio')}}</label>
                        <input type="text" id="bio" class="form-control" name="bio" value="{{ Auth::user()->bio }}" />
                        @error("bio")
                        <span class="error-message"> {{$message}}</span>

                        @enderror
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="id_number"> {{__('translate.ID number')}}</label>
                        <input type="text" id="id_number" class="form-control" name="id_number"
                            value="{{ Auth::user()->id_number }}" />
                        @error("id_number")
                        <span class="error-message"> {{$message}}</span>

                        @enderror
                    </div>

                    <div class="form-outline mb-2 halfwidthinput">
                        <label class="form-label" for="bs"> {{__('translate.Business register')}}</label>
                        <input type="text" id="email2" class="form-control" name="business_register"
                            value="{{ Auth::user()->business_register }}" />
                        @error("business_register")
                        <span class="error-message"> {{$message}}</span>

                        @enderror

                    </div>

                    <!-- Submit button -->
                    <div class="btn-contianer d-flex flex-column-reverse flex-lg-row justify-content-space align-items-center mt-3">
                        <button class="modal-color-text " data-bs-target="#changepassord" data-bs-toggle="modal"
                            type="button">{{__('translate.change password')}}</button>
                        <button type="submit"
                            class="btn  btn-modal  my-3 btn-model-primary">{{__('translate.update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="changepassord" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="modal-title fs-5"> {{__('translate.edit password')}}</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="currentpassword">{{__('translate.current password')}}</label>
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="currentpassword" class="form-control" name="currentpassword" />
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="newpassword">{{__('translate.New password')}}</label>
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" id="newpassword" class="form-control" name="password" />
                            </div>

                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="confirm-pass2">
                                {{__('translate.confirm new password')}}</label>
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" id="confirm-pass2" class="form-control"
                                    name="confirm-password" />
                            </div>

                        </div>

                        <!-- Submit button -->
                        <div class="btn-contianer d-flex justify-content-center align-items-center">
                            <button type="submit"
                                class="btn  btn-modal  my-3 btn-model-primary">{{__('translate.update')}}</button>

                        </div>


                        <!-- Register buttons -->
                        <div class="text-center">
                            <button class="modal-color-text
        " data-bs-dismiss="modal" aria-label="Close" type="button">{{__('translate.cancel')}}</button></p>
                        </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>