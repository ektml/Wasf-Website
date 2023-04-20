<!-- Modal -->
<div class="modal fade modal-uk fileTool" id="fileTool{{$file->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom:0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">


                <a href="{{route('download',$file->url)}}">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    {{__('translate.download')}}
                </a>
                <a href="{{route('user.deletefile',$file->id)}}">
                    <i class="fa-solid fa-trash"></i>
                    {{__('translate.delete')}}
                </a>
            </div>

        </div>
    </div>

</div>