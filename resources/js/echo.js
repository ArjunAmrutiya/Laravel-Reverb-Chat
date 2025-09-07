import Echo from 'laravel-echo';
// import "./bootstrap";

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
    withCredentials: true,
});

document.addEventListener("DOMContentLoaded", function () {
    // const userID = window.userID;

    // window.Echo.private(`App.User.${userID}`).listen(
    //     ".user.notification",
    //     (response) => {
    //         console.log("Event received:", response);
    //         showNotification(response);
    //     }
    // );

    window.Echo.channel("public-updates").listen(".UserEvent", (e) => {
        console.log("Received:", e.message);
    });

    window.Echo.channel("chat").listen(".message.sent", (event) => {
        console.log("event :: ", event);
        Livewire.dispatch("echo:chat,message.sent", {message: event.message});
        // Livewire.dispatch("messageReceived", { message: event.message });
    });
});
