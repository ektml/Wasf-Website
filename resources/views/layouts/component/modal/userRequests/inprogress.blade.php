
 <div id="inprogress{{ $request->id }}" class="modal offers fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="div d-flex justify-content-start px-4">
                    <div class="d-flex flex-column">
                        <h3 class="mb-0 font-bold">{{$request->random_id}}</h3>

                        @if ( $request->status =='Cancel by customer'  )
                        <span class="cancel  text-danger">cancel</span>
                        
                        @else
                        <span class="inprogress text-warning">{{ $request->status }}</span>
                        @endif
                        
                    </div>

                    <div class="align-slef-end" style="flex-grow: 1; display: flex; align-items: center; justify-content: flex-end;">
                        <a  href="#" data-bs-toggle="offcanvas" data-bs-target="#chat" aria-controls="offcanvasRight">
                            <i class="uil-comments-alt"  style="font-size:20px;"></i>
                        </a>
                    </div>
                </div>

                <div class="d-flex flex-column px-5">
                    <div class="d-flex justify-content-between">
                        <p class=" mb-0" >category</p>
                        <p class="fw-900 mb-0">{{ App\Models\Category::where('id', $request->category_id)->first()->title_en }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class=" mb-0">service</p>
                        @if(App\Models\Service::where('id', $request->service_id)->exists())
                        <p class="fw-900 mb-0">{{ App\Models\Service::where('id', $request->service_id)->first()->service_en }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="mb-0">title</p>
                        <p class="fw-900 mb-0">{{ $request->title }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class=" mb-0">due date</p>
                        <p class="fw-900 mb-0">{{ $request->due_date }}</p>
                    </div>
                </div>

                <div class="d-flex flex-column px-3 bg-blue ">
                    <span class="flex-grow-1 fs-5 font-bold ">description</span>
                    <p class="flex-grow-1">{{ $request->description }}</p>
                </div>

                <div class="d-flex flex-column px-3">
                    <p class="fs-5 font-bold">attachment</p>
                    <div class="d-flex flex-column px-2 ">
                        @foreach (  $request->file()->get() as $file)
                        <a class="file d-flex mb-2" href="{{route('download',$file->url)}}">
                            <div class="details d-flex ">
                                <div class="img">
                                    <i class="fa-regular fa-file-word"></i>
                                </div>
    
                                <div class="info">
                                    <p class="mb-0">{{ $file->name }}</p>
                                    <div class="size">{{ $file->size}}kB .{{ $file->type }}</div>
                                </div>
                            </div>
                        </a> <!-- end offerPending modal -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div  style="position:fixed ; bottom:0;right:0; font-size:30px">
        <button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{$request->id}}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
    </div>
</div>

