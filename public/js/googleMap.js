let map;


function initMap() {


    // The location
    const compostura = { lat: 39.47437547778825, lng: -0.41921476981752337 };
    // The map center
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: compostura,
    });
    // The marker
    const marker = new google.maps.Marker({
        position: compostura,
        map: map,
    });
}

window.initMap = initMap;