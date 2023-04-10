importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyC7OAlb7QX6QmKLk7WvnrEkTrTgvEYs4nc",
    authDomain: "takween-6d56d.firebaseapp.com",
    projectId: "takween-6d56d",
    storageBucket: "takween-6d56d.appspot.com",
    messagingSenderId: "667921966647",
    appId: "1:667921966647:web:54b3f0afcf1723a7e001b2",
    measurementId: "G-7LPH951W90"
});



// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});