<footer class=" pt-5">
    <div class="container pt-1">

        <div class="row">

            <div class="col-md-4 ">
                <div class=" footer-links d-flex flex-column ">
                        <a href="{{route('home')}}" class="text-decoration-none text-capitalize">{{__('translate.home')}}</a>
                        <a href="#" class="text-decoration-none text-capitalize">{{__('translate.categories')}}</a>
                        <a href="{{route('privacy&poilcy')}}" class="text-decoration-none text-capitalize">{{__("translate.privacy & police")}}</a>
                </div>
            </div>
            <div class="col-md-4   ">
                <div class=" footer-links d-flex flex-column ">
                <a href="{{route('products')}}" class="text-decoration-none text-capitalize">{{__('translate.products')}}</a>
                <a href="{{route('freelancers')}}" class="text-decoration-none text-capitalize">{{__('translate.freelancers')}}</a>
                </div>
            </div>
            <div class="col-md-4  download ">
                <h3 class="mb-5">{{__('translate.Download application')}}</h3>
                <div  class=" d-flex align-items-center">
                    <div class="d-flex align-items-center me-3" >
                        <a href="https://play.google.com/store/apps/details?id=com.ektml.wasf&pli=1"  target="_blank" class=""><img src="{{asset("assets/images/Icon material-android.png")}}" alt="">
                        <span class="px-2 text-capitalize">{{__('translate.google play')}}</span></a>
                    </div>
                    <div class="d-flex align-items-center">
                      <a href="#" class=""><img src="{{asset("assets/images/Icon awesome-apple.png")}}" alt="">
                       <span class="px-2 text-capitalize">{{__('translate.apple store')}} </span></a>
                   </div>
                </div>

            </div>
        </div>

          <p class="text-center py-3">{{__('translate.All copy writes saved to')}} <span class="footer-logo">{{__('translate.wasf')}}</span> {{__('translate.co.')}}</p>

         

    </div>
</footer>

