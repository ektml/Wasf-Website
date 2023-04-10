@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
new orders
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
{{-- @include("layouts.component.modal.userprivaterequest.penddingacceptorreject")
@include("layouts.component.modal.freelancerRequests.pendingwithsendoffer")
@include("layouts.component.modal.freelancerRequests.offer") --}}

{{-- @include("layouts.component.modal.userprivaterequest.penddingcancel")
@include("layouts.component.modal.userRequests.inprogress")
@include("layouts.component.modal.userRequests.inprogressenddue")
@include("layouts.component.modal.userRequests.chat")
@include("layouts.component.modal.userRequests.review")
@include("layouts.component.modal.userRequests.suredelete")
@include("layouts.component.modal.userRequests.finish")
@include("layouts.component.modal.userRequests.complete") --}}


<div class="showrequest">
    <div class="container">
        

        <div class="requestlink py-4 d-flex justify-content-evenly align-items-center">
            <a href="{{route('freelanc.neworder')}}"  class="active  fs-4">new orders</a>
            <a href="{{route('freelanc.mywork')}}" class=" fs-4 text-black-50 " >mywork</a>
        </div>




       <div class="requesties d-flx flex-column pt-4">
          
        <div class="privateorders p-2  my-5 " >
            <h3 class="py-3">private orders</h3>

            @foreach( $privates as $request )
              

            @if($request->offer->where('freelancer_id',auth()->user()->id)->first()==null)

            <a data-bs-toggle="modal" href="#freelancerorderpeindingwithoffer{{$request->id}}" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">
            @else

            <a data-bs-toggle="modal" href="#feelancerrequstPendingcancancel{{$request->id}}" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">



            @endif
              <div class="d-flex justify-content-between align-items-baseline">
                <div class="frelacereq d-flex ">
                  <img src="{{ asset("Admin3/assets/images/users/".App\Models\User::where('id',$request->user_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">
                    <div class="freelanereq mx-2">
                    <h3 class="fw-600">{{App\Models\User::find($request->user_id)->name}}</h3>
                      <span class="text-black-50">#123123</span>
                    </div>
                </div>
                <p class="status gray" data-color="C4C3C3">{{$request->status}}<i class="fa-solid fa-circle px-2 "></i></p>
              </div>
              <div class="d-flex ">
                  <div class="d-flex flex-column px-2">
                     <p class="m-0">req.date</p>
                      <span>{{date_format($request->created_at,"Y-m-d") }}</span>
                  </div>
                  <div class=" d-flex flex-column px-2">
                      <p class="m-0">Due date</p>
                      <span>{{ $request->due_date }}</span>
                  <div>
              </div>
  
                  </div>

                  
              @if($request->offer->where('freelancer_id',auth()->user()->id)->first()!=null )
              <div class="d-flex flex-column px-2">
                  <p class="m-0">price</p>
                  <span >{{$request->offer->where('freelancer_id',auth()->user()->id)->first()->price }}</span>
                  <div>
                  </div>
              </div>
          @endif

               </div>
  
               
      </a>

      
      @if(empty($request->offer->where('freelancer_id',auth()->user()->id)->first()) )

      @include("layouts.component.modal.freelancerRequests.pendingwithsendoffer")
      @include("layouts.component.modal.freelancerRequests.offer")
      @include("layouts.component.modal.userRequests.chat")
      @else
      @include("layouts.component.modal.freelancerRequests.pendingwithcancel")

      @include("layouts.component.modal.userRequests.chat")
      @endif

      @endforeach
 
        </div> 



        @foreach ($publics  as $request )

        @if($request->offer->where('freelancer_id',auth()->user()->id)->first()==null)

        <a data-bs-toggle="modal" href="#freelancerorderpeindingwithoffer{{$request->id}}" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">


        @else

        <a data-bs-toggle="modal" href="#feelancerrequstPendingcancancel{{$request->id}}" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">



        @endif
          <div class="d-flex justify-content-between align-items-baseline">
            <div class="frelacereq d-flex ">
              <img src="{{ asset("Admin3/assets/images/users/".App\Models\User::where('id',$request->user_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">
                <div class="freelanereq mx-2">
                <h3 class="fw-600">{{App\Models\User::find($request->user_id)->name}}</h3>
                  <span class="text-black-50">{{$request->random_id}}</span>
                </div>
            </div>
            <p class="status gray" data-color="C4C3C3">{{$request->status}}<i class="fa-solid fa-circle px-2 "></i></p>
          </div>
          <div class="d-flex ">
              <div class="d-flex flex-column px-2">
                 <p class="m-0">req.date</p>
                  <span>{{date_format($request->created_at,"Y-m-d") }}</span>
              </div>
              <div class=" d-flex flex-column px-2">
                  <p class="m-0">Due date</p>
                  <span>{{ $request->due_date }}</span>
              <div>
          </div>

              </div>

              
          @if($request->offer->where('freelancer_id',auth()->user()->id)->first()!=null )
          <div class="d-flex flex-column px-2">
              <p class="m-0">price</p>
              <span >{{$request->offer->where('freelancer_id',auth()->user()->id)->first()->price }}</span>
              <div>
              </div>
          </div>
      @endif

           </div>

           
  </a>

  
  @if(empty($request->offer->where('freelancer_id',auth()->user()->id)->first()) )

  @include("layouts.component.modal.freelancerRequests.pendingwithsendoffer")
  @include("layouts.component.modal.freelancerRequests.offer")

  @else
  @include("layouts.component.modal.freelancerRequests.pendingwithcancel")
  @include("layouts.component.modal.freelancerRequests.offer")
  @endif
     
          
        @endforeach

        {{-- <a data-bs-toggle="modal" href="#penddingacceptoreject" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">
     
          <div class="d-flex justify-content-between align-items-baseline">
            <div class="frelacereq d-flex ">
              <img src="{{asset("assets/images/vicky-hladynets-C8Ta0gwPbQg-unsplash.png")}}" class="img-fluid rounded-top" alt="">
                <div class="freelanereq mx-2">
                <h3 class="fw-600">customer name</h3>
                  <span class="text-black-50">#123123</span>
                </div>
            </div>
            <p class="status gray" data-color="C4C3C3">pending<i class="fa-solid fa-circle px-2 "></i></p>
          </div>
          <div class="d-flex ">
              <div class="d-flex flex-column px-2">
                 <p class="m-0">req.date</p>
                  <span>20/09/2010</span>
              </div>
              <div class=" d-flex flex-column px-2">
                  <p class="m-0">Due date</p>
                  <span>20/09/2010</span>
              </div>
              <div class=" d-flex flex-column px-2">
                <p class="m-0">price</p>
                <span>1211 SR</span>
            </div>
           </div>

           
  </a>
     --}}

       </div>
</div>
</div>


@endsection

@section("js")
<script src="{{asset('assets/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>

<script src="{{asset('assets/js/pages/rating-init.js')}}"></script> 



<script>
  // $('#offerPending').on('show.bs.modal', function(event) {
  //     var button = $(event.relatedTarget)
  //     console.log(button)
  //     var id = button.data('id')
  //     var category_id = button.data('category_id')
  //     var service_id = button.data('service_id')
  //     var title = button.data('title')
  //     var due_date = button.data('due_date')
  //     var description = button.data('description')
  //     var attachment = button.data('attachment')
  //     var modal = $(this)
  //     modal.find('.modal-body #id').val(id);
  //     modal.find('.modal-body #category_id').val(category_id);
  //     modal.find('.modal-body #service_id').val(service_id);
  //     modal.find('.modal-body #title').val(title);
  //     modal.find('.modal-body #due_date').val(due_date);
  //     modal.find('.modal-body #description').val(description);
  //     modal.find('.modal-body #attachment').val(attachment);
  // })


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




</script>

@endsection