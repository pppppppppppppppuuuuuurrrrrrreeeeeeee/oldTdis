//defining icon class
var LeafIcon = L.Icon.extend({
    options: {
        iconSize:     [25, 25],
        iconAnchor:   [12, 12],
        popupAnchor:  [-1,  -1]
    }
});

L.icon = function (options) {
    return new L.Icon(options);
};
///////////////////////////

var map = L.map('map', {zoomControl: false}).setView([35.411176, 51.586411], 11);
// //disable
// map.dragging.disable();
// map.touchZoom.disable();
// map.doubleClickZoom.disable();
// map.scrollWheelZoom.disable();


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);


    
$.get( "./model/leaflet.php", function( data ) {
    let cams = JSON.parse(data);
    // console.log(cams);
    for(let i = 0; i < cams.length; i++) {
        let cam = new LeafIcon({iconUrl: '../pr/views/imgs/blue.png'});
        let info = `
    <div class="row">
        <div class="col-sm-12">
            <img src="../store/${cams[i][1].ImageAddress[0]}" style="width:300px; height: 200px;" />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span><b>Plate:</b> <br />
            ${cams[i][1].PlateValue}</span>
        </div>
        <div class="col-sm-3">
            <span><b>lane:</b> <br />
            ${cams[i][1].Lane}</span>
        </div>
        <div class="col-sm-3">
            <span><b>time:</b> <br />
            ${cams[i][1].PassedTime}</span>
        </div>
        <div class="col-sm-3">
            <span><b>type:</b> <br />
            ${cams[i][1].VehicleType}</span>
        </div>
    </div>
        `;
        L.marker([cams[i][0].latitude, cams[i][0].longitude], {icon: cam}).addTo(map).bindPopup(info);
    }
});

map.invalidateSize();
