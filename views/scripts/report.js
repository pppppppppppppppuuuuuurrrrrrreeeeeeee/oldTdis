function formatDate(str) {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if(str == 'haftepish') {
        d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate() - 7,
        year = d.getFullYear();
    }

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
function timeChange(inp) {
    if ( inp.id == 'userDataBase' ){
        document.querySelector('#startDate').value = formatDate('haftepish');
        document.querySelector('#endDate').value = formatDate();
    }
        
    else {
        document.querySelector('#startDate').value = "2013-10-08";
        document.querySelector('#endDate').value = "2013-10-12";
    }
        
}


function opt() {
    let show = document.querySelector('#camerasInp');
    let options = Array.from(document.querySelector('#cams').children);
    let arr = [];
    options.forEach(function(elm) {
        if( elm.selected == true) {
            arr.push(elm.innerText);
        }
    });
    if( document.querySelector('#allCams').selected ) {
        show.innerText = 'تمام دوربین ها';
    }
    else {
        show.innerText = arr.join();
    }
    // console.log(options);
}

function optUser() {
    let show = document.querySelector('#usersInp');
    let options = Array.from(document.querySelector('#users').children);
    let arr = [];
    options.forEach(function(elm) {
        if( elm.selected == true) {
            arr.push(elm.innerText);
        }
    });
    if( document.querySelector('#allUsers').selected ) {
        show.innerText = 'تمام کاربران';
    }
    else {
        show.innerText = arr.join();
    }
    // console.log(options);
}

function optOper() {
    let show = document.querySelector('#operationsInp');
    let options = Array.from(document.querySelector('#operations').children);
    let arr = [];
    options.forEach(function(elm) {
        if( elm.selected == true) {
            arr.push(elm.innerText);
        }
    });
    if( document.querySelector('#allOperations').selected ) {
        show.innerText = 'تمام عملیات';
    }
    else {
        show.innerText = arr.join();
    }
    // console.log(options);
}

function disableFilds() {
    let flag = document.querySelector('#userDataBase').checked;
    let users = document.querySelector('#divUsers');
    let operations = document.querySelector('#divOperations');

    let vehicleTypeDiv = document.querySelector('#vehicleTypeDiv');
    let AccuracyDiv = document.querySelector('#AccuracyDiv');
    let directionDiv = document.querySelector('#directionDiv');
    let speedDiv = document.querySelector('#speedDiv');
    let laneDiv = document.querySelector('#laneDiv');
    let plateDiv = document.querySelector('#plateDiv');
    let WhitelistSuspiciousDiv = document.querySelector('#WhitelistSuspiciousDiv');
    let CameraDiv = document.querySelector('#CameraDiv');

    if( !flag ){
        users.style.display = 'none';
        operations.style.display = 'none';

        vehicleTypeDiv.style.display = '';
        AccuracyDiv.style.display = '';
        directionDiv.style.display = '';
        speedDiv.style.display = '';
        laneDiv.style.display = '';
        plateDiv.style.display = '';
        WhitelistSuspiciousDiv.style.display = '';
        CameraDiv.style.display = '';

    } else {
        users.style.display = '';
        operations.style.display = '';

        vehicleTypeDiv.style.display = 'none';
        AccuracyDiv.style.display = 'none';
        directionDiv.style.display = 'none';
        speedDiv.style.display = 'none';
        laneDiv.style.display = 'none';
        plateDiv.style.display = 'none';
        WhitelistSuspiciousDiv.style.display = 'none';
        CameraDiv.style.display = 'none';
    }
}

function readPlate() {
    let box1 = document.getElementById('boxNumber1').value;
    let box2 = alphaToNum(document.getElementById('boxNumber2').value);
    let box3 = document.getElementById('boxNumber3').value;
    let box4 = document.getElementById('boxNumber4').value;
    return box1 + box2 + box3 + box4;
}

$.get( "../../model/report.php?cameras", function( data ) {
    cams = JSON.parse(data);
    let select = document.querySelector('#cams');
    // console.log(cams);
    cams.forEach(cam => {
        let opt = document.createElement('option');
        opt.setAttribute('onclick', 'opt()');
        opt.innerHTML = cam;
        select.appendChild(opt);
    });
});

$.get( "../../model/report.php?users", function( data ) {
    usersArr = JSON.parse(data);
    let users = document.querySelector('#users');
    // console.log(usersArr);
    usersArr.forEach(us => {
        let opt = document.createElement('option');
        opt.setAttribute('onclick', 'optUser()');
        opt.innerHTML = us;
        users.appendChild(opt);
    });
});

function getData() {
    let startDate = document.querySelector('#startDate').value;
    let startTime = document.querySelector('#startTime').value;
    let endDate = document.querySelector('#endDate').value;
    let endTime = document.querySelector('#endTime').value;
    let lightVehicle = document.querySelector('#lightVehicle').checked;
    let heavyVehicle = document.querySelector('#heavyVehicle').checked;
    let unkownVehicle = document.querySelector('#unkownVehicle').checked;
    let upToDown = document.querySelector('#upToDown').checked;
    let downToUp = document.querySelector('#downToUp').checked;
    let startSpeed = document.querySelector('#startSpeed').value;
    let endSpeed = document.querySelector('#endSpeed').value;
    let lane1 = document.querySelector('#lane1').checked;
    let lane2 = document.querySelector('#lane2').checked;
    let lane3 = document.querySelector('#lane3').checked;
    let lane4 = document.querySelector('#lane4').checked;
    let lane5 = document.querySelector('#lane5').checked;
    let lane6 = document.querySelector('#lane6').checked;
    let plate = readPlate();
    let whiteList = document.querySelector('#whiteList').checked;
    let suspicious = document.querySelector('#suspicious').checked;

    let camerasInp = document.querySelector('#camerasInp').innerText;
    let usersInp = document.querySelector('#usersInp').innerText;
    let operationsInp = document.querySelector('#operationsInp').innerText;

    let html = document.querySelector('#html').checked;
    let pdf = document.querySelector('#pdf').checked;

    let cameraDataBase = document.querySelector('#cameraDataBase').checked;
    let userDataBase = document.querySelector('#userDataBase').checked;

    let startAcc = document.querySelector('#startAcc').value;
    let endAcc = document.querySelector('#endAcc').value;

    if( plate.search('undefined') != -1 && plate.length != 'undefined'.length ) {
        alert('Your Plate format is incorrect!');
        return;
    }

    //times
    if(startDate.length == 0) {
        alert('start date cannot be empty!');
        return;
    }
    if(startTime.length == 0) {
        alert('start time cannot be empty!');
        return;
    }
    if(endDate.length == 0) {
        alert('end date cannot be empty!');
        return;
    }
    if(endTime.length == 0) {
        alert('end time cannot be empty!');
        return;
    }

// lightVehicle
// heavyVehicle
// unkownVehicle
    if( !(lightVehicle || heavyVehicle || unkownVehicle) ) {
        alert('you must select at least one type of vehicle!');
        return;
    }

// upToDown
// downToUp
    if( !(upToDown || downToUp) ) {
        alert('you must select at least one direction!');
        return;
    }

//lanes
    if( !( lane1 || lane2 || lane3 || lane4 || lane5 || lane6 ) ) {
        alert('you must select at least one lane!');
        return;
    }

    $.post("../../model/report.php",
    {
        startDate: startDate,
        startTime: startTime,
        endDate: endDate,
        endTime: endTime,
        lightVehicle: lightVehicle,
        heavyVehicle: heavyVehicle,
        unkownVehicle: unkownVehicle,
        upToDown: upToDown,
        downToUp: downToUp,
        startSpeed: startSpeed,
        endSpeed: endSpeed,
        lane1: lane1,
        lane2: lane2,
        lane3: lane3,
        lane4: lane4,
        lane5: lane5,
        lane6: lane6,
        plate: plate,
        whiteList: whiteList,
        suspicious: suspicious,
        camerasInp: camerasInp,
        usersInp: usersInp,
        operationsInp: operationsInp,
        html: html,
        pdf: pdf,
        cameraDataBase: cameraDataBase,
        userDataBase: userDataBase,
        startAcc: startAcc,
        endAcc: endAcc
    },
    function(data,status){
       // console.log(data);
        // document.location.href = data;
        javascript:void(window.open(data, '_blank'));
  //
    });

    // console.log('cameraDataBase', cameraDataBase);
    // console.log('userDataBase', userDataBase);
    // console.log('startDate', startDate);
    // console.log('startTime', startTime);
    // console.log('endDate', endDate);
    // console.log('endTime', endTime);
    // console.log('lightVehicle', lightVehicle);
    // console.log('heavyVehicle', heavyVehicle);
    // console.log('unkownVehicle', unkownVehicle);
    // console.log('upToDown', upToDown);
    // console.log('downToUp', downToUp);
    // console.log('startSpeed', startSpeed);
    // console.log('endSpeed', endSpeed);
    // console.log('lane1', lane1);
    // console.log('lane2', lane2);
    // console.log('lane3', lane3);
    // console.log('lane4', lane4);
    // console.log('lane5', lane5);
    // console.log('lane6', lane6);

    // console.log('plate', plate);
    // console.log('whiteList', whiteList);

    // console.log('suspicious', suspicious);
    // console.log('camerasInp', camerasInp);
    // console.log('operationsInp', operationsInp);
    // console.log('usersInp', usersInp);

    // console.log('html', html);
    // console.log('pdf', pdf);
}



function alphaToNum(alpha) {
    if (alpha == "الف") return "01";
    else if (alpha == "ب") return "02";
    else if (alpha == "پ") return "03";
    else if (alpha == "ت") return "04";
    else if (alpha == "ث") return "05";
    else if (alpha == "ج") return "06";
    else if (alpha == "چ") return "07";
        // else if (alpha == "ح") return "08";
    // else if (alpha == "خ") return "09";
    else if (alpha == "د") return "10";
    // else if (alpha == "ذ") return "11";
    else if (alpha == "ر") return "12";
    else if (alpha == "ز") return "13";
    //   else if (alpha == "ژ") return "14";
    else if (alpha == "س") return "15";
    else if (alpha == "ش") return "16";
    else if (alpha == "ص") return "17";
    // else if (alpha == "ض") return "18";
    else if (alpha == "ط") return "19";
    // else if (alpha == "ظ") return "20";
    else if (alpha == "ع") return "21";
    // else if (alpha == "غ") return "22";
    else if (alpha == "ف") return "23";
    else if (alpha == "ق") return "24";
    else if (alpha == "ک") return "25";
    else if (alpha == "گ") return "26";
    else if (alpha == "ل") return "27";
    else if (alpha == "م") return "28";
    else if (alpha == "ن") return "29";
    else if (alpha == "و") return "30";
    else if (alpha == "ه") return "31";
    else if (alpha == "ی") return "32";
    else if (alpha == "D") return "33";
    else if (alpha == "S") return "34";
}

function numToAlpha(num) {
    if (num == "01") return "الف";
    else if (num == "02") return "ب";
    else if (num == "03") return "پ";
    else if (num == "04") return "ت";
    else if (num == "05") return "ث";
    else if (num == "06") return "ج";
    else if (num == "07") return "چ";
    else if (num == "08") return "ح";
    else if (num == "09") return "خ";
    else if (num == "10") return "د";
    else if (num == "11") return "ذ";
    else if (num == "12") return "ر";
    else if (num == "13") return "ز";
    else if (num == "14") return "ژ";
    else if (num == "15") return "س";
    else if (num == "16") return "ش";
    else if (num == "17") return "ص";
    else if (num == "18") return "ض";
    else if (num == "19") return "ط";
    else if (num == "20") return "ظ";
    else if (num == "21") return "ع";
    else if (num == "22") return "غ";
    else if (num == "23") return "ف";
    else if (num == "24") return "ق";
    else if (num == "25") return "ک";
    else if (num == "26") return "گ";
    else if (num == "27") return "ل";
    else if (num == "28") return "م";
    else if (num == "29") return "ن";
    else if (num == "30") return "و";
    else if (num == "31") return "ه";
    else if (num == "32") return "ی";
    else if (num == "33") return "D";
    else if (num == "34") return "S";
}


