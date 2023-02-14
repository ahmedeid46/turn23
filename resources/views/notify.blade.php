<html>
<body>
<h1> Test Send notify </h1>
<form action="{{ route('send.notify') }}" method="post">
    @csrf
    <button type="submit">notify</button>
</form>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyDPmqk16AKUsHqtg-VfKSy1DHE8GQJrCHM",
        authDomain: "b2b2022-4434e.firebaseapp.com",
        projectId: "b2b2022-4434e",
        storageBucket: "b2b2022-4434e.appspot.com",
        messagingSenderId: "727048487254",
        appId: "1:727048487254:web:423400932057d2b58516f7",
        measurementId: "G-BTLDWQHFP0"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {

            axios.post("{{ route('fcmToken') }}",{
                _method:"PATCH",
                token
            }).then(({data})=>{
                console.log(data)
            }).catch(({response:{data}})=>{
                console.error(data)
            })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
</script>
</body>
</html>
