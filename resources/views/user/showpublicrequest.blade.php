@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
show public request
@endsection
@section("header")
@endsection


@section("css")
<link href="{{asset('assets/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css" />


@endsection


@section("nosearch","none !important")
@section("content")
{{-- @include("layouts.component.modal.userRequests.payment") --}}
{{-- @include("layouts.component.modal.userRequests.offer")
@include("layouts.component.modal.userRequests.inprogress")
@include("layouts.component.modal.userRequests.inprogressenddue")
@include("layouts.component.modal.userRequests.chat")
@include("layouts.component.modal.userRequests.review")
@include("layouts.component.modal.userRequests.suredelete")
@include("layouts.component.modal.userRequests.finish")
@include("layouts.component.modal.userRequests.complete") --}}


<div class="showrequest">
    <div class="container">
        <div class="filtercontainer d-flex align-items-baseline justify-content-start">
            <div class="filter d-flex align-items-baseline">
                <button class="filter-button btn d-flex align-items-center justify-content-between">
                    <i class="fa-solid fa-filter px-2 fs-3"></i>
                    <span >filter by:</span>
                </button>
                {{-- <span class=" px-2">All</span>
                 --}}

                 @foreach ( $filter as  $f )

               <span class=" px-2">{{ $f }} </span>
                 @if(!$loop->last)
                 ,
                 @endif
             @endforeach
            </div>

            <div class="filter-items">
            <form action="{{route('user.showpublicrequest')}}">
                <div>
                    <input type="checkbox" name="search[]" value="all" id="all"
                    @if (in_array('newest',$filter))
                    checked
                @endif>
                    <label for="all" class="bold">all</label>
                </div>

                <div>
                    <input type="checkbox" name="search[]" value="datedesending" id="datedesending" @if (in_array('datedesending',$filter))
                    checked
                @endif>
                    <label for="datedesending" class="bold">date desending</label>
                </div>

                <div>
                    <input type="checkbox" name="search[]" value="pendding"id="pendding" 
                    @if (in_array('pendding',$filter))
                    checked
                @endif>
                    <label for="pendding" class="bold">pendding</label>
                </div>

                <div>
                    <input type="checkbox" name="search[]" value="active"id="active"
                    @if (in_array('active',$filter))
                    checked
                @endif >
                    <label for="active" class="bold">active</label>
                </div>

                <div>
                    <input type="checkbox" name="search[]" value="completed"id="completed" 
                    @if (in_array('completed',$filter))
                    checked
                @endif>
                    <label for="completed" class="bold">completed</label>
                </div>

                <div class="btn-contianer d-flex justify-content-center align-items-center">
                    <button type="submit" class="border-0 btn-modal  my-3 btn-model-primary">apply</button>
                </div>
            </form>
            </div>
        </div>

        <div class="requestlink py-4 d-flex justify-content-evenly align-items-center">
            <a href="{{route('user.showpublicrequest')}}" class="active fs-4  ">public request</a>
            <a href="{{route('user.showprivaterequest')}}" class="text-black-50 fs-4">private request</a>
        </div>

<div class="requesties d-flx flex-column pt-4">
    @foreach ($requests as $request)
    @if(!$request->freelancer_id )
        <div class="request offer d-flex flex-column px-3 py-3 position-relative mb-5" style="    margin-bottom: 63px !important;">
            <a href="#offerPending{{ $request->id }}" data-bs-toggle="modal" role="button">
                <div class="d-flex justify-content-between align-items-baseline show-phone">
                    <h3>{{$request->random_id}}</h3>
                    <p class="status gray"data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                </div>

                <div class="d-flex ">
                    <div class="d-flex flex-column px-2">
                        <p class="m-0">req.date</p>
                        <span>{{date_format($request->created_at,"Y-m-d")}}</span>
                    </div>

                    <div class="d-flex flex-column px-2">
                        <p class="m-0 text-danger">Due date</p>
                        <span>{{ $request->due_date }}</span>
                        <div>
                        </div>
                    </div>
{{--                      
                @if($request->offer->first() !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif --}}
                </div>
            </a>

            <button class="w-100 by-2 btn-noborder position-absolute mb-4" data-bs-target="#freelaceroffers{{$request->id}}" data-bs-toggle="modal"  role="button">
                offer
            </button>
        </div>
        @include("layouts.component.modal.userRequests.offer")
        @include("layouts.component.modal.userRequests.payment")
    @else

    @if($request->status == 'In Process' &&$request->due_date < now() )
    <a href="#inprogressenddue{{$request->id}}" data-bs-toggle="modal" class="request d-flex flex-column px-3 py-3 position-relative mb-5">
            <div class="d-flex justify-content-between align-items-baseline show-phone">
                <div class="frelacereq d-flex ">
                    <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                    <div class="freelanereq mx-2">
                        <h3 class="fw-600">{{ App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
                        <span class="text-black-50">#123123</span>
                    </div>
                </div>

                @if($request->status == 'Pending')
                    <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'In Process')
                    <p class="status gray text-warning" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Finished')
                    <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Completed')
                    <p class="status gray text-black" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @endif
            </div>

            <div class="d-flex ">
                <div class="d-flex flex-column px-2">
                    <p class="m-0">req.date</p>
                    <span>{{date_format($request->created_at,"Y-m-d")}}</span>
                </div>
                    {{-- @if($request->due_date < now()) --}}
                    @if($request->due_date < now()->toDateString())
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span class="text-danger">{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span>{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @endif
                     
                @if($request->offer->where('freelancer_id',$request->freelancer_id)->first() !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif
            </div>
        </a>
        @include("layouts.component.modal.userRequests.review")
        @include("layouts.component.modal.userRequests.chat")
    @elseif ($request->status == 'In Process')
        <a href="#inprogress{{ $request->id }}" data-bs-toggle="modal" class="request d-flex flex-column px-3 py-3 position-relative mb-5">
            <div class=" d-flex justify-content-between align-items-baseline  show-phone ">
                <div class="frelacereq d-flex ">
                    <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                    <div class="freelanereq mx-2">
                        <h3 class="fw-600">{{ App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
                        <span class="text-black-50">{{$request->random_id}}</span>
                    </div>
                </div>

                @if($request->status == 'Pending')
                    <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'In Process')
                    <p class="status gray text-warning" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Finished')
                    <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Completed')
                    <p class="status gray text-black" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @endif
            </div>

            <div class="d-flex ">
                <div class="d-flex flex-column px-2">
                    <p class="m-0">req.date</p>
                    <span>{{date_format($request->created_at,"Y-m-d")}}</span>
                </div>
                    @if($request->due_date < now()->toDateString())
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span class="text-danger">{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span>{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @endif
                     
                @if($request->offer->where('freelancer_id',$request->freelancer_id)->first() !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif
            </div>
        </a>
        
        @include("layouts.component.modal.userRequests.chat")
    @elseif ($request->status == 'Finished')
        <a href="#finish{{ $request->id }}" data-bs-toggle="modal" class="request d-flex flex-column px-3 py-3 position-relative mb-5">
            <div class="d-flex justify-content-between align-items-baseline show-phone">
                <div class="frelacereq d-flex ">
                    <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                    <div class="freelanereq mx-2">
                        <h3 class="fw-600">{{ App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
                        <span class="text-black-50">{{$request->random_id}}</span>
                    </div>
                </div>

                    <p class="status finish">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                
            </div>

            <div class="d-flex ">
                <div class="d-flex flex-column px-2">
                    <p class="m-0">req.date</p>
                    <span>{{date_format($request->created_at,"Y-m-d")}}</span>
                </div>
                    {{-- @if($request->due_date < now()) --}}
                    @if($request->due_date < now()->toDateString())
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span class="text-danger">{{$request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span>{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @endif
                     
                @if($request->offer->where('freelancer_id',$request->freelancer_id)->first()  !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif
            </div>
        </a>
        @include("layouts.component.modal.userRequests.chat")
    @elseif ($request->status == 'Completed')
        <a href="#complete{{ $request->id }}" data-bs-toggle="modal" class="request d-flex flex-column px-3 py-3 position-relative mb-5">
            <div class="d-flex justify-content-between align-items-baseline show-phone">
                <div class="frelacereq d-flex ">
                    <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                    <div class="freelanereq mx-2">
                        <h3 class="fw-600">{{ App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
                        <span class="text-black-50">{{$request->random_id}}</span>
                    </div>
                </div>

                @if($request->status == 'Pending')
                    <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'In Process')
                    <p class="status gray text-warning" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Finished')
                    <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Completed')
                    <p class="status gray text-black" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @endif
            </div>

            <div class="d-flex ">
                <div class="d-flex flex-column px-2">
                    <p class="m-0">req.date</p>
                    <span>{{ date_format($request->created_at,"Y-m-d")}}</span>
                </div>
                    {{-- @if($request->due_date < now()) --}}
                    @if($request->due_date < now()->toDateString())
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span class="text-danger">{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span>{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @endif
                     
                @if($request->offer->where('freelancer_id',$request->freelancer_id)->first()  !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif
                </div>
            </a>
            @include("layouts.component.modal.userRequests.complete")
            @include("layouts.component.modal.userRequests.review")
           @include("layouts.component.modal.userRequests.chat")

           @elseif($request->status == 'Cancel by customer')
           <a href="#complete{{ $request->id }}" data-bs-toggle="modal" class="request d-flex flex-column px-3 py-3 position-relative mb-5">
            <div class="d-flex justify-content-between align-items-baseline show-phone">
                <div class="frelacereq d-flex ">
                    <img src="{{ asset('Admin3/assets/images/users/'.App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                    <div class="freelanereq mx-2">
                        <h3 class="fw-600">{{ App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
                        <span class="text-black-50">{{$request->random_id}}</span>
                    </div>
                </div>

                @if($request->status == 'Pending')
                    <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'In Process')
                    <p class="status gray text-warning" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Finished')
                    <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                @elseif($request->status == 'Completed')
                    <p class="status gray text-black" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                    @elseif($request->status == 'Cancel by customer')
                    <p class="status text-danger" >cancel<i class="fa-solid fa-circle px-2 "></i></p>
                @endif
            </div>

            <div class="d-flex ">
                <div class="d-flex flex-column px-2">
                    <p class="m-0">req.date</p>
                    <span>{{ date_format($request->created_at,"Y-m-d")}}</span>
                </div>
                    {{-- @if($request->due_date < now()) --}}
                    @if($request->due_date < now()->toDateString())
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span class="text-danger">{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column px-2">
                            <p class="m-0">Due date</p>
                            <span>{{ $request->due_date }}</span>
                            <div>
                            </div>
                        </div>
                    @endif
                     
                @if($request->offer->where('freelancer_id',$request->freelancer_id)->first()  !=null)
                <div class="d-flex flex-column px-2">
                    <p class="m-0">price</p>
                    <span >{{$request->offer->where('freelancer_id',$request->freelancer_id)->first()->price }}</span>
                    <div>
                    </div>
                </div>
            @else
               
            @endif
                </div>
            </a>
            @include("layouts.component.modal.userRequests.complete")
            @include("layouts.component.modal.userRequests.review")
        @endif
    @endif
   

    
{{-- offerPending modal --}}
<div id="offerPending{{ $request->id }}" class="modal offers fade"  aria-hidden="true" aria-labelledby="offerPendingLabel" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header ">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="div d-flex justify-content-start px-4">
                <div class="d-flex flex-column">
                    <h3 class="mb-0 font-bold">{{$request->random_id}}</h3>
                    <span class="text-black-50">Pending</span>
                </div>
            </div>

            <div class="d-flex flex-column px-5">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">category</p>
                    <p class="fw-900 mb-0">{{App\Models\Category::where('id', $request->category_id)->first()->title_en }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">service</p>
                    @if(App\Models\Service::where('id', $request->service_id)->exists())
                    <p class="fw-900 mb-0">{{ App\Models\Service::where('id', $request->service_id)->first()->service_en }}</p>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0" >title</p>
                    <p class="fw-900 mb-0">{{ $request->title }}</p>
                </div>
    

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">due date</p>
                    <p class="fw-900 mb-0">{{ $request->due_date }}</p>
                </div>
            </div>

            <div class="d-flex flex-column px-3 bg-blue">
                <span class="flex-grow-1 fs-5 font-bold">description</span>
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
                    </a>  <!-- end offerPending modal -->
                    @endforeach
                    </div>
            </div>
          
        </div>

        <div class="modal-footer">
            <button class="btn  btn-modal  my-3 btn-model-primary" data-bs-target="#freelaceroffers{{$request->id}}"
                data-bs-toggle="modal" data-bs-dismiss="modal">offers
            </button>
        </div>
    </div>
</div>
</div><!-- end offerPending modal -->

{{-- end due date modal --}}
<div id="inprogressenddue{{ $request->id }}" class="modal offers fade" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="inprogressenddueLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="div d-flex justify-content-start px-4">
                <div class="d-flex flex-column">
                    <h3 class="mb-0 font-bold">{{$request->random_id}}</h3>
                    <span class="text-warning">{{ $request->status }}</span>
                </div>

                <div class="align-slef-end" style="flex-grow: 1; display: flex; align-items: center; justify-content: end;">
                    <a  href="#" data-bs-toggle="offcanvas" data-bs-target="#chat" aria-controls="offcanvasRight">
                        <i class="uil-comments-alt" style="font-size:20px;"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex flex-column px-5">
                <div class="d-flex justify-content-between">
                    <p class=" mb-0" >category</p>
                    <p class="fw-900 mb-0">
                        {{ App\Models\Category::where('id' , $request->category_id)->first()->title_en}}
                    </p>

                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">service</p>
                    @if(App\Models\Service::where('id', $request->service_id)->exists())
                    <p class="fw-900 mb-0">{{ App\Models\Service::where('id', $request->service_id)->first()->service_en }}</p>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <p class="mb-0">title</p>
                    <p class="fw-900 mb-0">{{ $request->title}}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class=" mb-0">due date</p>
                    <p class="fw-900 mb-0 deadline">{{ $request->due_date }}</p>
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
                        </a>  <!-- end offerPending modal -->
                       
                        @endforeach
                      
                        </div>

                </div>
            

                <div class="btn-contianer d-flex flex-column justify-between align-items-center my-3">
                    <form action="{{route('user.searchnewoffer',$request->id)}}" method='POST'>
                        @csrf
                        <button class="btn  btn-modal btn-model-primary" type="submit"  >search new offer</button>
                    </form>
                   
                    <button class="btn text-black-50 border-0"type="button" data-bs-toggle="modal" data-bs-target="#suredelete{{$request->id}}"  >cancel this service</button>
                </div>
            </div>
        </div>
    </div>

    <div style="position:fixed ; bottom:0;right:0; font-size:30px">
        <button class="addrequesticon" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat{{ $request->id }}" aria-controls="offcanvasRight"><i class="uil-comments-alt"></i></button>
    </div>
</div> <!-- end due date modal -->

{{-- in pregress modal --}}

@include("layouts.component.modal.userRequests.inprogress")
@include("layouts.component.modal.userRequests.finish")
{{-- @include("layouts.component.modal.userRequests.complete") --}}


@include("layouts.component.modal.userRequests.suredelete")

{{-- @include("layouts.component.modal.userRequests.review") --}}
{{-- @include("layouts.component.modal.userRequests.chat") --}}

@endforeach


{{ $requests->links() }}
</div>
</div>

</div>
@endsection


@section("js")
   
    <script src="{{asset('assets/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/rating-init.js')}}"></script>
    <script>
        $(".filter-button").click(function(){
            $(".filter-items").toggle();
        });
    </script>
    <script>
    

// get message 

$(document).ready(function () {
$('.chat').on('show.bs.offcanvas',function(){

var request_id= $(this).attr('data-id');
var type= $(this).attr('data-type');
var mesageto= $(this).attr('data-to');
var conversation =$(this).find('.conversation')
// console.log(.append("asdsdas"));
var olddata =0;
type=type.trim();

mesageto=mesageto.trim();
setTimeout(getmessage, 0);
var getmes =setInterval(getmessage,3000);

function getmessage() { 
$.ajax({
url: "{{URL::to('user/chat')}}",
type: "GET",
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
data:{'type':type,'messageto':mesageto ,'request_id':request_id},
dataType: "json",
success: function(data) {
if(data['status'] !='no message'){

conversation.html(" ");
$.each(data['message'],  function (index, el) {  
    if(el.from !={{auth()->user()->id}}){

let message= " ";
message=  '<div class="rightcont"> <div class="chat-txt rightside"> <p>'+
el.text
       +' </p> <span>'+
        new Date(el.created_at).toLocaleTimeString() 
       +
        '</span> </div> </div>';

        conversation.append(message);
   

    }else{

        let message2= " ";
message2=  '<div class="leftcont"> <div class="chat-txt leftside"> <p>'+
el.text
       +' </p> <span>'+
        new Date(el.created_at).toLocaleTimeString() +
        '</span> </div> </div>';

        conversation.append(message2);
     
    }


    


});



if( Object.keys(data).length >olddata){

$('.conversation').scrollTop($('.conversation')[0].scrollHeight);
olddata=Object.keys(data).length;
}
$('.chat').on('hide.bs.offcanvas',function(){
clearInterval(getmes);
});


}else{

    conversation.html(data['message']);

}
}

});


}

});

});
// end get message



function sendmessage(e){
    
        $.ajax({
           
            url: "{{route('user.chat.store')}}",
            type: "POST",
            data:$(e).serialize(),
            dataType: "json",
            success: function(data) {
            if(data){
                console.log(data);
                $(e).find('.messageinput').val(' ');

            }else{
                
                
            }
            }
        
            });
        
  



}



// start show offer

$(document).ready(function () {
 $('.freelaceroffers').on('show.bs.modal',function(){

var request_id= $(this).attr('data-id');

//  console.log(request_id);





//  var getmes =setTimeout(getoffer,1000);
getoffer();

function getoffer() { 
$.ajax({
url: "{{URL::to('user/getrequestoffer')}}/"+ request_id,
type: "GET",
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
dataType: "json",
success: function(data) {
if(data){

   
    $('#offercontainer'+request_id).html(" ");
   
    $('#offercontainer'+request_id).append(data);
  
    // $.each( data,function (index, el) {
    //  console.log( el);
        

$('.reject'+request_id).on('submit',function(e){

    $.ajax({
           
           url: "{{route('user.rejectofferrequest')}}",
           type: "GET",
           data:$(this).serialize(),
           dataType: "json",
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function(data) {
           if(data){
            console.log(data);
console.log(request_id);
            $.ajax({
                    url: "{{URL::to('user/getrequestoffer')}}/"+ request_id,
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                    if(data){

                        $('#offercontainer'+request_id).html(" ");
                    
                        $('#offercontainer'+request_id).append(data);
                    }else{
                        $('#offercontainer'+request_id).append('no offer available')
                    }
                    }
                });
           }else{
               
               
           }
           }
       
           });

});


}else{


}
}

});


}


});




});

function rejectoffer(e){

    $.ajax({
           
           url: "{{route('user.rejectofferrequest')}}",
           type: "POST",
           data:$(e).serialize(),
           dataType: "json",
           success: function(data) {
           if(data){
            //    console.log(data);
            //    getmessage();
            //    $(e).find('.messageinput').html(' ');

           }else{
               
               
           }
           }
       
           });

}

// end show offer

@if(Session::has('message') && Session::get('message')=="open payment")
// console.log({{Session::get('pay_wallet')}});
// console.log({{Session::get('request_id')}});
$(document).ready(function() {
    $('#pay{{Session::get('request_id')}}').modal('show');
    $('#pay{{Session::get('request_id')}}').find('.wallet .wallet-pay').hide();
    $('#pay{{Session::get('request_id')}}').find('.wallet .wallet-empty').hide();
    @if (Session::get('pay_wallet'))
    $('#pay{{Session::get('request_id')}}').find('.wallet .wallet-pay').show();
    $('#pay{{Session::get('request_id')}}').find('form input[name="offer"]').val("{{Session::get('offer_id')}}")
    $('#pay{{Session::get('request_id')}}').find('form input[name="request_id"]').val("{{Session::get('request_id')}}")
     
    @else
    $('#pay{{Session::get('request_id')}}').find('.wallet .wallet-empty').show();
        
    @endif



    Moyasar.init({
    element: '#pay{{Session::get('request_id')}} .visa',
  
    amount: {{App\Models\Offer::find(Session::get('offer_id'))->price}} *100,
    currency: '{{config('moyasar.currency')}}',
    description: ' public request id  {{App\Models\Requests::find(Session::get('request_id'))->random_id}} ',
    publishable_api_key:'{{config('moyasar.publishable_key')}}',
    callback_url: '{{route('user.request.bankpay',['offer_id'=>Session::get('offer_id'),'request_id'=>Session::get('request_id')])}}',
    methods: ['creditcard'],
    metadata: {
     'request_id':{{Session::get('request_id')}},
     'offer_id':{{Session::get('offer_id')}},
        },

  on_failure: function (error) {
    alert('fail');
       }
  })

    // $.ajax({
    //             type: 'get',
    //             url: "{{route('user.request.checkoutid')}}",
    //             data:{'request_id':{{Session::get('request_id')}} ,
    //                'offer_id':{{Session::get('offer_id')}},
    //                 },
    //             success: function (data) {
    //                 if (data.status == true) {
    //                     $('.visa').empty().html(data.content);
    //                 } else {
    //                  }
    //             }, error: function (reject) {
    //             }
    //         });



    
});
@endif
@if(Session::has('message') && Session::get('message')=="completed")
$(document).ready(function() {
console.log('asdas');
    $('#complete{{Session::get('id')}}').modal('show');
     
});
@endif




@if(Session::has('message') && Session::get('message')=="open completed")
$()

@endif

@if(Session::has('status') && Session::get('status')=="completed")
$(document).ready(function() {
$('#review{{Session::get('request_id')}}').modal('show');

});
@endif

@if(Session::has('state') && Session::get('state')=="paydone")
$(document).ready(function() {

    $('#paydone').modal('show');
    setTimeout(function(){
        $('#paydone').modal('hide');
    },3000);
     
});
@endif


@if(Session::has('state') && Session::get('state')=="paydone")
$(document).ready(function() {

    $('#paydone').modal('show');
    setTimeout(function(){
        $('#paydone').modal('hide');
    },3000);
     
});
@endif

    </script>

  
 
@endsection
