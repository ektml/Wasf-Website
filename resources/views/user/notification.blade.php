@extends("layouts.home.index")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
notification
@endsection
@section("header")
@endsection


@section("css")

@endsection


@section("content")

<div class="notification">
    <div class="container">
        <div class="section-header">
            <h2>Notifications</h2>
        </div>
        <div class="row">

            @foreach ( $notifications as $notification)
            <div class="noti row col-12">
                <div class="image col-4 ">
                    <img src="{{asset('Admin3/assets/images/users/'. \App\Models\User::find($notification->data['user_create'])->profile_image ) }} "
                        alt="">
                </div>
                <div class="discription col-8">
                    <span
                        class="text-black-50">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                    <p> @if(app()->getLocale()=='ar')
                        {{$notification->data['message_ar']}}
                        @else
                        {{$notification->data['message_en']}}
                        @endif
                    </p>
                </div>
            </div>

            @endforeach

            {{-- {{ Auth::User()->unreadNotifications->markAsRead();}} --}}
        </div>


    </div>
</div>

@endsection

@section("js")

@endsection