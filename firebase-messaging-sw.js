//import the libraries
importScripts("https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.6.8/firebase-messaging.js");

// Your web app's Firebase configuration
var firebaseConfig = {
  apiKey: "AIzaSyAUY9lMDKtBaA9la7Z1k2hIpGuV6kFT4OM",
  authDomain: "offrolls-web.firebaseapp.com",
  projectId: "offrolls-web",
  storageBucket: "offrolls-web.appspot.com",
  messagingSenderId: "96187196757",
  appId: "1:96187196757:web:4f756e71b9fc68e009bbdc",
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
messaging
  .getToken({
    vapidKey:
      "BKKgA2TECOrltBjYz4nktwChQ5Qj4ekRzRLYgf5a6BUaZXSuximGOkBnyja_BXh-8rNwYSdcg2osoq8BwB_9XhA",
  })
  .then((currentToken) => {
    if (currentToken) {
      // Send the token to your server and update the UI if necessary
      console.log("getToken: ", currentToken);
    } else {
      // Show permission request UI
      console.log(
        "No registration token available. Request permission to generate one."
      );
      // ...
    }
  })
  .catch((err) => {
    console.log("An error occurred while retrieving token. ", err);
    // ...
  });

//recive a data from firebase in backgroung
messaging.onBackgroundMessage((data) => {
  console.log("onBackgroundMessage Received background message: ", data);
  // Customize notification here
  //   const notificationTitle = "Background Message Title";
  //   const notificationOptions = {
  //     body: "Background Message body.",
  //     icon: "/firebase-logo.png",
  //   };

  //   self.registration.showNotification(notificationTitle, notificationOptions);
});
