<!-- Modal -->
<div class="modal fade modal-uk" id="fileTool{{$file}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">


                <a href="{{route('download',$file->url)}}">
                    <i></i>
                    download
                </a>
                <a href="{{route('user.deletefile',$file->id)}}">
                    <i></i>
                    delete
                </a>
            </div>

        </div>
    </div>

</div>