<div class="modal fade" id="review{{$request->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{route('user.request.review', $request->id)}}" method="POST">
                @csrf
                <h1 class="modal-title fs-5" >review {{App\Models\User::where('id', $request->freelancer_id)->first()->name}}</h1>

                <div>
                    <div class="br-wrapper br-theme-fontawesome-stars">
                        <select class="example-rating" name="rate" style="display: none;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="my-3" >
                    <h5 class="font-size-15 mb-3">reivew</h5>
                    <textarea required="" class="form-control" rows="5" name="pragraph" value="write review"></textarea>
                </div>

                <div class="btn-contianer d-flex justify-between align-items-center">
                    <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">Rate</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

