// sw.js
self.addEventListener("install", (event) => {
    console.log("Service Worker instalado");
});

self.addEventListener("activate", (event) => {
    console.log("Service Worker activado");
});

self.addEventListener("notificationclick", (event) => {
    event.notification.close();
    event.waitUntil(clients.openWindow("/src/index.php"));
});