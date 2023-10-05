// let map;
// let marker;
// // init maps for loop cluster



// // // initMap is now async
// async function initMap() {
//     // Request libraries when needed, not in the script tag.
//     // const position = { lat: -0.4939613021104909, lng: 117.12136581261049 };
//     const { Map } = await google.maps.importLibrary("maps");
//     // Short namespaces can be used.
//     map = new Map(document.getElementById("map"), {
//         center: { lat: -0.4939613021104909, lng: 117.12136581261049 },
//         zoom: 12,

//     });

//     const marker = new google.maps.Marker({
//             title: "Marked",
//             draggable: true,
//         });

//     //menambahkan add event listener jika ada fungsi klik pada maps
//     google.maps.event.addListener(map, "click", function (event){
//         //menambahkan posisi
//         marker.setPosition(event.latLng);

//         const PositionMarker = marker.getPosition();
//         const clickLat = PositionMarker.lat();
//         const clickLng = PositionMarker.lng();
//         //simpan data lat dan lng ke form ketika di klik
//         document.getElementById('latitude').value = clickLat;
//         document.getElementById('longitude').value = clickLng;
//     });
//     const PopUpContent = new google.maps.InfoWindow({
//         content: "Marked",
//     });
//     google.maps.event.addListener(marker, "dragend", function(event) {
//         const newPosition = event.latLng;
//         const newLat = newPosition.lat();
//         const newLng = newPosition.lng();

//         //simpan data lat dan lng ke form di geser
//         document.getElementById('latitude').value = newLat;
//         document.getElementById('longitude').value = newLng;


//     });
//     google.maps.event.addListener(marker, "click", function() {
//         PopUpContent.open(map, marker);
//     });
//     marker.setMap(map);
// }
