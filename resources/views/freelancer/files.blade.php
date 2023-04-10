@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
product
@endsection
@section("header")
@endsection

@section("css")
<style>
    .files {
        padding-top: 30px;
        padding-bottom: 30px;
        flex-direction: column;
    }
</style>
@endsection


@section("content")

<div class="files">
    <div class="container">
        <div class="files d-flex">
            <div class="section-header  p-2">
                <h2>Files </h2>
            </div>

            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#newfile" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                   <span class="px-2">New</span>
              
                    </button>
                  </h2>
        
                  <div id="newfile" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body d-flex flex-column">
        
                        
                  @foreach ($files_current as $curfile )
                  <div class="file d-flex ">
                    <div class="details d-flex ">
                        <div class="img">
                            @if($curfile->type=='word')
                            <i class="fa-regular fa-file-word"></i>
                            @elseif($curfile->type=='pptx' ||$curfile->type=='ppt')
                            <i class="fa-regular fa-file-powerpoint"></i>
                            @elseif($curfile->type =='pdf')
                            <i class="fa-regular fa-file-pdf"></i>
                             @else
                             <i class="fa-regular fa-file"></i>
                            @endif
                        </div>
                        <div class="info">
                            <h3>
                                {{$curfile->name}}
        
                            </h3>
                            <div class="size">
                                {{$curfile->size}} . {{$curfile->type}}
                            </div>
                        </div>
        
                    </div>
                    <div class="tool">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
                  @endforeach
                     
              
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#last-monthfile" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    <span class="px-2"> Last month</span>
                    </button>
                  </h2>
                  <div id="last-monthfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        @foreach ($files_lastmonth as $lastfile )
                        <div class="file d-flex ">
                          <div class="details d-flex ">
                              <div class="img">
                                @if($lastfile->type=='word')
                                <i class="fa-regular fa-file-word"></i>
                                @elseif($lastfile->type=='pptx' ||$lastfile->type=='ppt')
                                <i class="fa-regular fa-file-powerpoint"></i>
                                @elseif($lastfile->type =='pdf')
                                <i class="fa-regular fa-file-pdf"></i>
                                 @else
                                 <i class="fa-regular fa-file"></i>
                                @endif
                              </div>
                              <div class="info">
                                  <h3>
                                      {{$lastfile->name}}
              
                                  </h3>
                                  <div class="size">
                                      {{$lastfile->size}} . {{$lastfile->type}}
                                  </div>
                              </div>
              
                          </div>
                          <div class="tool">
                              <i class="fa-solid fa-ellipsis-vertical"></i>
                          </div>
                      </div>
                        @endforeach
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#oldfile" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    <span class="px-2"> Older</span>
                    </button>
                  </h2>
                  <div id="oldfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        @foreach ($files_old as $lastfile )
                        <div class="file d-flex ">
                          <div class="details d-flex ">
                              <div class="img">
                              @if($lastfile->type=='word')
                             <i class="fa-regular fa-file-word"></i>
                             @elseif($curfile->type=='pptx' ||$curfile->type=='ppt')
                             <i class="fa-regular fa-file-powerpoint"></i>
                             @elseif($lastfile->type =='pdf')
                             <i class="fa-regular fa-file-pdf"></i>
                              @else
                              <i class="fa-regular fa-file"></i>
                             @endif
                              </div>
                              <div class="info">
                                  <h3>
                                      {{$lastfile->name}}
              
                                  </h3>
                                  <div class="size">
                                      {{$lastfile->size}} . {{$lastfile->type}}
                                  </div>
                              </div>
              
                          </div>
                          <div class="tool">
                              <i class="fa-solid fa-ellipsis-vertical"></i>
                          </div>
                      </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

@section("js")

@endsection