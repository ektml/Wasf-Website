@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
show private requests
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
{{-- @include("layouts.component.modal.userprivaterequest.penddingacceptorreject") --}}
{{-- @include("layouts.component.modal.userprivaterequest.penddingcancel") --}}
{{-- @include("layouts.component.modal.userRequests.inprogress")
@include("layouts.component.modal.userRequests.inprogressenddue") --}}
{{-- @include("layouts.component.modal.userRequests.chat") --}}
{{-- @include("layouts.component.modal.userRequests.review") --}}
{{-- @include("layouts.component.modal.userRequests.suredelete") --}}
{{-- @include("layouts.component.modal.userRequests.finish")
@include("layouts.component.modal.userRequests.complete") --}}


<div class="showrequest">
    <div class="container">
        <div class="filtercontainer d-flex align-items-baseline justify-content-start">
            <div class="filter d-flex align-items-baseline">
                <button class=" filter-button btn d-flex align-items-center justify-content-between">
                    <i class="fa-solid fa-filter px-2 fs-3"></i>
                    <span >filter by:</span>
                </button>
                <span class=" px-2">All</span>
            </div>

            <div class="filter-items">
                <form action="">
                    <div>
                        <input type="checkbox" name="productsearch" value="all" id="all">
                        <label for="all" class="bold" >all</label>
                    </div>

                    <div>
                        <input type="checkbox" name="productsearch" value="datadesending" id="datadesending">
                        <label for="datadesending"class="bold" >data desending</label>
                    </div>

                    <div>
                        <input type="checkbox" name="productsearch" value="pendding"id="pendding" >
                        <label for="pendding"class="bold" >pendding</label>
                    </div>

                    <div>
                        <input type="checkbox" name="productsearch" value="active"id="active" >
                        <label for="active"class="bold" >active</label>
                    </div>

                    <div>
                        <input type="checkbox" name="productsearch" value="completed"id="completed" >
                        <label for="completed"class="bold" >completed</label>
                    </div>

                    <div class="btn-contianer d-flex justify-content-center align-items-center">
                        <button type="submit" class=" border-0 btn-modal  my-3 btn-model-primary ">apply</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="requestlink py-4 d-flex justify-content-evenly align-items-center">
            <a href="{{route('user.showpublicrequest')}}" class=" fs-4 text-black-50 ">{{__('request.public request')}}</a>
            <a href="{{route('user.showprivaterequest')}}" class="active  fs-4">{{__('request.private request')}}</a>
        </div>

    <div class="requesties d-flx flex-column pt-4">
        @foreach ($requests as $request)
 

       @if ($request->status=="Pending" && $request->offer->first())
       <a  href="#penddingacceptoreject{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

        @elseif($request->status=="Pending")
        <a  href="#penddingcancel{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

        @elseif(($request->status=='In Process' && $request->due_date < now()->toDateString() ) ||$request->status=='Reject' )
        <a  href="#inprogressenddueprivate{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

        @elseif($request->status=='In Process' )
        <a  href="#inprogress{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

        @elseif($request->status=='Cancel by customer' )
        <a  href="#inprogress{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
        @elseif($request->status=='Finished' )
        <a  href="#finish{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
        @elseif($request->status== 'Completed'  )
        <a  href="#complete{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

        @else

   <a  href="#"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

       @endif
            {{-- <a  href="#penddingcancel{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" > --}}
                <div class="d-flex justify-content-between align-items-baseline show-phone">
                    <div class="frelacereq d-flex ">
                        <img src="{{ asset("Admin3/assets/images/users/".App\Models\User::where('id', $request->freelancer_id)->first()->profile_image) }}" class="img-fluid rounded-top" alt="">

                        <div class="freelanereq mx-2">
                            <h3 class="fw-600">{{App\Models\User::where('id', $request->freelancer_id)->first()->name }}</h3>
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
                            <p class="status text-danger" >{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                            @elseif($request->status == 'Reject')
                            <p class="status text-danger">{{$request->status}}<i class="fa-solid fa-circle px-2 "></i></p>
                        @endif
                    </div>



                    <div class="d-flex ">
                        <div class="d-flex flex-column px-2">
                          
                        <p class="m-0">req.date</p>
                            <span>{{ date_format($request->created_at,"Y-m-d") }}</span>
                        </div>
                        
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
                
                @if($request->offer->first() !=null)
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

                @include("layouts.component.modal.userprivaterequest.penddingcancel")
                @include("layouts.component.modal.userprivaterequest.penddingacceptorreject")
                @include("layouts.component.modal.userRequests.inprogress")
                @include("layouts.component.modal.userprivaterequest.inprogressudedateprivate")
                @include("layouts.component.modal.userRequests.chat")
                @include("layouts.component.modal.userRequests.finish")
                @include("layouts.component.modal.userRequests.complete")
                 @include("layouts.component.modal.userRequests.payment")
                
                @include("layouts.component.modal.userRequests.review")
                
                @include("layouts.component.modal.userRequests.suredelete")
                  {{-- end model --}}
                  
            @endforeach
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

        function getdata(e){
            var id=  $(e).attr('data-id');
            var category_id=  $(e).attr('data-category-id');
         var modal= $(e).attr('href');
         $(modal).modal("show");
         $(modal+' '+'#get').attr("value",id);
         $(modal+' '+'#category_id').attr("value",category_id);


        }

        @if(Session::get("state")=='cancel')
        console.log('#review'+{{Session::get("id")}});

        $(document).ready(function($) {

            $('#review{{Session::get("id")}}').modal('show'); 
        });
        @endif


        
    </script>


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

            // $.ajax({
            //     type: 'get',
            //     url: "{{route('user.request.checkoutid')}}",
            //     data:{'request_id':{{Session::get('request_id')}} ,
            // 'offer_id':{{Session::get('offer_id')}},
            // },
            //     success: function (data) {
            //         if (data.status == true) {
            //             $('.visa').empty().html(data.content);
            //         } else {
            //          }
            //     }, error: function (reject) {
            //     }
            // });


    Moyasar.init({
    element: '#pay{{Session::get('request_id')}} .visa',
  
    amount: {{App\Models\Offer::find(Session::get('offer_id'))->price}} *100,
    currency: '{{config('moyasar.currency')}}',
    description: ' private request id  {{App\Models\Requests::find(Session::get('request_id'))->random_id}} ',
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
</script>
@endsection
