@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
carts  
@endsection
@section("header")
@endsection


@section("css")


<style>

    .container-fluid{
        padding: 0 40px;
    }

    .chartitem img{
        width:220px;
        height: 250px;
        padding:12px 0;
    }


</style>


@endsection

@section("nosearch","none !important")
@section("content")
{{-- @extends("layouts.component.modal.userRequests.payment") --}}
<div class="charts">
    <div class="container-fluid">
         <div class="section-header ">
            <h2>shopping chart </h2>
        </div>


       @if (App\Models\Cart::where('user_id',auth()->user()->id)->exists())
              <div class=" chart-container d-flex flex-column flex-md-row ">
             <div class="chartsitems ">
                 
                   @foreach ($cartadditems as $cartitems )
                   <div class="chartitem row justify-content-center align-items-center g-2">
                    <div class="col">

                        @if ($cartitems->type=='product')
                            
                        <img src="{{ asset('assets/images/product/'.$cartitems->image)  }}" alt="">
                        @else
                        
                        <img src="{{ asset('assets/images/photo/'.$cartitems->image) }}" alt="">
                        @endif
                    </div>
                    <div class="col">
                        <h4>{{$cartitems->name}}</h4>
                        <p>{{$cartitems->price}}<span>S.R</span></p>
                    </div>
                    <div class="col">
                        <form action="{{route('user.cart.destroy',$cartitems->id)}}"  method="POST">
                            @csrf
                          @method('delete') 
                            <button type="submit" class="bg-white border-0"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                       
                    </div>
                </div>
                   @endforeach
          
             
                

        </div>
         <div class="chartcheckout px-2">
            <h3 class="py-2 px-3 ">order summery</h3>
            <div class="d-flex justify-content-center ">
            @if ($descount==0)
            <form action="{{route('user.addPromoCode')}}"  class="copone px-lg-3" >
                @csrf
                <div class="d-flex justify-content-center">
                <input type="text" class="form-control" id="promo"  placeholder="promo code" name="code">
                <button type="submit" class="btn py-2 px-lg-4 ms-3">  apply</button>
                </div>
            </form>

            @else

            <div class="text-center   w-100 py-2 text-success">promo code is actived</div>
            @endif
             
                </div>
                 <div class="details mt-4">
                    <div class="price d-flex">
                        <p class="fs-4">price</p>
                        <div class="number ">
                          {{$price}}
                            <span>S.R</span>
                        </div>
                    </div>
                    <div class="price d-flex ">
                         <p class="fs-4">discount</p>
                        <div class="number">
                            {{$descount}}
                            <span>%</span>
                        </div>
                    </div>
                    <div class="price d-flex">
                        <p class="fs-4">total</p>
                        <div class="number">
                           {{$total}}
                            <span>S.R</span>
                        </div>
                    </div>
                    <button type="button"class="btn  btn-modal  my-3 btn-model-primary chart-out" data-bs-target="#pay" id='paygetid'data-bs-toggle="modal">checkout</button>
                 </div>
        </div>
       
       @else
        <div class="d-flex">
              <p>your cart is empty......</p><a href="{{route("products")}}" class="linkemptycart">start shopping now</a></div>   
     
       @endif
     
  
            
               

            </div>
    </div>
</div>


<div class="modal offers fade  modal-uk pay" id="pay" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <h1>payment method</h1>
        <div class="d-flex align-items-center
        justify-content-center py-4">
          <div class="paytype visaicon">
              <i class="fa-brands fa-cc-visa"></i>
            <span>
              <i class="fa-solid fa-check"></i>
            </span>
          </div>
          <div class="paytype apayicon">
              
                <i class="fa-brands fa-apple-pay"></i>
            <span>
              <i class="fa-solid fa-check"></i>
            </span>
          </div>
          <div class="paytype active  walleticon">
           <i class="fa-solid fa-wallet"></i>
            <span>
              <i class="fa-solid fa-check"></i>
            </span>
          </div>
        </div>
     
  
        <div class="visa paycard">
          <div class="visaloader"></div>
          {{-- <form action="{{route('user.cartpay')}}" method="POST">
            <input type="hidden" name="paytype" value="visa">
            <input type="hidden" name="disc" value=" @if(isset($discount_key)) {{$discount_key}} @endif">
      
     <div class="form-outline mb-4 halfwidthinput">
      <label class="form-label" for="holder">holderholder name</label>
      
          
      <input type="text" id="holder" class="form-control" name="holder_name" />
     
    </div>
             <div class="form-outline mb-4 halfwidthinput">
      <label class="form-label" for="holder">Card number</label>
      
          
      <input type="text" id="holder" class="form-control" name="card_number" />
      
    </div>
             <div class="form-outline mb-4 halfwidthinput">
      <label class="form-label" for="holder">exp</label>
      
          
      <input type="text" id="holder" class="form-control" name="exp" />
      
    </div>
    <div class="form-outline mb-4 halfwidthinput">
      <label class="form-label" for="holder">cvv</label>
     
      <input type="text" id="holder" class="form-control" name="cvv" />
     
    </div>
        
    <div class="btn-contianer d-flex justify-content-center align-items-center">
      <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
     
       </div>
         
          </form> --}}
        </div>
        <div class="apay paycard">
          <form action="">
  
            <input type="hidden" name="paytype" value="apay">
    <div class="btn-contianer d-flex justify-content-center align-items-center">
      <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
     
       </div>
         
          </form>
        </div>
        <div class="wallet  paycard" >
          @if(!$walletEnough)
          <div class="wallet-empty" style="height:100%">
          <div class=" d-flex flex-column align-items-center justify-content-center w-100" style="height:100%" >
  
          
            <img src="{{asset('assets/images/wallet.png')}}" alt="wallet not enought" style="width:100px">
  
            <p style="color:#011C26;" class="text-center py-3">Your wallet is empty
              or haven't enough balance</p>
          </div>
        
        </div>
        @else
  <div class="wallet-pay">
    <form action="{{route('user.cartpay')}}" method="POST" class=" d-flex flex-column justify-content-end" >
      @csrf

      <input type="hidden" name="paytype" value="wallet">
      <input type="hidden" name="disc" value="@if(isset($discount_key)) {{$discount_key}} @endif
      ">
      <input type="hidden" name="request_id">
      
  
  
      <div class="btn-contianer d-flex justify-content-center align-items-center">
        <button type="submit" class="btn  btn-modal  my-3 btn-model-primary ">checkout</button>
       
         </div>
  
      </form>
  </div>
  
          
  @endif
         
       </div>
         
         
        </div>
  
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  
  

    <div class="modal fade " id="paydone" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                  
                    
                </div>
                <div class="modal-body ">
                <div class="d-flex flex-column justify-content-center align-items-center py-3 my-3">
                  
                
               
        
                  <div class="position-relative checkemo">
                      <div class="checkemoorange"></div>
                      <div class="checkemowhite">
                          <i class="fa-solid fa-check"></i>
                      </div>
                  </div>
               
                  <h4 class="inprogress"> successfully</h4>
    
              </div>
            </div>
          
          </div>
      </div>
  
 </div>
  

@endsection

@section("js")

<script>
@if(Session::has('state') && Session::get('state')=="paydone")
$(document).ready(function() {

    $('#paydone').modal('show');
    setTimeout(function(){
        $('#paydone').modal('hide');
    },3000);
     
});
@endif

// $(document).ready(function(){
//   $(document).on('click', '#paygetid', function (e) {

// // @php
// // $desc=null;
// // if(isset($discount_key)) 
// // $desc =$discount_key;

// // @endphp

//             e.preventDefault();
//              $.ajax({
//                 type: 'get',
                
//                 url: "{{route('user.cart.checkoutid')}}",
                
//                 success: function (data) {
//                     if (data.status == true) {
//                         $('.visa').empty().html(data.content);
//                     } else {
//                      }
//                 }, error: function (reject) {
//                 }
//             });
//         });

// });



$(document).ready(function(){

  Moyasar.init({
    element: '.visa',
  
    amount: {{$price}} *100,
    currency: '{{config('moyasar.currency')}}',
    description: 'cart Order ',
    publishable_api_key:'{{config('moyasar.publishable_key')}}',
    callback_url: '{{route('user.cartpay',$discount_key)}}',
    methods: ['creditcard'],
    metadata: {
    
        },

  on_failure: function (error) {
    alert('fail');
       }
  })


});

</script>


@endsection