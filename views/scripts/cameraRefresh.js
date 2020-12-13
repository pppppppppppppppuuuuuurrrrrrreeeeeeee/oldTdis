function cameraStatus() {
    $.get( "../../model/getCamerasStatus.php", function( data ) {
        let camStatus = JSON.parse(data);
        // console.log(camStatus);
        for(let i = 0; i < camStatus.length; i++)
            document.getElementById(camStatus[i][0]).firstElementChild.style.color = camStatus[i][1];
    } )
}

cameraStatus();
