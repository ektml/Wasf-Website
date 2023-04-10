@extends("layouts.home.index")
@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
    Freelancer Profile
@endsection
@section("header")
@endsection
@section("css")
@endsection

{{-- @extends('layouts.app') --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <button onclick="startFCM()"
                    class="btn btn-danger btn-flat">Allow notification
                </button>
            <div class="card mt-3">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('create.noti') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->


@endsection

@section('js')
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyC7OAlb7QX6QmKLk7WvnrEkTrTgvEYs4nc",
  authDomain: "takween-6d56d.firebaseapp.com",
  projectId: "takween-6d56d",
  storageBucket: "takween-6d56d.appspot.com",
  messagingSenderId: "667921966647",
  appId: "1:667921966647:web:54b3f0afcf1723a7e001b2",
  measurementId: "G-7LPH951W90"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            }).catch(function (error) {
                alert(error);
            });
    }

    // console.log(messaging.onMessage());
    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>

{{-- 
<script>

import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyC7OAlb7QX6QmKLk7WvnrEkTrTgvEYs4nc",
  authDomain: "takween-6d56d.firebaseapp.com",
  projectId: "takween-6d56d",
  storageBucket: "takween-6d56d.appspot.com",
  messagingSenderId: "667921966647",
  appId: "1:667921966647:web:54b3f0afcf1723a7e001b2",
  measurementId: "G-7LPH951W90"
};

function requestPermission() {
  console.log("Requesting permission...");
  Notification.requestPermission().then((permission) => {
    if (permission === "granted") {
      console.log("Notification permission granted.");
      const app = initializeApp(firebaseConfig);

      const messaging = getMessaging(app);
      getToken(messaging, {
        vapidKey:
          "BCKNSY0FAgDlbgevvqBGsXdadLiRCrFR1wbWXqFYgQJOV3jX8nTSHAQzXcB91c6GGlmFwCfCcxCUK_UxDL7nTLA",
      }).then((currentToken) => {
        if (currentToken) {
          console.log("currentToken: ", currentToken);
        } else {
          console.log("Can not get token");
        }
      });
    } else {
      console.log("Do not have permission!");
    }
  });
}

requestPermission();
</script> --}}

@endsection