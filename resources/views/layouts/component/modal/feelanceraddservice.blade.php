 
  <!-- Modal -->
<div class="modal fade modal-uk modal-lg " id="freelaceraddservice" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                
                  <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
              </div>
              <div class="modal-body">
    
                <div class="text-center">
                    <h1 class=""  style="color:var(--orange-color)">Services</h1>
                </div>

                <form action="{{route('freelanc.addservice')}}" id="form-freelanc-service" method="POST">
                @csrf
                    <div class="halfwidthinput">
                    <p class="bold">categories</p>
                    </div>
                 <!-- phone input -->
                
                 @foreach ( App\Models\Category::all() as $category )
                 <div class=" mb-3 halfwidthinput">
                  <div class="form-check">
                 <input class="form-check-input category-checkbox" type="checkbox"name="category[]" value="{{ $category->id }}" id="category{{$category->id}}"
                 @if( App\Models\FreelancerService::where('parent_id',$category->id)->where('freelancer_id',auth()->user()->id)->exists() ||
                 App\Models\FreelancerService::where('parent_id',null)->where('service_id',$category->id)->where('freelancer_id',auth()->user()->id)->exists() )
                
                  checked
                  @endif
                 >
                 <label class="form-check-label" for="category{{ $category->id }}">
                  @if(app()->getLocale()=='ar')
                 {{ $category->title_ar}}
                 @else
                 {{ $category->title_en}}
                 @endif
                 </label>

                @if (App\Models\Service::where("category_id",$category->id)->get()!=null)
                <div class="d-flex justify-content-start align-items-center flex-wrap gap-2">
                @foreach ( App\Models\Service::where("category_id",$category->id)->get() as $service )
                       
                <div class="form-check">
                  <input class="form-check-input service-checkbox" type="checkbox"  data-parent="{{$category->id}}"value="{{$service->id}}" name="service[{{ $category->id }}][]"value="{{$service->id}}" data-parent="{{$category->id}}" id="service{{ $service->id }}"
                  @if( App\Models\FreelancerService::where('service_id',$service->id)->where('parent_id',$category->id)->where('freelancer_id',auth()->user()->id)->exists() )

                   checked
                   
                  @endif

                  >
                  <label class="form-check-label" for="{{ $service->id }}">
                    @if(app()->getLocale()=='ar')
                    {{$service->service_ar}}
                    @else
                    {{$service->service_en}}
                    @endif
              
                  </label>
                </div>
        
                @endforeach

                </div>
                @endif
               
              </div>
            </div>
                   
                 @endforeach
               
                   
                            
   
    
    <div class="btn-contianer d-flex flex-column justify-content-center align-items-center">
   <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">save</button>
  
    </div>

</form>
</div>
              </div>
          
          </div>
      </div>
  
        





        