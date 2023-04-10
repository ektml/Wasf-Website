@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
reservation
@endsection
@section("header")
@endsection


@section("css")
<link href="{{asset('assets/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/@fullcalendar/core/main.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/@fullcalendar/daygrid/main.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/@fullcalendar/bootstrap/main.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/@fullcalendar/timegrid/main.min.css')}}" rel="stylesheet" type="text/css" />




<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/clndr.css')}}" rel="stylesheet">
<style>
 td{
    border:none !important;
 }

 .header-day{
    background-color: #fff;
    color:#000 !important;
    font-weight: 900 !important;
    font-size: 14px !important;
    text-align: center !important;
 }
 .header-days td{
    border:none;
 }
 .clndr-controls{
    border-radius:12px  12px  0 0 ;
    background-color: #f26b1de8;
    color:#fff;
    padding:20px 10px;
 }
 .clndr tr{
    margin-bottom:3px;
 }
 /* .clndr tbody td{
    border-radius: 5px;
 } */


 .clndr-event.event1 {
    background-color: #FF5733;
}

.day.event.event2 {
    background-color: #337DFF;
}
</style>
@endsection

@section("content")

{{-- @include("layouts.component.modal.freelancerreservation.offer") --}}
{{-- @include("layouts.component.modal.userRequests.chat") --}}



<div class="showrequest">
<div class="container">

    {{-- <div id="calendar">
        <div id="calendar_header"><i class="icon-chevron-left"></i>
            <h1></h1><i class="icon-chevron-right"></i>
        </div>

        <div id="calendar_weekdays"></div>
        <div id="calendar_content"></div>
    </div> --}}

     
      <div class="cal1"></div>
    
    <div class="section-header ">
        <h3 class="text-black">Reservation List</h3>
    </div>


    <div class="requesties d-flx flex-column pt-4">
@foreach ($reservations as $request)


{{-- @if ($request->status=="Pending" && $request->date_time< now() ) --}}
@if ($request->status=="Pending" && $request->offer->first())
<a  href="#feelancerReservationPendingcancancel{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

 @elseif($request->status=="Pending" && $request->date_time< now())
 <a  href="#penddingcancel{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-r elative mb-5" >
 @elseif($request->status=="Pending")
 <a href="#feelancerReservationPendingAceptOrReject{{ $request->id }}" data-bs-toggle="modal" role="button"class="request d-flex flex-column px-3 py-3 position-relative mb-5">


 @elseif($request->status=='Waiting' ||$request->status=='In Process'  )
 <a data-bs-toggle="modal" href="#waitingonly{{$request->id}}" role="button"class="request  d-flex flex-column px-3 py-3 position-relative mb-5">

 @elseif($request->status=='Cancel by customer' ||$request->status=='Cancel by freelancer' )
 <a  href="#canceleduserreservation{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
 @elseif($request->status=='reject' )
 <a  href="#reject{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
 @elseif($request->status=='Finished' )
 <a  href="#freelancerreservationfinished{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
 @elseif($request->status== 'Completed')
 <a  href="#freelancerreservationcompleted{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
 @elseif($request->status== 'Rejected')
 <a  href="#feelancerReservationRejected{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >
 @elseif($request->status== 'Posted by freelancer')
 <a  href="#feelancerReservationposted{{$request->id}}" data-bs-toggle="modal"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

 @else

<a  href="#"  role="button" class="request  d-flex  flex-column px-3 py-3 position-relative mb-5" >

@endif


   
        <div class="d-flex justify-content-between align-items-baseline" style="margin-bottom: 35px;">
            <div class="d-flex justify-content-between align-items-baseline">
                <h3 class="reservation-id">{{$request->random_id}}</h3>
            </div>
            @if($request->status == 'Pending')
                            <p class="status gray" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>


                 @elseif( $request->status == 'Waiting'  && $request->date_time==now()->toDateString() && ($request->from<=now() ||$request->to <=now()))
                            <p class="status inprogress" data-color="C4C3C3">In process<i class="fa-solid fa-circle px-2 "></i></p>
                        @elseif($request->status == 'Waiting')
                     
                            <p class="status inprogress">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                        @elseif($request->status == 'In Process')
                            <p class="status gray text-warning" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                        @elseif($request->status == 'Finished')
                            <p class="status gray" style="color: rgb(214, 214, 42);" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                        @elseif($request->status == 'Completed')

                            <p class="status gray text-black" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                        @elseif($request->status == 'Posted by freelancer')

                            <p class="status gray text-black-50" data-color="C4C3C3">{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>

                        @elseif($request->status == 'Cancel by customer'||$request->status == 'reject'  ||$request->status == 'Rejected'|| $request->status=='Cancel by freelancer')
                            <p class="status text-danger" >{{ $request->status }}<i class="fa-solid fa-circle px-2 "></i></p>
                        
                        @endif
        </div>

        <div class="d-flex">
                
            @if($request->date_time < now()->toDateString())
            <div class="d-flex flex-column px-2">
                <p class="m-0">Reserve date</p>
                <span class="text-danger">{{date_format(new dateTime($request->date_time),'d/m/Y')}}</span>
                <div>
                </div>
            </div>
        @else
            <div class="d-flex flex-column px-2">
                <p class="m-0">Reserve date </p>
                <span>{{date_format(new dateTime($request->date_time),'d/m/Y')}}</span>
                <div>
                </div>
            </div>
        @endif
        
        @if($request->offer->first() !=null)
        <div class="d-flex flex-column px-2">
            <p class="m-0">Price</p>
            <span >{{$request->offer->first()->price }}</span>
            <div>
            </div>
        </div>
    @else
       
    @endif
        </div>
    </a>





    {{--  SHOW MODAL BASED ON REQUEST STATUS --}}


   
    @if ($request->status=="Pending" && $request->offer->first())
   
    @include("layouts.component.modal.freelancerreservation.pendingcancancel")
     @elseif($request->status=="Pending" && $request->date_time< now())
     
     @elseif($request->status=="Pending")
     @include("layouts.component.modal.freelancerreservation.PendingAcceptOrReject")
     @include("layouts.component.modal.freelancerreservation.offer")
     
     {{-- @elseif(($request->status=='In Process' && $request->due_date < now()->toDateString() ) ||$request->status=='Rejected' ) --}}
     @elseif($request->status=='Rejected' )
     @include("layouts.component.modal.freelancerreservation.offer")
     @include("layouts.component.modal.freelancerreservation.Rejectedandeditoffer")

     @elseif($request->status=='In Process' )
     
     
     @elseif($request->status=='Waiting' )
     @include("layouts.component.modal.freelancerreservation.waitingonly")
     @include("layouts.component.modal.freelancerreservation.requestdelay")

     @elseif($request->status=='reject' )
     @include("layouts.component.modal.freelancerreservation.rejected")
     @elseif($request->status=='Posted by freelancer' )
     @include("layouts.component.modal.freelancerreservation.posted")
     
     @elseif($request->status=='Cancel by customer' )
     @include("layouts.component.modal.userresrvationrequest.canceled")
     @elseif($request->status=='Finished' )
     @include("layouts.component.modal.freelancerreservation.finished")
     @elseif($request->status=='Completed' )
     @include("layouts.component.modal.freelancerreservation.completed")
     @elseif($request->status == 'Cancel by customer'|| $request->status == 'Cancel by freelancer')
     @include("layouts.component.modal.userresrvationrequest.canceled")
    
     @else
    
  
    
    @endif

    @include("layouts.component.modal.freelancerreservation.suredelete")
    @include("layouts.component.modal.userRequests.chat")


{{-- 
@include("layouts.component.modal.freelancerreservation.pendingcancancel")
@include("layouts.component.modal.freelancerreservation.waitingwithrequest")
@include("layouts.component.modal.freelancerreservation.waitingonly")
@include("layouts.component.modal.freelancerreservation.inprogress")
@include("layouts.component.modal.freelancerreservation.finished")
@include("layouts.component.modal.freelancerreservation.completed")
@include("layouts.component.modal.freelancerreservation.suredelete")
@include("layouts.component.modal.freelancerreservation.rejectedorcanceled") --}}

@endforeach

</div>
</div>
</div>
@endsection



@section("js")
<script src="{{asset('assets/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
<script src="{{asset('assets/js/pages/rating-init.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clndr/1.4.7/clndr.min.js"></script>

<!-- plugin js -->
{{-- <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/libs/@fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/libs/@fullcalendar/bootstrap/main.min.js')}}"></script>
<script src="{{asset('assets/libs/@fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/libs/@fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/libs/@fullcalendar/interaction/main.min.js')}}"></script>
<!-- Calendar init -->
<script src="{{asset('assets/js/pages/calendar.init.js')}}"></script> --}}
{{-- <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>

<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js"')}}"></script>

<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script> --}}

<script>



    
    $(document).ready(function () {
    $('.chat').on('show.bs.offcanvas',function(){
    
    var request_id= $(this).attr('data-id');
    var type= $(this).attr('data-type');
    var mesageto= $(this).attr('data-to');
    var conversation =$(this).find('.conversation')
   
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
    
    
    @if(Session::has('state') && Session::get('state')=="reject")
    $(document).ready(function() {
    
        $('#reject{{Session::get('id')}}').modal('show');
         
    });
    @endif
    @if(Session::has('state') && (Session::get('state')=="offersend" ||Session::get('state')=="offeredit"))
    $(document).ready(function() {
    
        $('#feelancerReservationPendingcancancel{{Session::get('id')}}').modal('show');
         
    });
    @endif

    @if(Session::has('state') && Session::get('state')=="posted" )
    $(document).ready(function() {
    
        $('#feelancerReservationposted{{Session::get('id')}}').modal('show');
         
    });
    @endif





  

 

   
</script>  


<script>
     $(document).ready( function() {
    var calendars ={};
    var events = [
        @foreach ($reservations as $request)

        {
            date: '{{date_format(new dateTime($request->date_time),'Y-m-d')}}',
            title: '{{$request->status}}',
            color: '#777',
            onclick: function(target) {
                @if ($request->status=="Pending" && $request->offer->first())

                $('#feelancerReservationPendingcancancel{{$request->id}}').modal('show');
                @elseif($request->status=="Pending" && $request->date_time< now())
                $('#penddingcancel{{$request->id}}').modal('show');
                    
            @elseif($request->status=="Pending")
            $('#feelancerReservationPendingAceptOrReject{{$request->id}}').modal('show');
            
            @elseif($request->status=='Rejected' )
            $('#feelancerReservationposted{{$request->id}}').modal('show');

            @elseif($request->status=='In Process' )
            
            
            @elseif($request->status=='Waiting' )
            $('#waitingonly{{$request->id}}').modal('show');

            @elseif($request->status=='reject' )
            $('#reject{{$request->id}}').modal('show');
            @elseif($request->status=='Posted by freelancer' )
            $('#feelancerReservationposted{{$request->id}}').modal('show');
            
            @elseif($request->status=='Cancel by customer' )
            $('#canceleduserreservation{{$request->id}}').modal('show');
            @elseif($request->status=='Finished' )
            $('#freelancerreservationfinished{{$request->id}}').modal('show');
            @elseif($request->status=='Completed' )
            $('#freelancerreservationcompleted{{$request->id}}').modal('show');
            @elseif($request->status == 'Cancel by customer'|| $request->status == 'Cancel by freelancer')
            $('#canceleduserreservation{{$request->id}}').modal('show');
            
            @elseif(($request->status=='In Process' && $request->due_date < now()->toDateString() ) ||$request->status=='Rejected' ) 
            $('#feelancerReservationRejected{{$request->id}}').modal('show');

        @endif
            }
        },
        @endforeach
       
    ];


    // Here's some magic to make sure the dates are happening this month.
    var thisMonth = moment().format('YYYY-MM');
    // Events to load into calendar
    var eventArray = [
        {
            title: 'Multi-Day Event',
            endDate: thisMonth + '-14',
            startDate: thisMonth + '-10'
        }, {
            endDate: thisMonth + '-23',
            startDate: thisMonth + '-21',
            title: 'Another Multi-Day Event'
        }, {
            date: thisMonth + '-27',
            title: 'Single Day Event'
        }
    ];

   
    calendars.clndr1 = $('.cal1').clndr({
        events: events,
        clickEvents: {
            click: function(target) {
                if (target.events.length) {
                    var event = target.events[0];
                    if (event.onclick) {
                        event.onclick(target);
                    }
                }
            }
        },
   
        multiDayEvents: {
            singleDay: 'date',
            endDate: 'endDate',
            startDate: 'startDate'
        },
        showAdjacentMonths: false,
        adjacentDaysChangeMonth: true,
        // eventColor: 'color',
        classNames: function (targetDate) {
            console.log('sdsd');
        return events.reduce(function (classes, event) {
          
            if (event.date === moment(targetDate).format('YYYY-MM-DD')) {
                classes.push('event-' + event.title);
                
            }
           
            return classes;
        }, []);
    }
    });

   


    // Bind all clndrs to the left and right arrow keys
    $(document).keydown( function(e) {
        // Left arrow
        if (e.keyCode == 37) {
            calendars.clndr1.back();
            calendars.clndr2.back();
            calendars.clndr3.back();
        }

        // Right arrow
        if (e.keyCode == 39) {
            calendars.clndr1.forward();
            calendars.clndr2.forward();
            calendars.clndr3.forward();
        }
    });
});
</script>
@endsection
