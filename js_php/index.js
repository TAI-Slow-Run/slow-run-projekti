// Initialize and add the map
let map;

async function initMap() {
    
  // The location of Uluru
  const LOCATION = {
    title: "SLOW RUN RY",
    address: {
      line1: "Rakuunamäki 11 C",
      line2: "50120 Lappeenranta"
    },
    coords: {
      lat: 61.063444549929194,
      lng: 28.169665026226696
    }
  };

  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker"
  );

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: LOCATION.coords,
    mapId: "DEMO_MAP_ID",
  });

  // A marker using a Font Awesome icon for the glyph.
  const icon = document.createElement("div");
  icon.innerHTML = '<i class="uil uil-home"></i>';
  const faPin = new PinElement({
    glyph: icon,
    glyphColor: "#ffffff",
    background: "#eb5b59",
    scale: 1.2,
  });
  const faMarker = new AdvancedMarkerElement({
    map,
    position: LOCATION.coords,
    content: faPin.element,
    title: LOCATION.title,
  });

  const contentString =
    `<div id="content">` +
    `<h1 id="firstHeading" class="firstHeading">${LOCATION.title}</h1>` +
    `<div id="bodyContent">` +
    `<p>${LOCATION.address.line1} ` +
    `</br>` +
    `${LOCATION.address.line2} ` +
    "</div>" +
    "</div>";
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
    ariaLabel: `${LOCATION.title} location`,
  });

  infowindow.open({
    anchor: faMarker,
    map,
  });

}

initMap();
