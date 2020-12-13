function convertToEnglishNum(str) {
  let newstr = '';
  for (let i = 0; i < str.length; i++) {
      if(str[i] == '۰')
          newstr += '0';
      else if(str[i] == '۱')
          newstr +='1';
      else if(str[i] == '۲')
          newstr += '2';
      else if(str[i] == '۳')
          newstr += '3';   
      else if(str[i] == '۴')
          newstr += '4';   
      else if(str[i] == '۵')
          newstr += '5';   
      else if(str[i] == '۶')
          newstr += '6';   
      else if(str[i] == '۷')
          newstr += '7';   
      else if(str[i] == '۸')
          newstr += '8';   
      else if(str[i] == '۹')
          newstr += '9';
      else
          newstr += str[i];   
  }
  // console.log(newstr);
  return newstr;
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

kamaDatepicker('startDate',  {
    buttonsColor: "red",
    markToday: true,
    markHolidays: true,
    sync: true
});
kamaDatepicker('endDate',  {
    buttonsColor: "red",
    markToday: true,
    markHolidays: true,
    sync: true
});

var startDate = getNPassedDate(1);
var stopDate = getCurrentDate();
var startTime = getCurrentTime();
var stopTime = getCurrentTime();
document.getElementById("startDate").value = startDate;
document.getElementById("endDate").value = stopDate;
document.getElementById("startTime").value = startTime;
document.getElementById("endTime").value = stopTime;








function checkPlateInputs(id, type, e) {
    let numberKeyCode = { 48: "0", 49: "1", 50: "2", 51: "3", 52: "4", 53: "5", 54: "6", 55: "7", 56: "8", 57: "9" };
    let alphabetKeyCode = {
      72: "الف",
      70: "ب",
      77: "پ",
      220: "پ",
      74: "ت",
      69: "ث",
      219: "ج",
      221: "چ",
      78: "د",
      86: "ر",
      67: "ز",
      83: "س",
      65: "ش",
      87: "ص",
      88: "ط",
      85: "ع",
      84: "ف",
      82: "ق",
      186: "ک",
      222: "گ",
      71: "ل",
      76: "م",
      75: "ن",
      188: "و",
      73: "ﻫ",
      68: "ی",
    };
    let value = $("#" + id).val();
    if (type == "numberWithOut0") {
      if ((event.keyCode >= 49 && event.keyCode <= 57) || event.keyCode == 16) {
        if (event.keyCode != 16) {
          e.value = e.value.substr(0, e.value.length - 1);
        }
        if (numberKeyCode[event.keyCode] == undefined) {
          value = "";
        } else {
          value = numberKeyCode[event.keyCode];
        }
        $("#" + id).val($("#" + id).val() + value);
        value = $("#" + id).val();
        value = value.replace(/[0]/g, "");
        value = value.replace(/\D/g, "");
        $("#" + id).val(value);
      } else {
        value = value.replace(/[0]/g, "");
        value = value.replace(/\D/g, "");
        $("#" + id).val(value);
        return;
      }
    } else if (type == "numberWith0") {
      if ((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode == 16) {
        if (event.keyCode != 16) {
          e.value = e.value.substr(0, e.value.length - 1);
        }
        if (numberKeyCode[event.keyCode] == undefined) {
          value = "";
        } else {
          value = numberKeyCode[event.keyCode];
        }
        $("#" + id).val($("#" + id).val() + value);
        value = $("#" + id).val();
        value = value.replace("00", "");
        value = value.replace(/\D/g, "");
        if (value.charAt(0) == 0) {
          value = value.substr(1);
        }
        $("#" + id).val(value);
      } else {
        value = value.replace("00", "");
        if (value.charAt(0) == 0) {
          value = value.substr(1);
        }
        value = value.replace(/\D/g, "");
        $("#" + id).val(value);
        return;
      }
    } else if (event.shiftKey && type == "alphabet") {
      if (event.keyCode == 68) {
        $("#" + id).val("D");
      } else if (event.keyCode == 83) {
        $("#" + id).val("S");
      } else {
        e.value = e.value.substr(0, e.value.length - 1);
      }
    } else if ((type == "alphabet" && event.keyCode >= 65 && event.keyCode <= 222) || event.keyCode == 32) {
      if (alphabetKeyCode[event.keyCode] == undefined) {
        value = "";
      } else {
        value = alphabetKeyCode[event.keyCode];
      }
      $("#" + id).val(value);
    } else {
      if (numberKeyCode[event.keyCode] == undefined) {
        return;
      } else {
        e.value = e.value.substr(0, e.value.length - 1);
      }
    }
  }
  
  
  function innerJoinShow() {
    let check = document.querySelector('#join').checked;
    if(check === true) {
      document.querySelector('#usrObs').style.display = '';
      document.querySelector('#usrEdi').style.display = '';
      document.querySelector('#usrDel').style.display = '';
      document.querySelector('#usrSen').style.display = '';
      document.querySelector('#UsrcolsDiv').style.display = '';
    } else {
      document.querySelector('#usrObs').style.display = 'none';
      document.querySelector('#usrEdi').style.display = 'none';
      document.querySelector('#usrDel').style.display = 'none';
      document.querySelector('#usrSen').style.display = 'none';
      document.querySelector('#UsrcolsDiv').style.display = 'none';
    }
  }

  $('#cameraNames').select2();
  $('#cameraIds').select2();

  //columns
  $('#cols').select2();
  $('#Usrcols').select2();

  //read Cols
  $.post("./query.php", {
    status: 'readPassedCols'
  }, function(data, status) {
    data = JSON.parse(data);
    let cols = document.querySelector('#cols');
    for(let i = 0; i < data.length; i++) {
      if(data[i] == 'ID') {
        continue;
      }
      let option = document.createElement('option');
      option.selected = true;
      option.innerHTML = data[i];
      cols.appendChild(option);
    }
  });

  $.post("./query.php", {
    status: 'readUsrCols'
  }, function(data, status) {
    data = JSON.parse(data);
    let cols = document.querySelector('#Usrcols');
    for(let i = 0; i < data.length; i++) {
      if(data[i] == 'passedVehicleRecordID') {
        continue;
      }
      let option = document.createElement('option');
      option.selected = true;
      option.innerHTML = data[i];
      cols.appendChild(option);
    }
  });

  //read cameras
  $.post("./query.php",{
    status: 'readCams'
  },
  function(data,status){
    data = JSON.parse(data);
    let cameraNames = document.querySelector('#cameraNames');
    let cameraIds = document.querySelector('#cameraIds');
    console.log(data);
    for(let i = 0; i < data.length; i++) {
      let nameOption = document.createElement('option');
      nameOption.innerHTML = data[i][1];
      cameraNames.appendChild(nameOption);

      let idOption = document.createElement('option');
      idOption.innerHTML = data[i][0];
      cameraIds.appendChild(idOption);
    }
  });


function allCamerasCheck() {
  let checkbox = document.getElementById('allNames');
  if (checkbox.checked) {
    $('#cameraNames').val(null);
    $('#cameraNames').trigger('change');
    document.getElementById('cameraNames').disabled = true;
  } else {
    document.getElementById('cameraNames').disabled = false;
  }
}
allCamerasCheck();

function allCamerasIDS() {
  let checkbox = document.getElementById('allIDS');
  if (checkbox.checked) {
    $('#cameraIds').val(null);
    $('#cameraIds').trigger('change');
    document.getElementById('cameraIds').disabled = true;
  } else {
    document.getElementById('cameraIds').disabled = false;
  }
}
allCamerasIDS();

function allUsrsObs() {
  let checkbox = document.getElementById('allUsrsObs');
  if (checkbox.checked) {
    $('#UserOBS').val(null);
    $('#UserOBS').trigger('change');
    document.getElementById('UserOBS').disabled = true;
  } else {
    document.getElementById('UserOBS').disabled = false;
  }
}
allUsrsObs();

function allUsrsEdi() {
  let checkbox = document.getElementById('allUsrsEdi');
  if (checkbox.checked) {
    $('#usrEDIT').val(null);
    $('#usrEDIT').trigger('change');
    document.getElementById('usrEDIT').disabled = true;
  } else {
    document.getElementById('usrEDIT').disabled = false;
  }
}
allUsrsEdi();

function allusrDEL() {
  let checkbox = document.getElementById('allusrDEL');
  if (checkbox.checked) {
    $('#usrDEL').val(null);
    $('#usrDEL').trigger('change');
    document.getElementById('usrDEL').disabled = true;
  } else {
    document.getElementById('usrDEL').disabled = false;
  }
}
allusrDEL();

function allustSENT() {
  let checkbox = document.getElementById('allustSENT');
  if (checkbox.checked) {
    $('#ustSENT').val(null);
    $('#ustSENT').trigger('change');
    document.getElementById('ustSENT').disabled = true;
  } else {
    document.getElementById('ustSENT').disabled = false;
  }
}
allustSENT();


//read users
$.post("./query.php",{
  status: 'readUsers'
},
function(data,status){
  data = JSON.parse(data);
  console.log(data);
  let UserOBS = document.querySelector('#UserOBS');
  let usrEDIT = document.querySelector('#usrEDIT');
  let usrDEL = document.querySelector('#usrDEL');
  let ustSENT = document.querySelector('#ustSENT');
  for(let i = 0; i < data.length; i++) {
    let nameOption = document.createElement('option');
    nameOption.innerHTML = data[i];
    UserOBS.appendChild(nameOption);
  }

  for(let i = 0; i < data.length; i++) {
    let nameOption = document.createElement('option');
    nameOption.innerHTML = data[i];
    usrEDIT.appendChild(nameOption);
  }

  for(let i = 0; i < data.length; i++) {
    let nameOption = document.createElement('option');
    nameOption.innerHTML = data[i];
    usrDEL.appendChild(nameOption);
  }

  for(let i = 0; i < data.length; i++) {
    let nameOption = document.createElement('option');
    nameOption.innerHTML = data[i];
    ustSENT.appendChild(nameOption);
  }
});

//users
$('#UserOBS').select2();
$('#usrEDIT').select2();
$('#usrDEL').select2();
$('#ustSENT').select2();




function submit(boll) {
  //enable loader
  document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center show';
  document.body.style.opacity = '50%';


   //times 
   let startDate = document.querySelector('#startDate').value;
   let startTime = document.querySelector('#startTime').value;
   let endDate = document.querySelector('#endDate').value;
   let endTime = document.querySelector('#endTime').value;
 
   if(startDate == null || startDate == ''){
     alert('Start date cant be empty');
     return;
   }
   if(startTime == null || startTime == ''){
     alert('Start time cant be empty');
     return;
   }
   if(endDate == null || endDate == ''){
     alert('end date cant be empty');
     return;
   }
   if(endTime == null || endTime == ''){
     alert('end time cant be empty');
     return;
   }
 
   //camera
   let cameraNames = null;
   let cameraNamescheckBox = document.querySelector('#allNames');
   if(!cameraNamescheckBox.checked && cameraNames != "") {
     cameraNames = $('#cameraNames').val().toString();
   }
   if (cameraNames == ""){
     alert('You must select at least one camera name');
     return;
   }
 
 
   let cameraIds = null;
   let cameraIdscheckBox = document.querySelector('#allIDS');
   if(!cameraIdscheckBox.checked) {
     cameraIds = $('#cameraIds').val().toString();
   }
   if (cameraIds == ""){
     alert('You must select at least one camera id');
     return;
   }
 
   //Accuracy
   let AccuracyMin = document.querySelector('#minAccuracy').value;
   let AccuracyMax = document.querySelector('#maxAccuracy').value;
 
   //Speed
   let minSpeed = document.querySelector('#minSpeed').value;
   let maxSpeed = document.querySelector('#maxSpeed').value;
 
   //Lane Number
   let lane1 = document.querySelector('#lane1').checked;
   let lane2 = document.querySelector('#lane2').checked;
   let lane3 = document.querySelector('#lane3').checked;
   let lane4 = document.querySelector('#lane4').checked;
   let lane5 = document.querySelector('#lane5').checked;
   // console.log('lane1', lane1);
   // console.log('lane2', lane2);
   // console.log('lane3', lane3);
   // console.log('lane4', lane4);
   // console.log('lane5', lane5);
 
   //Direction
   let upToDown = document.querySelector('#upToDown').checked;
   let downToUp = document.querySelector('#downToUp').checked;
   let vehicleUnkown = document.querySelector('#vehicleUnkown').checked;
   // console.log('upToDown', upToDown);
   // console.log('downToUp', downToUp);
 
   //Vehicle
   let vehicleLight = document.querySelector('#vehicleLight').checked;
   let vehicleHeavy = document.querySelector('#vehicleHeavy').checked;
   // console.log('vehicleLight', vehicleLight);
   // console.log('vehicleHeavy', vehicleHeavy);
   
 
   //Custom Plate
   let box1 = convertToEnglishNum(document.getElementById('boxNumber1').value);
   let box2 = alphaToNum(document.getElementById('boxNumber2').value);
   let box3 = convertToEnglishNum(document.getElementById('boxNumber3').value);
   let box4 = convertToEnglishNum(document.getElementById('boxNumber4').value);
   for(let i = box1.toString().length; i < 2; i++) {
     box1 += '_';
   }
   if(box2 == null || box2 == '') {
     box2 = '__';
   }
   for(let i = box3.toString().length; i < 3; i++) {
     box3 += '_';
   }
   for(let i = box4.toString().length; i < 2; i++) {
     box4 += '_';
   }
   let plate = box1 + box2 + box3 + box4;
   // console.log(plate);
   let cols = $("#cols").val();
   if(cols.length < 1) {
     alert('You must select at least 1 camera column!');
     return;
   }
   cols.push('ID');
 
   //inner join
   let innerJoin = document.querySelector('#join').checked;
   if(!innerJoin) {
     $.ajax({
      type: "post",
      url: './query.php',
      async: false,
      data: {
        status: 'PassedVehicleRecords',
        boll: boll,
        cols: cols.toString(),
        startDate: startDate,
        startTime: startTime,
        endDate: endDate,
        endTime: endTime,
        cameraNames: cameraNames,
        cameraIds: cameraIds,
        AccuracyMin: AccuracyMin,
        AccuracyMax: AccuracyMax,
        minSpeed: minSpeed,
        maxSpeed: maxSpeed,
        lane1: lane1,
        lane2: lane2,
        lane3: lane3,
        lane4: lane4,
        lane5: lane5,
        upToDown: upToDown,
        downToUp: downToUp,
        vehicleLight: vehicleLight,
        vehicleHeavy: vehicleHeavy,
        vehicleUnkown: vehicleUnkown,
        plate: plate
      },
      success: function(data) {
        //dislabe loader
        document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center hide';
         document.body.style.opacity = '100%';

        console.log(data);
        if(data == 'no rec!') {
          alert('رکوردی در این بازه ی زمانی با فیلتر های در خواستی شما یافت نشد!');
        } else if(data == 'fail') {
          alert('ساخت فایل با مشکل مواجه شد!');
        }else if(Number.isInteger(parseInt(data))) {
          alert(`${data} سطر یافت شد!`)
        } 
        else {
          javascript:void(window.open( window.location.href  + data, '_blank'));
        }
      } 
     }).fail(function(jqXHR, textStatus, error) {
        alert('request failed');
      });
 
   } else {
       let allUsrsObs = document.querySelector('#allUsrsObs').checked;
       let allUsrsEdi = document.querySelector('#allUsrsEdi').checked;
       let allusrDEL = document.querySelector('#allusrDEL').checked;
       let allustSENT = document.querySelector('#allustSENT').checked;
 
       let usrObs = "AllOftheUsers";
       let usrEdi = "AllOftheUsers";
       let usrDEL = "AllOftheUsers";
       let usrSENT = "AllOftheUsers";
 
       let Usrcols = $("#Usrcols").val();
       if(Usrcols.length < 1) {
         alert('You must select at least 1 user column!');
         return;
       }
       Usrcols.push('passedVehicleRecordID');
 
       if(!allUsrsObs) {
         usrObs = $('#UserOBS').val().toString();
       }
       if(!allUsrsEdi) {
         usrEdi = $('#usrEDIT').val().toString();
       }
       if(!allusrDEL) {
         usrDEL = $('#usrDEL').val().toString();
       }
       if(!allustSENT) {
         usrSENT = $('#ustSENT').val().toString();
       }
       // console.log('usrObs', usrObs);
       // console.log('usrEdi', usrEdi);
       // console.log('usrDEL', usrDEL);
       // console.log('usrSENT', usrSENT);
       $.ajax({
        type: "post",
        url: './query.php',
        async: false,
        data:{
          status: 'innerJoin',
         boll: boll,
         cols: cols.toString(),
         Usrcols: Usrcols.toString(),
         startDate: startDate,
         startTime: startTime,
         endDate: endDate,
         endTime: endTime,
         cameraNames: cameraNames,
         cameraIds: cameraIds,
         AccuracyMin: AccuracyMin,
         AccuracyMax: AccuracyMax,
         minSpeed: minSpeed,
         maxSpeed: maxSpeed,
         lane1: lane1,
         lane2: lane2,
         lane3: lane3,
         lane4: lane4,
         lane5: lane5,
         upToDown: upToDown,
         downToUp: downToUp,
         vehicleLight: vehicleLight,
         vehicleHeavy: vehicleHeavy,
         vehicleUnkown: vehicleUnkown,
         plate: plate,
         usrObs: usrObs,
         usrEdi: usrEdi,
         usrDEL: usrDEL,
         usrSENT: usrSENT
        },
        success: function(data) {
                  //dislabe loader
        document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center hide';
        document.body.style.opacity = '100%';

          console.log(data);
          if(data == 'no rec!') {
            alert('رکوردی در این بازه ی زمانی با فیلتر های در خواستی شما یافت نشد!');
          } else if(data == 'fail') {
            alert('ساخت فایل با مشکل مواجه شد!');
          }else if(Number.isInteger(parseInt(data))) {
            alert(`${data} سطر یافت شد!`)
          } 
          else {
            javascript:void(window.open( window.location.href  + data, '_blank'));
          }
        }
         
       }).fail(function(jqXHR, textStatus, error) {
        alert('request failed');
      });
 
   }
}

function zip() {
    //enable loader
    document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center show';
    document.body.style.opacity = '50%';

   var boll = 'true';
   //times 
   let startDate = document.querySelector('#startDate').value;
   let startTime = document.querySelector('#startTime').value;
   let endDate = document.querySelector('#endDate').value;
   let endTime = document.querySelector('#endTime').value;
 
   if(startDate == null || startDate == ''){
     alert('Start date cant be empty');
     return;
   }
   if(startTime == null || startTime == ''){
     alert('Start time cant be empty');
     return;
   }
   if(endDate == null || endDate == ''){
     alert('end date cant be empty');
     return;
   }
   if(endTime == null || endTime == ''){
     alert('end time cant be empty');
     return;
   }
 
   //camera
   let cameraNames = null;
   let cameraNamescheckBox = document.querySelector('#allNames');
   if(!cameraNamescheckBox.checked && cameraNames != "") {
     cameraNames = $('#cameraNames').val().toString();
   }
   if (cameraNames == ""){
     alert('You must select at least one camera name');
     return;
   }
 
 
   let cameraIds = null;
   let cameraIdscheckBox = document.querySelector('#allIDS');
   if(!cameraIdscheckBox.checked) {
     cameraIds = $('#cameraIds').val().toString();
   }
   if (cameraIds == ""){
     alert('You must select at least one camera id');
     return;
   }
 
   //Accuracy
   let AccuracyMin = document.querySelector('#minAccuracy').value;
   let AccuracyMax = document.querySelector('#maxAccuracy').value;
 
   //Speed
   let minSpeed = document.querySelector('#minSpeed').value;
   let maxSpeed = document.querySelector('#maxSpeed').value;
 
   //Lane Number
   let lane1 = document.querySelector('#lane1').checked;
   let lane2 = document.querySelector('#lane2').checked;
   let lane3 = document.querySelector('#lane3').checked;
   let lane4 = document.querySelector('#lane4').checked;
   let lane5 = document.querySelector('#lane5').checked;
   // console.log('lane1', lane1);
   // console.log('lane2', lane2);
   // console.log('lane3', lane3);
   // console.log('lane4', lane4);
   // console.log('lane5', lane5);
 
   //Direction
   let upToDown = document.querySelector('#upToDown').checked;
   let downToUp = document.querySelector('#downToUp').checked;
   let vehicleUnkown = document.querySelector('#vehicleUnkown').checked;
   // console.log('upToDown', upToDown);
   // console.log('downToUp', downToUp);
 
   //Vehicle
   let vehicleLight = document.querySelector('#vehicleLight').checked;
   let vehicleHeavy = document.querySelector('#vehicleHeavy').checked;
   // console.log('vehicleLight', vehicleLight);
   // console.log('vehicleHeavy', vehicleHeavy);
   
 
   //Custom Plate
   let box1 = convertToEnglishNum(document.getElementById('boxNumber1').value);
   let box2 = alphaToNum(document.getElementById('boxNumber2').value);
   let box3 = convertToEnglishNum(document.getElementById('boxNumber3').value);
   let box4 = convertToEnglishNum(document.getElementById('boxNumber4').value);
   for(let i = box1.toString().length; i < 2; i++) {
     box1 += '_';
   }
   if(box2 == null || box2 == '') {
     box2 = '__';
   }
   for(let i = box3.toString().length; i < 3; i++) {
     box3 += '_';
   }
   for(let i = box4.toString().length; i < 2; i++) {
     box4 += '_';
   }
   let plate = box1 + box2 + box3 + box4;
   // console.log(plate);
   let cols = $("#cols").val();
   if(cols.length < 1) {
     alert('You must select at least 1 camera column!');
     return;
   }
   cols.push('ID');
 
   //inner join
   let innerJoin = document.querySelector('#join').checked;
   if(!innerJoin) {
    $.ajax({
      type: "post",
      url: './query.php',
      async: false,
      data: {
        status: 'PassedVehicleRecordsZip',
        boll: boll,
        cols: cols.toString(),
        startDate: startDate,
        startTime: startTime,
        endDate: endDate,
        endTime: endTime,
        cameraNames: cameraNames,
        cameraIds: cameraIds,
        AccuracyMin: AccuracyMin,
        AccuracyMax: AccuracyMax,
        minSpeed: minSpeed,
        maxSpeed: maxSpeed,
        lane1: lane1,
        lane2: lane2,
        lane3: lane3,
        lane4: lane4,
        lane5: lane5,
        upToDown: upToDown,
        downToUp: downToUp,
        vehicleLight: vehicleLight,
        vehicleHeavy: vehicleHeavy,
        vehicleUnkown: vehicleUnkown,
        plate: plate
      },
      success: function(data) {
        //dislabe loader
        document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center hide';
         document.body.style.opacity = '100%';

        console.log(data);
        if(data == 'no rec!') {
          alert('رکوردی در این بازه ی زمانی با فیلتر های در خواستی شما یافت نشد!');
        } else if(data == 'fail') {
          alert('ساخت فایل با مشکل مواجه شد!');
        }else if(Number.isInteger(parseInt(data))) {
          alert(`${data} سطر یافت شد!`)
        } 
        else {
          path = data.replace('index.html', '');
          $.post('./zip.php', {
            path: path
          }, function(data, status) {
            javascript:void(window.open( window.location.href  + data, '_blank'));
          });
        }
      } 
     }).fail(function(jqXHR, textStatus, error) {
        alert('request failed');
      });
 
   } else {
       let allUsrsObs = document.querySelector('#allUsrsObs').checked;
       let allUsrsEdi = document.querySelector('#allUsrsEdi').checked;
       let allusrDEL = document.querySelector('#allusrDEL').checked;
       let allustSENT = document.querySelector('#allustSENT').checked;
 
       let usrObs = "AllOftheUsers";
       let usrEdi = "AllOftheUsers";
       let usrDEL = "AllOftheUsers";
       let usrSENT = "AllOftheUsers";
 
       let Usrcols = $("#Usrcols").val();
       if(Usrcols.length < 1) {
         alert('You must select at least 1 user column!');
         return;
       }
       Usrcols.push('passedVehicleRecordID');
 
       if(!allUsrsObs) {
         usrObs = $('#UserOBS').val().toString();
       }
       if(!allUsrsEdi) {
         usrEdi = $('#usrEDIT').val().toString();
       }
       if(!allusrDEL) {
         usrDEL = $('#usrDEL').val().toString();
       }
       if(!allustSENT) {
         usrSENT = $('#ustSENT').val().toString();
       }
       // console.log('usrObs', usrObs);
       // console.log('usrEdi', usrEdi);
       // console.log('usrDEL', usrDEL);
       // console.log('usrSENT', usrSENT);
       $.ajax({
        type: "post",
        url: './query.php',
        async: false,
        data:{
          status: 'innerJoinZip',
         boll: boll,
         cols: cols.toString(),
         Usrcols: Usrcols.toString(),
         startDate: startDate,
         startTime: startTime,
         endDate: endDate,
         endTime: endTime,
         cameraNames: cameraNames,
         cameraIds: cameraIds,
         AccuracyMin: AccuracyMin,
         AccuracyMax: AccuracyMax,
         minSpeed: minSpeed,
         maxSpeed: maxSpeed,
         lane1: lane1,
         lane2: lane2,
         lane3: lane3,
         lane4: lane4,
         lane5: lane5,
         upToDown: upToDown,
         downToUp: downToUp,
         vehicleLight: vehicleLight,
         vehicleHeavy: vehicleHeavy,
         vehicleUnkown: vehicleUnkown,
         plate: plate,
         usrObs: usrObs,
         usrEdi: usrEdi,
         usrDEL: usrDEL,
         usrSENT: usrSENT
        },
        success: function(data) {
        //dislabe loader
        document.querySelector('#spinner').className = 'col-sm-12 d-flex justify-content-center hide';
        document.body.style.opacity = '100%';

          console.log(data);
          if(data == 'no rec!') {
            alert('رکوردی در این بازه ی زمانی با فیلتر های در خواستی شما یافت نشد!');
          } else if(data == 'fail') {
            alert('ساخت فایل با مشکل مواجه شد!');
          }else if(Number.isInteger(parseInt(data))) {
            alert(`${data} سطر یافت شد!`)
          } 
          else {
            path = data.replace('index.html', '');
            $.post('./zip.php', {
              path: path
            }, function(data, status) {
              javascript:void(window.open( window.location.href  + data, '_blank'));
            });
          }
        }
         
       }).fail(function(jqXHR, textStatus, error) {
        alert('request failed');
      });
 
   }
}