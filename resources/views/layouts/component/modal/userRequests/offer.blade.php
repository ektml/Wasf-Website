{{-- freelancers offers modal --}}
<div id="freelaceroffers{{$request->id}}" class="modal offers fade freelaceroffers"  data-id= "{{$request->id}}"aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="offercontainer modal-body d-flex flex-column justify-content-arounds align-items-center"  id="offercontainer{{$request->id}}">

            
            <div class="tenor-gif-embed" data-postid="5345658" data-share-method="host" data-aspect-ratio="1" data-width="100%" data-hide-gif-attribution="true">
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script></div>
            
            {{-- <div class="freelanceroffer ">
                <div class=" d-flex ">
                    <div class="img">
                        <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                    </div>

                    <div class="info d-flex flex-column">
                        <h5 class="mb-0">Omar</h5>
                        <p class="mb-0"><span style="font-weight:600" class="mb-0 ">750</span> <span style="font-size:12px;color:#777">Rs</span>
                        </p>

                        <div class="d-flex">
                            <div class="d-flex align-items-baseline ">
                                <i class="fa-solid fa-star"></i>
                                <p class="mb-0">4,5</p>
                            </div>

                            <div class="d-flex align-items-baseline px-2">
                                <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                                <p class="mb-0">7</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
                    <button class="btn rej rounded-pill px-3 py-2 ">reject</button>
                    <button class="btn accept rounded-pill px-3 py-2 "data-bs-toggle="modal" data-bs-target="#pay">accept</button>
                </div>
            </div>

            <div class="freelanceroffer ">
                <div class=" d-flex ">
                    <div class="img">
                        <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                    </div>
                    <div class="info d-flex flex-column">
                        <h5 class="mb-0">Omar</h5>
                        <p class="mb-0"><span style="font-weight:600" class="mb-0 ">750</span> <span style="font-size:12px;color:#777">Rs</span>
                        </p>

                        <div class="d-flex">
                            <div class="d-flex align-items-baseline ">
                                <i class="fa-solid fa-star"></i>
                                <p class="mb-0">4,5</p>
                            </div>
                            <div class="d-flex align-items-baseline px-2">
                                <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                                <p class="mb-0">7</p>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
                    <button class="btn rej rounded-pill px-3 py-2 ">reject</button>
                    <button class="btn accept rounded-pill px-3 py-2 ">accept</button>
                    </div>

            </div>
            <div class="freelanceroffer ">
                <div class=" d-flex ">
                        <div class="img">
                    <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                    </div>
                    <div class="info d-flex flex-column">
                        <h5 class="mb-0">Omar</h5>
                        <p class="mb-0"><span style="font-weight:600" class="mb-0 ">750</span> <span style="font-size:12px;color:#777">Rs</span>
                        </p>
                        <div class="d-flex">
                        <div class="d-flex align-items-baseline ">
                            <i class="fa-solid fa-star"></i>
                            <p class="mb-0">4,5</p>
                        </div>

                        <div class="d-flex align-items-baseline px-2">
                            <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                            <p class="mb-0">7</p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
                    <button class="btn rej rounded-pill  ">reject</button>
                    <button class="btn accept rounded-pill  ">accept</button>
                </div>
            </div>

            <div class="freelanceroffer ">
                <div class=" d-flex ">
                    <div class="img">
                        <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                    </div>

                    <div class="info d-flex flex-column">
                        <h5 class="mb-0">Omar</h5>
                        <p class="mb-0"><span style="font-weight:600" class="mb-0 ">750</span> <span style="font-size:12px;color:#777">Rs</span>
                        </p>

                        <div class="d-flex">
                        <div class="d-flex align-items-baseline ">
                            <i class="fa-solid fa-star"></i>
                            <p class="mb-0">4,5</p>
                        </div>

                        <div class="d-flex align-items-baseline px-2">
                            <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                            <p class="mb-0">7</p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
                    <button class="btn rej rounded-pill px-3 py-2 ">reject</button>
                    <button class="btn accept rounded-pill px-3 py-2 ">accept</button>
                </div>
            </div>

            <div class="freelanceroffer ">
                <div class=" d-flex ">
                    <div class="img">
                        <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" alt="">
                    </div>

                    <div class="info d-flex flex-column">
                        <h5 class="mb-0">Omar</h5>
                        <p class="mb-0"><span style="font-weight:600" class="mb-0 ">750</span> <span style="font-size:12px;color:#777">Rs</span>
                        </p>

                        <div class="d-flex">
                        <div class="d-flex align-items-baseline ">
                            <i class="fa-solid fa-star"></i>
                            <p class="mb-0">4,5</p>
                        </div>

                            <div class="d-flex align-items-baseline px-2">
                                <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                                <p class="mb-0">7</p>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
                        <button class="btn rej rounded-pill px-3 py-2 ">reject</button>
                        <button class="btn accept rounded-pill px-3 py-2 ">accept</button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div> <!-- freelancers offers modal -->
