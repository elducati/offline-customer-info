const staticCustInfo = "offline-cust-info-site-v1"
const assets = [
  "/",
  "/index.html",
  "/css/style.css",
  "/js/app.js",
  "/al_offline_data.sql",
  "/cust_info.php",
  "/images/logo.gif",
  "/images/icons/icon-72x72.png",
  "/images/icons/icon-96x96.png",
  "/images/icon-128x128.png",
  "/images/icons/icon-144x144.png",
  "/images/icons/icon-152x152.png",
  "/images/icons/icon-192x192.png",
  "/images/icons/icon-384x384.png",
  "/images/icons/icon-512x512.png",

]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(staticCustInfo).then(cache => {
      cache.addAll(assets)
    })
  )
})

self.addEventListener("fetch", fetchEvent => {
    fetchEvent.respondWith(
      caches.match(fetchEvent.request).then(res => {
        return res || fetch(fetchEvent.request)
      })
    )
  })