importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDPmqk16AKUsHqtg-VfKSy1DHE8GQJrCHM",
    projectId: "b2b2022-4434e",
    messagingSenderId: "727048487254",
    appId: "1:727048487254:web:423400932057d2b58516f7"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
