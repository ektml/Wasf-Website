<div class="offcanvas 
@if(app()->getLocale()=='ar')
offcanvas-end
@else
offcanvas-start
@endif
" tabindex="-1" id="heronav" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        {{-- <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="offcanvas-nav">


            @if (auth()->check())
            @if (auth()->user()->type=="customer")


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('Admin3/assets/images/users/'.Auth::user()->profile_image) }}"
                        alt="Header Avatar">
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <button class="btn-switchtofreelanc" data-bs-target="#switchtofreelancer" data-bs-toggle="modal">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <p>{{__('translate.switch to freelancer account')}}</p>
                    </button>

                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">{{__('translate.profile')}}</span></a>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode!=app()->getLocale())
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <i class="fa-solid fa-earth-asia font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.language')}} ({{ $properties['native'] }})</span></a>
                    @endif

                    @endforeach
                    <a class="dropdown-item d-block" href="{{route("user.notification")}}"><i
                            class="uil-bell font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.notification')}}</span> <span
                            class="badge noti-count rounded-pill mt-1 ms-2">{{auth()->user()->unreadNotifications->count()}}</span></a>
                    <a class="dropdown-item" href="{{route("user.reservations")}}"><i
                            class="fa-regular fa-calendar font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.reservations')}}</span></a>

                    <a class="dropdown-item" href="{{route("user.showpublicrequest")}}"><i
                            class="fa-brands fa-squarespace font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.requests')}}</span></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item  logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.Sign out')}}</span></a>
                </div>
            </div>

            @elseif (auth()->user()->type=="freelancer")


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('Admin3/assets/images/users/'.Auth::user()->profile_image) }}"
                        alt="Header Avatar">
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{route("freelanc.profile")}}"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">{{__('translate.profile')}}</span></a>

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    @if($localeCode!=app()->getLocale())
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <i class="fa-solid fa-solid fa-earth-americas font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">{{__('translate.language')}}({{ $properties['native'] }})</span></a>


                    @endif
                    @endforeach
                    <a class="dropdown-item d-block" href="{{route("user.notification")}}"><i
                            class="uil-bell font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.notification')}}</span> <span
                            class="badge noti-count   rounded-pill mt-1 ms-2">{{auth()->user()->unreadNotifications->count()}}</span></a>
                    <a class="dropdown-item" href="{{route('freelanc.reservation')}}"><i
                            class="fa-regular fa-calendar font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.reservations')}}</span></a>
                    <a class="dropdown-item" href="{{route("freelanc.neworder")}}"><i
                            class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.orders')}}</span></a>
                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item  logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{__('translate.Sign out')}}</span></a>
                </div>
            </div>
            @endif
            @endif


            <div class="links-item">
                <a href="{{ route('home') }}"
                    class=" d-inline-block align-self-center ms-2 px-2{{ Request::is('home*') ? 'active' : '' }}">{{__('translate.home')}}</a>
                <a href="{{ route('products') }}"
                    class=" d-inline-block align-self-center  ms-2 px-2">{{__('translate.products')}}</a>
                <a href="{{ route('freelancers') }}"
                    class=" d-inline-block align-self-center  ms-2 px-2{{ request()->is('freelancers') ? 'active' : '' }}">{{__('translate.freelancers')}}</a>

                @if (!auth()->check())
                <a class="d-inline-block align-self-center mb-4" href="#login" class="btn"
                    data-bs-toggle="modal">{{__('translate.login')}}</a>
                @else
                <a class=" d-flex align-self-center cart-navicon mt-3" href="{{route("user.cart.index")}}">
                    <i class="fa-solid fa-cart-shopping cart-icon px-3"></i>
                    <span id="cart-count">{{App\Models\Cart::where('user_id' ,auth()->user()->id)->count()}}</span>
                </a>
                @endif

            </div>



        </div>

    </div>
</div>