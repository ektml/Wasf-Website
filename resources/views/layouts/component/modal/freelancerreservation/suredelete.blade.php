<!-- Modal -->
<div class="modal fade suredelete" id="suredelete{{$request->id}}" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('freelanc.reservation.cancelReservation',$request->id)}}">

                    @csrf
                    {{-- @method('PUT') --}}
                    <h1 class="modal-title fs-5"> {{__('request.are you sure from cancling this request')}} </h1>







                    <div class="btn-contianer d-flex  justify-content-between  align-items-center my-3">

                        <button class="btn  btn-modal modal-color-text border-0"> {{__('translate.move back')}}</button>
                        <button class="btn  btn-modal btn-model-primary" type="submit"
                            {{-- data-bs-toggle="modal" data-bs-target="#review"  --}}>{{__('request.cancel this reservation')}}</button>

                    </div>





                </form>

            </div>

        </div>
    </div>

</div>