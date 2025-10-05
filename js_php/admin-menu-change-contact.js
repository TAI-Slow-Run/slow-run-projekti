import * as dUtils from "../databaseTools/databaseUtilities.js";


document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("return-btn").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu.php", null);
    });
});

async function initMap() {

   // The location of Uluru
  // const LOCATION = {
  //   title: "SLOW RUN RY",
  //   address: {
  //     line1: "Rakuunamäki 11 C",
  //     line2: "50120 Lappeenranta"
  //   },
  //   coords: {
  //     lat: 61.063444549929194,
  //     lng: 28.169665026226696
  //   }
  // };

    const rawData = await fetch(".address.json");
    const LOCATION = await rawData.json();

    // Create the map
    const map = new google.maps.Map(document.getElementById("map"), {
        center: LOCATION.coords,
        zoom: 14,
        zoomControl: true,   // ✅ allows zoom buttons
        scrollwheel: true,   // ✅ allows zoom with mouse wheel
        disableDoubleClickZoom: false,
        draggable: false,    // 🚫 disables moving the map
        mapTypeControl: false,
        streetViewControl: true,
        fullscreenControl: true
    });

  // Optional: Add a marker
  let marker = new google.maps.Marker({
    position: LOCATION.coords,
    map: map,
    title: LOCATION.title,
  });

  document.addEventListener("submit", (e) => {
    e.preventDefault();

    let form = e.target;
    console.log(form.address.value);
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({address: form.address.value}, async (results, status) => {
        if(status == "OK") {
            const newLocation = results[0].geometry.location;
            map.setCenter(newLocation);
            map.setZoom(14);

            if(marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: newLocation,
                map: map
            });

            LOCATION.address.line1 = `${form.address.value} ${form.line1.value}`;
            LOCATION.address.line2 = form.line2.value;
            LOCATION.coords.lat = newLocation.lat();
            LOCATION.coords.lng = newLocation.lng();

            const data = await dUtils.sendDataToServer(null, "./js_php/saveAddress.php", [LOCATION]);
            if(data.status == "ok") {
                console.log(data.keyData);
                alert("Permanent address has changed");
            } else if(data.status == "error") {
                alert("something went wrong while trying storing the address");
            }
        } else {
            console.log("something went wrong");
        }
    });
  });
}

// The JS file is loaded as a module (type="module").
// In modules, functions and variables are not added to the global window object automatically.
// Must export initMap to the global window object because Google Maps API will call window.initMap when loaded.
window.initMap = initMap; // it is essential to export it manually because this file is threated as a module.