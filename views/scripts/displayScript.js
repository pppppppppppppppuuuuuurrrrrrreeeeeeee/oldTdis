var vehicle = {};
var sentIds = [];
vehicle.Accuracy  = null;
vehicle.CameraID = null;
vehicle.ColorFrameNumber = null;
vehicle.Direction = null;
vehicle.ID = null;
vehicle.ImageAddress = null;
vehicle.Lane = null;
vehicle.PassedTime = null;
vehicle.MasterPlateValue = null;
vehicle.ProcessedFrames = null;
vehicle.Speed = null;
vehicle.Suspicious = null;
vehicle.Wanted = null;

var queryVehilces;
var vehicleIndex;

var PlateImage = "";
var VehicleImage = "";

// var loader = document.querySelector('#loader');
var transParent = document.getElementsByClassName('transParent');
var btn = document.getElementsByClassName('btn');

var Root;
$.ajax({
    type: "get",
    url: "./model/getRoot.php",
    async: false,
    success: function(data) {
        Root = data;
    }
}).fail(function(jqXHR, textStatus, error) {
    alert('request to getRoot failed!');
});

////////////////////socket client//////////////////
let sio = server = `${Root}:3000`;
var socket = io(server);
socket.on('connect', () => {
    console.log('client connected !');
    socket.on('recordId', (recordId) => {
        sentIds.push(recordId);
        vehicleInfo(vehicleIndex);
        console.log(recordId);
    });
});


var policeStatus;
$.ajax({
    type: "get",
    url: "./model/policeStatus.php",
    async: false,
    success: function(data) {
        policeStatus = JSON.parse(data);
        // console.log(policeStatus);
    }
}).fail(function(jqXHR, textStatus, error) {
    alert('request to policeStatus failed!');
});

var policeStatusFake;
$.ajax({
    type: "get",
    url: "./model/policeMessage.php",
    async: false,
    success: function(data) {
        policeStatusFake = JSON.parse(data);
    }
}).fail(function(jqXHR, textStatus, error) {
    alert('request to policeStatusMeassage failed!');
});


function readFile(imgAddr, plateAddr, callback) {
    var xhr = new XMLHttpRequest();
    var reader = new FileReader();
    xhr.open("GET", imgAddr, true);
    xhr.responseType = "blob";
    xhr.onload = function(e) {
        reader.onload = function(event) {
            var rslt = event.target.result;
            VehicleImage = rslt.substr(rslt.indexOf("base64,") + 7);
            xhr.open("GET", plateAddr, true);
            xhr.responseType = "blob";
            xhr.onload = function(e) {
                reader.onload = function(event) {
                    var rslt = event.target.result;
                    PlateImage = rslt.substr(rslt.indexOf("base64,") + 7);
                    callback(true);
                }
                var plateFile = this.response;
                reader.readAsDataURL(plateFile)
            };
            xhr.send();
        }
        var imgFile = this.response;
        reader.readAsDataURL(imgFile);
    };
    xhr.send();
}

$.get("./model/getCameraPoles.php", function(data) {
    data = JSON.parse(data);
    for(let i = 0; i < data.length; i++) {
        let pole = document.createElement('option');
        pole.innerHTML = data[i].PoleName;
        pole.setAttribute('selected', 'selected');
        document.getElementById('poles').appendChild(pole);
    }
});

function sendPacket(url, packet, callback) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onloadend = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText.includes("errorCode>0") || xmlhttp.responseText.includes("errorCode> 0")) {
                callback("Successful");
            } else {
                var indx1 = xmlhttp.responseText.indexOf("message>", 0);
                var indx2 = xmlhttp.responseText.indexOf("<", indx1 + 8);
                let messageVal = xmlhttp.responseText.substr(indx1 + 8, indx2 - indx1 - 8);
                callback(messageVal);
            }
        } else {
            callback("false");
        }
    }

    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader('Content-Type', 'text/xml');
    xmlhttp.send(packet);
}

function hourChecker() {
    let passedTime = document.getElementById('TDpassedTime').innerText;
    console.log(passedTime);
    passedTime = passedTime.split(' ')[1];
    hour = passedTime.split(':')[0];
    let hs = ['21', '22', '23', '00', '01', '02', '03'];
    if(hs.indexOf(hour) !== -1) 
        return true;
    return false;
}

function question() {
    if(hourChecker()) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
    
    
        swalWithBootstrapButtons.fire({
            title: '',
            text: ":?????? ???????? ?????????? ???? ???????????? ????????",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '????????',
            cancelButtonText: '???????? ??????????',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    sendToPolice();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    maneeTaradod();
                }
            })
    } else {
        sendToPolice();
    }
}

function maneeTaradod() {
    console.log('taradod');

    let TwoFirstNum = convertToEnglishNum(document.getElementById("boxNumber1").value);
    let Alphabet = document.getElementById("boxNumber2").value;
    let ThreeNum =convertToEnglishNum(document.getElementById("boxNumber3").value);
    let TwoLastNum = convertToEnglishNum(document.getElementById("boxNumber4").value);
    let MasterPlateValue = readPlate();

    let Pre = "";
    if (Alphabet == "??????")
        Pre = "11";
    else if (Alphabet == "??")
        Pre = "12";
    else if (Alphabet == "??")
        Pre = "13";
    else
        Pre = "10";

    PlateNo = TwoFirstNum + alphaToNum(Alphabet) + ThreeNum + TwoLastNum;
    PPlateNo = Pre + "0" + TwoLastNum + "00000000" + alphaToNumPolice(Alphabet) + TwoFirstNum + ThreeNum;

    createPacket(PPlateNo, 'taradod', function(val) {
        if (val == "false") {
            alert('???????????? ???? ???????? ?????????? ?????????? ???????? ??????????????');
        }
        else if (val != "true") {
            alert(val);
        } else {
            let Edited = 0;
            if (PlateNo != MasterPlateValue) {
                Edited = 1;
            }
            change('n');
        }
    });

}

function sendToPolice() {
    console.log('soorat');
    $.post("./model/vehiclePoliceStatus.php", {
        passId: document.getElementById('TDrecordID').innerText
    }, function(data, status) {
        if(data == "true") {
            alert('?????? ?????????? ???????? ???????? ???????? ?????????? ?????? ??????');
            return;
        }
    });
    
    //fake sending
    let cameraIdTd = queryVehilces[vehicleIndex].CameraID;
    let shartStatus = policeStatusFake.indexOf(cameraIdTd);
    if(shartStatus != -1) {
        //enable loader
        // for(let i = 0; i < transParent.length; i++) {
        //     transParent[i].style.opacity = '30%';
        // }
        // for(let i = 0; i < btn.length; i++) {
        //     btn[i].disabled = true;
        // }
        // loader.className = "col-sm-12 showSpinner";
        
        setTimeout(() => {
            alert('???????????? ???? ???????? ???????? ?????????? ???????? ????????!');
            //diable loader
            // loader.className = "col-sm-12 disSpinner";
            // for(let i = 0; i < transParent.length; i++) {
            //     transParent[i].style.opacity = '100%';
            // }
            // for(let i = 0; i < btn.length; i++) {
            //     btn[i].disabled = false;
            // }
            // console.log('fake');
        }, 4000);

        return;
    }

    let TwoFirstNum = convertToEnglishNum(document.getElementById("boxNumber1").value);
    let Alphabet = document.getElementById("boxNumber2").value;
    let ThreeNum =convertToEnglishNum(document.getElementById("boxNumber3").value);
    let TwoLastNum = convertToEnglishNum(document.getElementById("boxNumber4").value);
    let MasterPlateValue = readPlate();
    
    let speedch = document.getElementById('TDspeed').innerText;
    if(speedch < 70) {
        alert('???????? ?????? ???????????????? ???????? ???? ???? ????????????');
        return;
    }

    let Pre = "";
    if (Alphabet == "??????")
        Pre = "11";
    else if (Alphabet == "??")
        Pre = "12";
    else if (Alphabet == "??")
        Pre = "13";
    else
        Pre = "10";

    PlateNo = TwoFirstNum + alphaToNum(Alphabet) + ThreeNum + TwoLastNum;
    PPlateNo = Pre + "0" + TwoLastNum + "00000000" + alphaToNumPolice(Alphabet) + TwoFirstNum + ThreeNum;

    createPacket(PPlateNo, 'soraat', function(val) {
        if (val == "false") {
            alert('Can not connect to server');
        }
        else if (val != "true") {
            alert(val);
        } else {
            let Edited = 0;
            if (PlateNo != MasterPlateValue) {
                Edited = 1;
            }
            sentIds.push(document.getElementById('TDrecordID').innerText);
            console.log(sentIds);
            change('n');
        }
    });

}

function createPacket(plateNo, packetStatus, callback) {
    //enable loader
    // for(let i = 0; i < transParent.length; i++) {
    //     transParent[i].style.opacity = '30%';
    // }
    // for(let i = 0; i < btn.length; i++) {
    //     btn[i].disabled = true;
    // }
    // loader.className = "col-sm-12 showSpinner";


    let PassedTime = document.getElementById('TDpassedTime').innerText;
    let soapPacket = "";

    let flag = true;
    let cameraCode;
    let Password;
    let Username;

    $.ajax({
        type: "post",
        url: "./model/getCameraSendInfo.php",
        async: false,
        data: {
            id: document.getElementById('TDcameraID').innerHTML
        },
        success: function(data) {
            if(data == 'NULL') {
                alert('?????????????? ???????????? ???????? ?????????? ???? ?????????? ?????????? ?????????????? !');
                flag = false;
            } else {
                data = JSON.parse(data);
                cameraCode = data.cameraCode;
                Password = data.Password;
                Username = data.Username;
            }
        }
    }).fail(function(jqXHR, textStatus, error) {
        alert('request to get camera Send info failed!');
        flag = false;
    });




    if(flag === false) {
        //diable loader
        // loader.className = "col-sm-12 disSpinner";
        // for(let i = 0; i < transParent.length; i++) {
        //     transParent[i].style.opacity = '100%';
        // }
        // for(let i = 0; i < btn.length; i++) {
        //     btn[i].disabled = false;
        // }
        return;
    }


    console.log('cameraCode', cameraCode);
    console.log('Password', Password);
    console.log('Username', Username);

    let IsInternal = "1";
    let Version = "0.0.1";
    let ViolationAddress = "-";
    let dateTime = PassedTime.split(" ");
    let date = dateTime[0].split("-");
    let violationDate = gregorian_to_jalali(parseInt(date[0]), parseInt(date[1]), parseInt(date[2]));
    let violationTime = dateTime[1].substr(0, 5);
    let ViolationOccureDate = violationDate + " " + violationTime;
    let ViolationTypeCode = "";
 
    let Speed = document.getElementById('TDspeed').innerText;

    if(packetStatus == 'soraat') {
        if(Speed >= 70 && Speed <= 90)
            ViolationTypeCode = "2056";
        else if(Speed > 90 && Speed <= 110)
            ViolationTypeCode = "2008";
        else if(Speed > 110)
            ViolationTypeCode = "2002";
    } else if(packetStatus == 'taradod') {
        ViolationTypeCode = "2182";
    }

     console.log("vio:"+ViolationTypeCode);


    soapPacket += '<?xml version="1.0" encoding="UTF-8"?>' +
    '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ns1="http://webservice.camera.rahvar.nrdc.com/">' +
    '<SOAP-ENV:Body><ns1:addCameraWarningDTO><clientCameraDTO>' +
    '<ns1:cameraCode>' + cameraCode + '</ns1:cameraCode>' +
    '<ns1:cameraWarningDesc></ns1:cameraWarningDesc>' +
    '<ns1:errorCode></ns1:errorCode>' +
    '<ns1:isInternal>' + IsInternal + '</ns1:isInternal>' +
    '<ns1:message></ns1:message>' +
    '<ns1:password>' + Password + '</ns1:password>' +
    '<ns1:plateImageConvert></ns1:plateImageConvert>' +
    '<ns1:plateNo>' + plateNo + '</ns1:plateNo>' +
    '<ns1:speed>' + Speed + '</ns1:speed>' +
    '<ns1:userName>' + Username + '</ns1:userName>' +
    '<ns1:vehicleColor></ns1:vehicleColor>' +
    '<ns1:vehicleImageConvert></ns1:vehicleImageConvert>' +
    '<ns1:vehicleSystem></ns1:vehicleSystem>' +
    '<ns1:vehicleUsage></ns1:vehicleUsage>' +
    '<ns1:version>' + Version + '</ns1:version>' +
    '<ns1:violationAddress>' + ViolationAddress + '</ns1:violationAddress>' +
    '<ns1:violationOccureDate>' + ViolationOccureDate + '</ns1:violationOccureDate>' +
    '<ns1:violationTypeCode>' + ViolationTypeCode + '</ns1:violationTypeCode>' +
    '<ns1:warningId></ns1:warningId>';

    console.log(soapPacket);

    let ImageAddress = document.getElementById('primaryImg').src;
    let PlateAddress = document.getElementById('pelakImg').src;
    readFile(ImageAddress, PlateAddress, function(val) {
        if (val == true) {
            soapPacket += '<ns1:plateImage>' + PlateImage + '</ns1:plateImage>' +
                '<ns1:vehicleImage>' + VehicleImage + '</ns1:vehicleImage>' +
                '</clientCameraDTO></ns1:addCameraWarningDTO></SOAP-ENV:Body>' +
                '</SOAP-ENV:Envelope>';
            //alert('creating packet finished!');
            console.log("soapPack:"+soapPacket);
            $.ajax({
                type: "post",
                url: "sendsoapreq.php",
                async: false,
                data:{
                    url: "http://10.30.138.12:8001/WebServiceCamera/services/AddCameraWarning?wsdl",
                    soapPacket: soapPacket
                },
                success: function(returnValue) {
                    //diable loader
                    // loader.className = "col-sm-12 disSpinner";
                    // for(let i = 0; i < transParent.length; i++) {
                    //     transParent[i].style.opacity = '100%';
                    // }
                    // for(let i = 0; i < btn.length; i++) {
                    //     btn[i].disabled = false;
                    // }

                      //alert(returnValue);
                    console.log("returnValue:"+returnValue);
                    if (returnValue == "") {
                        alert('???????????? ???? ???????? ???????? ?????????????????? ????????');
                        callback("false");
                    } else if (returnValue.includes("successfully")) {
                        alert('?????????? ???? ???????????? ???????? ???????? ?????????? ????');
                        verify();
                        callback("true");
                    } else {
                        var parser, xmlDoc;
                        parser = new DOMParser();
                        xmlDoc = parser.parseFromString(returnValue,"text/xml");
                        alert('???????? ?????????? :' + xmlDoc.getElementsByTagName("ns1:message")[0].childNodes[0].nodeValue);
                        //   callback(returnValue);
                        $.post('packetProblems.php', {
                            returnValue: returnValue,
                            recId: document.querySelector('#TDrecordID').innerText
                        });  
                    }
                }
            }).fail(function(jqXHR, textStatus, error) {
                 //diable loader
                // loader.className = "col-sm-12 disSpinner";
                // for(let i = 0; i < transParent.length; i++) {
                //     transParent[i].style.opacity = '100%';
                // }
                // for(let i = 0; i < btn.length; i++) {
                //     btn[i].disabled = false;
                // }

                alert('???????????? ???? ???????? ???????????? ???? ???????? ?????????? ????');
            });
        }
    });

}

function alphaToNumPolice(alpha) {
    if (alpha == "??????") return "01";
    else if (alpha == "??") return "02";
    else if (alpha == "??") return "21";
    else if (alpha == "??") return "03";
    else if (alpha == "??") return "25";
    else if (alpha == "??") return "04";
    else if (alpha == "??") return "19";
        // else if (alpha == "??") return "08";
    // else if (alpha == "??") return "09";
    else if (alpha == "??") return "05";
    // else if (alpha == "??") return "11";
    else if (alpha == "??") return "17";
    else if (alpha == "??") return "23";
    //   else if (alpha == "??") return "14";
    else if (alpha == "??") return "06";
    else if (alpha == "??") return "24";
    else if (alpha == "??") return "07";
    // else if (alpha == "??") return "18";
    else if (alpha == "??") return "08";
    // else if (alpha == "??") return "20";
    else if (alpha == "??") return "09";
    // else if (alpha == "??") return "22";
    else if (alpha == "??") return "20";
    else if (alpha == "??") return "10";
    else if (alpha == "??") return "18";
    else if (alpha == "??") return "22";
    else if (alpha == "??") return "11";
    else if (alpha == "??") return "12";
    else if (alpha == "??") return "13";
    else if (alpha == "??") return "14";
    else if (alpha == "??") return "15";
    else if (alpha == "??") return "16";
    else if (alpha == "D") return "33";
    else if (alpha == "S") return "34";
}


function reportRec() {
    let recId = document.getElementById('TDrecordID').innerText;
    let customRadio = document.getElementsByName('customRadio');
    let status = '?????????? ????????';
    for(let i = 0; i < customRadio.length; i++) {
        if(customRadio[i].checked) {
            status = customRadio[i].getAttribute('status');
        }
    }
    $.post("./model/reportStatus.php", {
        id: recId,
        status: status
    },
    function(data) {
        if(data =="true"){
            alert('?????????? ?????? ???? ???????????? ?????????? ????');
        } else {
            alert('?????????? ???? ?????????? ?????????? ?????? ??????');
        }
    });
}

function changeCameraText(anchor) {
    let txt = anchor.innerText.replace("videocam", "");
    txt = txt.replace("_off", "");
    document.querySelector("#camera").value = txt;
}

function gregorian_to_jalali(gy, gm, gd) {
    let g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
    let jy;
    if (gy > 1600) {
        jy = 979;
        gy -= 1600;
    } else {
        jy = 0;
        gy -= 621;
    }
    let gy2 = (gm > 2) ? (gy + 1) : gy;
    let days = (365 * gy) + (parseInt((gy2 + 3) / 4)) - (parseInt((gy2 + 99) / 100)) + (parseInt((gy2 + 399) / 400)) - 80 + gd + g_d_m[gm - 1];
    jy += 33 * (parseInt(days / 12053));
    days %= 12053;
    jy += 4 * (parseInt(days / 1461));
    days %= 1461;
    if (days > 365) {
        jy += parseInt((days - 1) / 365);
        days = (days - 1) % 365;
    }
    let jm = (days < 186) ? 1 + parseInt(days / 31) : 7 + parseInt((days - 186) / 30);
    let jd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));
    let resultY = jy;
    let resultM = jm < 10 ? "0" + jm.toString() : jm.toString();
    let resultD = jd < 10 ? "0" + jd.toString() : jd.toString();
    var today = resultY + '/' + resultM + '/' + resultD;
    return today;
}

function getNPassedDate(n) {
    var today = new Date();
    today.setDate(today.getDate() - n);
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    return gregorian_to_jalali(yyyy, mm, dd);
}

function getCurrentDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    return gregorian_to_jalali(yyyy, mm, dd);
}

function submit() {
    let poles = $("#poles").val();

    let startDate = document.getElementById('startDate').value;
    let startTime = document.getElementById('startTime').value;
    let endDate = document.getElementById('endDate').value;
    let endTime = document.getElementById('endTime').value;

    let minSpeed = document.getElementById('connectedSlider').children[0].children[0].children[0].getAttribute('data-value');
    let maxSpeed = document.getElementById('connectedSlider').children[0].children[1].children[0].getAttribute('data-value');

    let minAcc = document.getElementById('connectedSlider2').children[0].children[0].children[0].getAttribute('data-value');
    let maxAcc = document.getElementById('connectedSlider2').children[0].children[1].children[0].getAttribute('data-value');

    let light = document.getElementById('light');
    let heavy = document.getElementById('heavy');

    if( ! (light.checked || heavy.checked) ) {
        alert('?????? ???????? ?????????? ?????? ???? ???? ???????? ?????????? ???? ???????????? ????????!');
        return;
    }

    let types = [];
    if(light.checked) {
        types.push(1);
    }
    if(heavy.checked) {
        types.push(2);
    } 

    let lane1 = document.getElementById("lane1").checked;
    let lane2 = document.getElementById("lane2").checked;
    let lane3 = document.getElementById("lane3").checked;
    let lane4 = document.getElementById("lane4").checked;


    if( !(lane1 || lane2 || lane3 || lane4) ){
        alert('?????? ???????? ?????????? ???? ???????? ???????????? ????????');
        return;
    }

    let lanes = [];

    if(lane1)
        lanes.push(1);
    if(lane2)
        lanes.push(2);
    if(lane3)
        lanes.push(3);
    if(lane4)
        lanes.push(4);
    
    // console.log(cameras);
    // console.log(startDate);
    // console.log(startTime);
    // console.log(endDate);
    // console.log(endTime);

    // console.log('speed');
    // console.log(minSpeed);
    // console.log(maxSpeed);

    // console.log('acc');
    // console.log(minAcc);
    // console.log(maxAcc);

    // console.log(lanes);
    // console.log(types);
    console.log(poles);
    $.post("./model/readVehicles.php",
    {
        poles: JSON.stringify(poles),
        startDate: startDate,
        startTime: startTime,
        endDate: endDate,
        endTime: endTime,
        minAcc: minAcc,
        maxAcc: maxAcc,
        minSpeed: minSpeed,
        maxSpeed: maxSpeed,
        lanes: JSON.stringify(lanes),
        types: JSON.stringify(types)
    },
    function(data,status){
        // console.log(data);
        queryVehilces = JSON.parse(data);
        // console.log( queryVehilces);
        if( queryVehilces.length == 0 ) {
            alert('???????????? ???? ?????? ???????? ?? ?????????? ?????? ???????? ??????');

            document.getElementById('counterOf').innerHTML = `0 / 0`;
            document.getElementById('TDrecordID').innerHTML = '';
            document.getElementById('TDcameraID').innerHTML = '';
            // document.getElementById('TDrecordPlate').innerHTML = '';
            document.getElementById('TDpassedTime').innerHTML = '';
            document.getElementById('TDpassedTimeShow').innerHTML = '';
            document.getElementById('TDlane').innerHTML = '';
            document.getElementById('TDspeed').innerHTML = '';
            document.getElementById('TDacc').innerHTML = '';
            document.getElementById('primaryImg').src = `./views/imgs/No Image.png`;
            document.getElementById('pelakImg').src = `./views/imgs/No Tag.png`;
        
            document.getElementById('boxNumber1').value = '';
            document.getElementById('boxNumber2').value = '';
            document.getElementById('boxNumber3').value = '';
            document.getElementById('boxNumber4').value = '';
            return;
        }
        document.getElementById('counterOf').innerHTML = `1 / ${queryVehilces.length}`;
        vehicleIndex = 0;
        vehicleInfo(vehicleIndex);
    });
}
function convertToEnglishNum(str) {
    let newstr = '';
    for (let i = 0; i < str.length; i++) {
        if(str[i] == '??')
            newstr += '0';
        else if(str[i] == '??')
            newstr +='1';
        else if(str[i] == '??')
            newstr += '2';
        else if(str[i] == '??')
            newstr += '3';   
        else if(str[i] == '??')
            newstr += '4';   
        else if(str[i] == '??')
            newstr += '5';   
        else if(str[i] == '??')
            newstr += '6';   
        else if(str[i] == '??')
            newstr += '7';   
        else if(str[i] == '??')
            newstr += '8';   
        else if(str[i] == '??')
            newstr += '9';
	else
            newstr += str[i];   
    }
    // console.log(newstr);
    return newstr;
}

function convertToPersianNum(str) {
    let newstr = '';
    for (let i = 0; i < str.length; i++) {
        if(str[i] == '0')
            newstr += '??';
        else if(str[i] == '1')
            newstr += '??';
        else if(str[i] == '2')
            newstr += '??';
        else if(str[i] == '3')
            newstr += '??';   
        else if(str[i] == '4')
            newstr += '??';   
        else if(str[i] == '5')
            newstr += '??';   
        else if(str[i] == '6')
            newstr += '??';   
        else if(str[i] == '7')
            newstr += '??';   
        else if(str[i] == '8')
            newstr += '??';   
        else if(str[i] == '9')
            newstr += '??';
   	else
            newstr += str[i];
    }
    return newstr;
}

function vehicleInfo(index) {
    let shart = sentIds.indexOf(queryVehilces[index].ID);
    if(shart != -1) {
        queryVehilces[index].police = 1;
    }
    let cameraIdTd = queryVehilces[index].CameraID;
    let shartStatus = policeStatus.indexOf(cameraIdTd);
    if(shartStatus != -1) {
        queryVehilces[index].police = 1;
    }
    
    if( queryVehilces[index].police == 0 ) {
        document.querySelector('#btnPolice').disabled = false;
    } else {
        document.querySelector('#btnPolice').disabled = true;
    }


    document.getElementById('TDrecordID').innerHTML = queryVehilces[index].ID;
    document.getElementById('TDcameraID').innerHTML = queryVehilces[index].CameraID;
    // document.getElementById('TDrecordPlate').innerHTML = queryVehilces[index].MasterPlateValue;
    document.getElementById('TDpassedTime').innerHTML = queryVehilces[index].PassedTime;
    let TDpassedTimeShow = queryVehilces[index].PassedTime;
    let dateTime = TDpassedTimeShow.split(' ');
    let date = dateTime[0].split('-');
    date = gregorian_to_jalali(parseInt(date[0]), parseInt(date[1]), parseInt(date[2]));
    document.getElementById('TDpassedTimeShow').innerHTML = date + ' ' + dateTime[1];
    document.getElementById('TDlane').innerHTML = queryVehilces[index].Lane;
    document.getElementById('TDspeed').innerHTML = queryVehilces[index].Speed;
    document.getElementById('TDacc').innerHTML = queryVehilces[index].Accuracy;
    let imgI = queryVehilces[index].ImageAddress[0];
    let imgP = queryVehilces[index].ImageAddress[0].replace('I.jpg', 'P.jpg')
    document.getElementById('primaryImg').src = `${Root}/store/${imgI}`;
    document.getElementById('pelakImg').src = `${Root}/store/${imgP}`;

    let pelak = queryVehilces[index].MasterPlateValue;
    document.getElementById('boxNumber1').value = (pelak.slice(0, 2));
    document.getElementById('boxNumber2').value = numToAlpha(parseInt(pelak.slice(2, 4)));
    document.getElementById('boxNumber3').value = (pelak.slice(4, 7));
    document.getElementById('boxNumber4').value = (pelak.slice(7, 9));

    observe();
}




function change(str) {

    if(str == 'p') {
    if(vehicleIndex == 0)
    	alert('?????? ???? ?????? ?????????? ?????????? ?????????? ?????? ???????? ??????');
    if(vehicleIndex >= 1)
	    vehicleIndex -= 1;
    } else {
    if(vehicleIndex == queryVehilces.length - 1)
    	alert('?????? ???? ?????? ?????????? ?????????? ?????????? ???????? ??????????');
    if(vehicleIndex < queryVehilces.length - 1)
	    vehicleIndex += 1;
    }

    document.getElementById('counterOf').innerHTML = `${vehicleIndex + 1} / ${queryVehilces.length}`;
    

    vehicleInfo(vehicleIndex);
}

function readonly() {
    if(document.getElementById('boxNumber1').readOnly == true) {
        document.getElementById('boxNumber1').readOnly = false;
    } else{
        document.getElementById('boxNumber1').readOnly = true;
    }

    if(document.getElementById('boxNumber2').readOnly == true) {
        document.getElementById('boxNumber2').readOnly = false;
    } else{
        document.getElementById('boxNumber2').readOnly = true;
    }

    if(document.getElementById('boxNumber3').readOnly == true) {
        document.getElementById('boxNumber3').readOnly = false;
    } else{
        document.getElementById('boxNumber3').readOnly = true;
    }

    if(document.getElementById('boxNumber4').readOnly == true) {
        document.getElementById('boxNumber4').readOnly = false;
    } else{
        document.getElementById('boxNumber4').readOnly = true;
    }




    if(document.getElementById('eSubmit').style.display == 'none') {
        document.getElementById('eSubmit').style.display = '';
    } else{
        document.getElementById('eSubmit').style.display = 'none';
    }
    if(document.getElementById('eReject').style.display == 'none') {
        document.getElementById('eReject').style.display = '';
    } else{
        document.getElementById('eReject').style.display = 'none';
    }
    if(document.getElementById('eEdit').style.display == 'none') {
        document.getElementById('eEdit').style.display = '';
    } else{
        document.getElementById('eEdit').style.display = 'none';
    }
}

function reject() {
    //disable boxes
    document.getElementById('boxNumber1').readOnly = true;
    document.getElementById('boxNumber2').readOnly = true;
    document.getElementById('boxNumber3').readOnly = true;
    document.getElementById('boxNumber4').readOnly = true;
    //disable submit and reject
    document.getElementById('eSubmit').style.display = 'none';
    document.getElementById('eReject').style.display = 'none';
    //enable edit
    document.getElementById('eEdit').style.display = '';
}

function readPlate() {
    let box1 = convertToEnglishNum(document.getElementById('boxNumber1').value);
    let box2 = alphaToNum(document.getElementById('boxNumber2').value);
    let box3 = convertToEnglishNum(document.getElementById('boxNumber3').value);
    let box4 = convertToEnglishNum(document.getElementById('boxNumber4').value);
    return box1 + box2 + box3 + box4;
}

function observe() {
    let plate = readPlate();
    let id = document.getElementById('TDrecordID').innerText;
    let user = document.getElementById('user').value;
    let TDcameraID = document.getElementById('TDcameraID').innerText
    $.post("./model/observe.php",
    {
        recordID: id,
        plate: plate,
        userID: user,
	    TDcameraID: TDcameraID,
        status: 0
    },
    function(data,status){
        //  console.log(data);
        // if(data != 'true') {
        //     alert(`there is a problem with this record ${data}`)
        // }
    });
}

function edit() {

    let plate = readPlate();
    let id = document.getElementById('TDrecordID').innerText;
    let user = document.getElementById('user').value;

    $.post("./model/edit.php",
    {
        recordID: id,
        plate: plate,
        userID: user,
        status: 1
    },
    function(data,status){
        // console.log(data);
        if(data == 'true') {
            alert('???????? ???? ???????????? ?????????? ????');
            queryVehilces[vehicleIndex].MasterPlateValue = plate;
        } else {
            alert('?????????? ???? ?????????? ???????? ?????? ??????!');
        }
        vehicleInfo(vehicleIndex);
    });
    // reject();
}

function deleteRec() {
    let id = document.getElementById('TDrecordID').innerText;
    let plate = readPlate();
    let user = document.getElementById('user').value;
    $.post("./model/delete.php",
    {
        recordID: id,
        plate: plate,
        userID: user,
        status: 2
    },
    function(data,status){
        // console.log(data);
        if(data == 'true') {
            alert('?????????? ???? ???????????? ?????? ????');
        } else {
            alert('?????? ?????????? ???? ???????? ?????????? ????')
        }
    });
    queryVehilces.splice(vehicleIndex, 1);
    change('n');
}





function verify(){
    let ID = document.getElementById('TDrecordID').innerText;

    //send cameraID to multiserver
    // socket.emit('recordId', ID);

    $.post("./model/post.php", {
        ID: ID
    },
    function(data){
        if(data != 'true') {
            alert(`there is a problem ${data}`);
        }
    });
}



function numToAlpha(num) {
    if (num == "01") return "??????";
    else if (num == "02") return "??";
    else if (num == "03") return "??";
    else if (num == "04") return "??";
    else if (num == "05") return "??";
    else if (num == "06") return "??";
    else if (num == "07") return "??";
    else if (num == "08") return "??";
    else if (num == "09") return "??";
    else if (num == "10") return "??";
    else if (num == "11") return "??";
    else if (num == "12") return "??";
    else if (num == "13") return "??";
    else if (num == "14") return "??";
    else if (num == "15") return "??";
    else if (num == "16") return "??";
    else if (num == "17") return "??";
    else if (num == "18") return "??";
    else if (num == "19") return "??";
    else if (num == "20") return "??";
    else if (num == "21") return "??";
    else if (num == "22") return "??";
    else if (num == "23") return "??";
    else if (num == "24") return "??";
    else if (num == "25") return "??";
    else if (num == "26") return "??";
    else if (num == "27") return "??";
    else if (num == "28") return "??";
    else if (num == "29") return "??";
    else if (num == "30") return "??";
    else if (num == "31") return "??";
    else if (num == "32") return "??";
    else if (num == "33") return "D";
    else if (num == "34") return "S";
}

function alphaToNum(alpha) {
    if (alpha == "??????") return "01";
    else if (alpha == "??") return "02";
    else if (alpha == "??") return "03";
    else if (alpha == "??") return "04";
    else if (alpha == "??") return "05";
    else if (alpha == "??") return "06";
    else if (alpha == "??") return "07";
        // else if (alpha == "??") return "08";
    // else if (alpha == "??") return "09";
    else if (alpha == "??") return "10";
    // else if (alpha == "??") return "11";
    else if (alpha == "??") return "12";
    else if (alpha == "??") return "13";
    //   else if (alpha == "??") return "14";
    else if (alpha == "??") return "15";
    else if (alpha == "??") return "16";
    else if (alpha == "??") return "17";
    // else if (alpha == "??") return "18";
    else if (alpha == "??") return "19";
    // else if (alpha == "??") return "20";
    else if (alpha == "??") return "21";
    // else if (alpha == "??") return "22";
    else if (alpha == "??") return "23";
    else if (alpha == "??") return "24";
    else if (alpha == "??") return "25";
    else if (alpha == "??") return "26";
    else if (alpha == "??") return "27";
    else if (alpha == "??") return "28";
    else if (alpha == "??") return "29";
    else if (alpha == "??") return "30";
    else if (alpha == "??") return "31";
    else if (alpha == "??") return "32";
    else if (alpha == "D") return "33";
    else if (alpha == "S") return "34";
}

function alphaToNumPolice(alpha) {
    if (alpha == "??????") return "01";
    else if (alpha == "??") return "02";
    else if (alpha == "??") return "21";
    else if (alpha == "??") return "03";
    else if (alpha == "??") return "25";
    else if (alpha == "??") return "04";
    else if (alpha == "??") return "19";
        // else if (alpha == "??") return "08";
    // else if (alpha == "??") return "09";
    else if (alpha == "??") return "05";
    // else if (alpha == "??") return "11";
    else if (alpha == "??") return "17";
    else if (alpha == "??") return "23";
    //   else if (alpha == "??") return "14";
    else if (alpha == "??") return "06";
    else if (alpha == "??") return "24";
    else if (alpha == "??") return "07";
    // else if (alpha == "??") return "18";
    else if (alpha == "??") return "08";
    // else if (alpha == "??") return "20";
    else if (alpha == "??") return "09";
    // else if (alpha == "??") return "22";
    else if (alpha == "??") return "20";
    else if (alpha == "??") return "10";
    else if (alpha == "??") return "18";
    else if (alpha == "??") return "22";
    else if (alpha == "??") return "11";
    else if (alpha == "??") return "12";
    else if (alpha == "??") return "13";
    else if (alpha == "??") return "14";
    else if (alpha == "??") return "15";
    else if (alpha == "??") return "16";
    else if (alpha == "D") return "33";
    else if (alpha == "S") return "34";
}
function getCurrentTime() {
    var today = new Date();
    var hh = today.getHours();
    var mm = today.getMinutes();
    var ss = today.getSeconds();
    if (hh < 10)
        hh = '0' + hh;
    if (mm < 10)
        mm = '0' + mm;
    if (ss < 10)
        ss = '0' + ss;
    return hh + ':' + mm + ':' + ss;
}
