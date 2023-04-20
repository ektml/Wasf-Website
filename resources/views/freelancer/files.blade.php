@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
{{__('freelancerprofile.Files')}}
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
        <h2>{{__('freelancerprofile.Files')}} </h2>
      </div>

      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#newfile"
              aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              <span class="px-2">{{__('freelancerprofile.new')}}</span>

            </button>
          </h2>

          <div id="newfile" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body d-flex flex-column">


              @foreach ($files_current as $file )
              <div class="file d-flex ">
                <div class="details d-flex ">
                  <div class="img">
                    @if($file->type=='word')
                    <i class="fa-regular fa-file-word"></i>
                    @elseif($file->type=='pptx' ||$file->type=='ppt')
                    <i class="fa-regular fa-file-powerpoint"></i>
                    @elseif($file->type =='pdf')
                    <i class="fa-regular fa-file-pdf"></i>
                    @else
                    <i class="fa-regular fa-file"></i>
                    @endif
                  </div>
                  <div class="info">
                    <h3>
                      {{$file->name}}
                    </h3>
                    <div class="size">
                      {{$file->size}} . {{$file->type}}
                    </div>
                  </div>

                </div>
                <button class="tool" type="button" data-bs-target="fileTool{{$file->id}}" data-bs-toggle="modal">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
              </div>
              @include('layouts.component.modal.fileTool')
              @endforeach

            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#last-monthfile" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              <span class="px-2">{{__('freelancerprofile.last month')}}</span>
            </button>
          </h2>
          <div id="last-monthfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              @foreach ($files_lastmonth as $file )
              <div class="file d-flex ">
                <div class="details d-flex ">
                  <div class="img">
                    @if($file->type=='word')
                    <i class="fa-regular fa-file-word"></i>
                    @elseif($file->type=='pptx' ||$file->type=='ppt')
                    <i class="fa-regular fa-file-powerpoint"></i>
                    @elseif($file->type =='pdf')
                    <i class="fa-regular fa-file-pdf"></i>
                    @else
                    <i class="fa-regular fa-file"></i>
                    @endif
                  </div>
                  <div class="info">
                    <h3>
                      {{$file->name}}

                    </h3>
                    <div class="size">
                      {{$file->size}} . {{$file->type}}
                    </div>
                  </div>

                </div>
                <button class="tool" data-bs-target="fileTool{{$file->id}}" data-bs-toggle="modal">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
              </div>
              @include('layouts.component.modal.fileTool')
              @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#oldfile"
              aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
              <span class="px-2"> {{__('freelancerprofile.older')}}</span>
            </button>
          </h2>
          <div id="oldfile" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
              @foreach ($files_old as $file )
              <div class="file d-flex ">
                <div class="details d-flex ">
                  <div class="img">
                    @if($file->type=='word')
                    <i class="fa-regular fa-file-word"></i>
                    @elseif($file->type=='pptx' ||$file->type=='ppt')
                    <i class="fa-regular fa-file-powerpoint"></i>
                    @elseif($file->type =='pdf')
                    <i class="fa-regular fa-file-pdf"></i>
                    @else
                    <i class="fa-regular fa-file"></i>
                    @endif
                  </div>
                  <div class="info">
                    <h3>
                      {{$file->name}}

                    </h3>
                    <div class="size">
                      {{$file->size}} . {{$file->type}}
                    </div>
                  </div>

                </div>
                <button class="tool">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
              </div>
              @include('layouts.component.modal.fileTool')
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