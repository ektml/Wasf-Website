<!DOCTYPE html>
<html lang="en" @if ( App::getLocale()=="ar" ) dir="rtl" @else dir="ltr" @endif>




<head>


  <title> @yield("title")</title>
  @include("layouts.component.head")


  @yield("css")

<style>



</style>
</head>

<body>
  {{-- <div id="preloading"></div> --}}
  <div id="layout-wrapper">

    @auth
    @include("layouts.component.newnav")
    @endauth

    @guest
    @include("layouts.component.nav2")
    @endguest
    @include("layouts.component.offcanvasNavbar")
    @include("layouts.component.modal.login")
    @include("layouts.component.modal.login2")
    @include("layouts.component.modal.signup")
    @include("layouts.component.modal.forgetpassword")


    <div class="content">
      <div id="custom-target"></div>
      <div
        class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100 "
        style="min-height:296px;
  background-color: #f8f9fa !important;
  z-index: 1;
  top: -23px !important;
  ">
        <div class="search-preloader absolute-top-center">
          <div class="dot-loader"></div>
        </div>
        <div class="search-nothing d-none p-3 text-center fs-16">

        </div>
        <div id="search-content" class="text-left">

        </div>
      </div>
      <div class="layout"></div>
      @yield("content")







      @include("layouts.component.footer")
    </div>

  </div>
  @include("layouts.component.script")
  @yield("js")

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $('#search').on('keyup', function(){
          search();
      });

      $('#search').on('focus', function(){
          search();
      });
      function search(){
          var searchKey = $('#search').val();
          
          if(searchKey.length > 0){
              $('body').addClass("typed-search-box-shown");
              $('.typed-search-box').removeClass('d-none');
              $('.search-preloader').removeClass('d-none');


              $.ajax({
         
         url: "{{route('search.ajax')}}",
         type: "get",
         dataType: "json",
         data:{'search' : $('#search').val()},
         success: function(data) {
         
            if(data == '0'){
                      // $('.typed-search-box').addClass('d-none');
                      $('#search-content').html(null);
                      $('.typed-search-box .search-nothing').removeClass('d-none').html( "Sorry, nothing found for <strong>"+ $('#search').val() +"</strong>");
                      $('.search-preloader').addClass('d-none');
                    

                  }
                  else{
                      $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                      $('#search-content').html(" ");
                      $('#search-content').html(data);
                      $('.search-preloader').addClass('d-none');
                  }
              
         }
     
         });
             
          }
          else {
              $('.typed-search-box').addClass('d-none');
              $('body').removeClass("typed-search-box-shown");
          }
      }


      $(document).ready(function(){
      
        @auth()     
        setInterval(getnotifcationcount,20000);
          function getnotifcationcount(){ 
              $.ajax({
              type: 'get',
              url: "{{route('user.notifcation.count')}}",
              data:{'count':parseInt($('.noti-count').html())},
              dataType: "json",
              success: function (data){
                  if (data['status']) {
                      $('.noti-count').html(data['count']);
                      Swal.fire({
                          position: 'top-end',
                          icon: 'info',
                          title: 'Your have new notification',
                          showConfirmButton: false,
                          timer: 3500,
                          toast: true,
                        })
                  }else{
                      
                   }
              }, error: function (reject) {

              }
          });
          }
    @endauth  
          
  
      })
   
  </script>
</body>

</html>