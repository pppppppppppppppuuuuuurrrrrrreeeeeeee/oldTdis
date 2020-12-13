var radio = "radioMap";
  function mod(el) {
    let cam = document.getElementById('camTab');
    let users = document.getElementById('usersTab');
    let map = document.getElementById('mapTab');
    if(el.id == 'radioCam') {
      radio = 'radioCam';
      cam.style.display = '';
      users.style.display = 'none';
      map.style.display = 'none';
    } else if( el.id == 'radioUsr') {
      radio = 'radioUsr';
      cam.style.display = 'none';
      users.style.display = '';
      map.style.display = 'none';
    } else if( el.id == 'radioMap') {
      radio = 'radioMap';
      cam.style.display = 'none';
      users.style.display = 'none';
      map.style.display = '';
    }
    // console.log(el.id);
  }
  mod(document.getElementById('radioMap'));

  function query() {
    if(radio == 'radioMap') {
      map();
    } else if(radio == 'radioUsr') {
      usr();
    } else if(radio == 'radioCam') {
      cam();
    }
  }

  function htmlExport() {
    if(radio == 'radioMap') {
      mapExport();
    } else if(radio == 'radioUsr') {
      usrExport();
    } else if(radio == 'radioCam') {
      camExport();
    }
  }

  function camExport() {
  let startDate = document.querySelector('#startDate').value;
  let startTime = document.querySelector('#startTime').value;
  let endDate = document.querySelector('#endDate').value;
  let endTime = document.querySelector('#endTime').value;

  //load preloader
  document.querySelector('#camLoader').style.display = '';
  document.querySelector('#camTab').style.opacity = '30%';

  $.post("./query.php",{
      query: 'cam',
      startDate: startDate,
      startTime: startTime,
      endDate: endDate,
      endTime: endTime
  },
  function(data,status){
      // let activities = JSON.parse(data);
      let activities = JSON.parse(data);
      console.log(activities);
      let tbody = "";
      for(let i = 0; i < activities.length; i++) {
        tbody += '<tr>';
        tbody += `<td><b>${activities[i].cam}</b></td>`;
        tbody += `<td>${activities[i].CameraObserves}</td>`;
        tbody += `<td>${activities[i].CameraUnseen}</td>`;
        tbody += `<td>${activities[i].CameraEdits}</td>`;
        tbody += `<td>${activities[i].CameraSendToPolice}</td>`;
        tbody += `<td>${activities[i].CameraDIDNTSendToPolice}</td>`;
        tbody += `<td>${activities[i].CameraReports}</td>`;
        tbody += `<td>${activities[i].CameraAllRecives}</td>`;
        tbody += '</tr>';
      }

      let label = [];
      let dataObserve = [];
      let dataUnseen = [];
      let dataRec = [];
      let dataEdits = [];
      let dataSendToPolice = [];
      let dataDIDNTSendToPolice = [];
      let dataReports = [];
      let bgColor = [];

      
      for(let i = 0; i < activities.length; i++) {
          label.push(activities[i].cam);
          dataObserve.push( (activities[i].CameraObserves ) );
          dataUnseen.push( (activities[i].CameraUnseen ) );
          dataEdits.push( (activities[i].CameraEdits) );
          dataSendToPolice.push( (activities[i].CameraSendToPolice) );
          dataDIDNTSendToPolice.push( (activities[i].CameraDIDNTSendToPolice) );
          dataReports.push( (activities[i].CameraReports) );
          dataRec.push( (activities[i].CameraAllRecives) );
          let r = Math.floor(Math.random() * 256);
          let g = Math.floor(Math.random() * 256);
          let b = Math.floor(Math.random() * 256);
          let rgb = `rgb(${r}, ${g}, ${b})`;
          bgColor.push(rgb);
      }

       //unload preloader
      document.querySelector('#camLoader').style.display = 'none';
      document.querySelector('#camTab').style.opacity = '100%';

      //observe
      let obs = document.getElementById('CamObs').getContext('2d');
      let obsPieChart = new Chart(obs, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'Observes Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataObserve
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      //unseen
      let unseen = document.getElementById('CamUnseen').getContext('2d');
      let unsPieChart = new Chart(unseen, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'Observes Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataUnseen
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      //edit
      let edi = document.getElementById('CamEdi').getContext('2d');
      let ediPieChart = new Chart(edi, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'Edits Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataEdits
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });
      //send To police
      let stp = document.getElementById('CamSent').getContext('2d');
      let stpPieChart = new Chart(stp, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'Send To Police Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataSendToPolice
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      //DIDNT sent to Police
      let dIDNTstp = document.getElementById('CamUnsent').getContext('2d');
      let dIDNTstpPieChart = new Chart(dIDNTstp, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'Send To Police Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataDIDNTSendToPolice
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      //Reports
      let rep = document.getElementById('CamRep').getContext('2d');
      let repPieChart = new Chart(rep, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'reports Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataReports
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      //Recive
      let rec = document.getElementById('CamRec').getContext('2d');
      let recPieChart = new Chart(rec, {
          type: 'doughnut',
          data: {
              labels: label,
              datasets: [{
                  label: 'reports Chart',
                  backgroundColor: bgColor,
                  borderColor: 'gray',
                  data: dataRec
              }]
          },
          options: {
              tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      //get the concerned dataset
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      //calculate the total of this data set
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      //get the current items value
                      var currentValue = dataset.data[tooltipItem.index];
                      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                      var percentage = ((currentValue/total) * 100).toFixed(2);
                      let arr = [currentValue];
                      arr.push(percentage + '%');
                      return arr;
                    }
                  }
                } 
          } 
      });

      $.post("./query.php",{
            query: 'repTable',
            startDate: startDate,
            startTime: startTime,
            endDate: endDate,
            endTime: endTime
      },
      function(data,status){
          data= JSON.parse(data);
          console.log(data);
          var repTable = "";
          for(let i = 0; i < data.length; i++) {
            repTable += '<tr>';
            repTable += `<td><b>${data[i][1]}</b></td>`;
            repTable += `<td><b>${data[i][10]}</b></td>`;
            repTable += `<td><b>${data[i][11]}</b></td>`;
            repTable += `<td><b>${data[i][12]}</b></td>`;
            repTable += `<td><b>${data[i][13]}</b></td>`;
            repTable += `<td><b>${data[i][14]}</b></td>`;
            repTable += `<td><b>${data[i][15]}</b></td>`;
            repTable += '</tr>';
        }


          setTimeout(function(){ 
        let CamObsImg = document.querySelector('#CamObs');
        CamObsImg = CamObsImg.toDataURL("image/png");

        let CamUnseenImg = document.querySelector('#CamUnseen');
        CamUnseenImg = CamUnseenImg.toDataURL("image/png");

        let CamEditImg = document.querySelector('#CamEdi');
        CamEditImg = CamEditImg.toDataURL("image/png");

        let CamSentImg = document.querySelector('#CamSent');
        CamSentImg = CamSentImg.toDataURL("image/png");

        let CamUnsentImg = document.querySelector('#CamUnsent');
        CamUnsentImg = CamUnsentImg.toDataURL("image/png");

        let CamRepImg = document.querySelector('#CamRep');
        CamRepImg = CamRepImg.toDataURL("image/png");

        let CamRecImg = document.querySelector('#CamRec');
        CamRecImg = CamRecImg.toDataURL("image/png");



        //send to htmlExp
        $.post("./htmlExp.php",{
            radio: 'cam',
            tbody: tbody,
            CamObsImg: CamObsImg,
            CamUnseenImg: CamUnseenImg,
            CamEditImg: CamEditImg,
            CamSentImg: CamSentImg,
            CamUnsentImg: CamUnsentImg,
            CamRepImg: CamRepImg,
            CamRecImg: CamRecImg,
            repTable: repTable
          },
          function(data,status){
            if(data == 'fail') {
              alert('ساخت فایل گزارش گیری با مشکل مواجه شد !');
            } else {
              javascript:void(window.open( window.location.href  + data, '_blank'));
            }
          }
          );
      }, 2000);

        }
      );

      



  });
  }

  function usrExport() {
    let startDate = document.querySelector('#startDate').value;
    let startTime = document.querySelector('#startTime').value;
    let endDate = document.querySelector('#endDate').value;
    let endTime = document.querySelector('#endTime').value;

    //load preloader
    document.querySelector('#usrLoader').style.display = '';
    document.querySelector('#usersTab').style.opacity = '30%';

    $.post("./query.php",{
        query: 'usr',
        startDate: startDate,
        startTime: startTime,
        endDate: endDate,
        endTime: endTime
    },
    function(data,status){
        // let activities = JSON.parse(data);
        let activities = JSON.parse(data);
        let tbody = "";
        for(let i = 0; i < activities.length; i++) {
          tbody += '<tr>';
          tbody += `<td><b>${activities[i].user}</b></td>`;
          tbody += `<td>${activities[i].observes}</td>`;
          tbody += `<td>${activities[i].edits}</td>`;
          tbody += `<td>${activities[i].sendToPolice}</td>`;
          tbody += `<td>${activities[i].reports}</td>`;
          tbody += '</tr>';
        }

        console.log(activities);
        let label = [];
        let dataObserve = [];
        let dataEdits = [];
        let dataSendToPolice = [];
        let dataReports = [];
        let bgColor = [];

        
        for(let i = 0; i < activities.length; i++) {
            label.push(activities[i].user);
            dataObserve.push( (activities[i].observes ) );
            dataEdits.push( (activities[i].edits) );
            dataSendToPolice.push( (activities[i].sendToPolice) );
            dataReports.push( (activities[i].reports) );
            let r = Math.floor(Math.random() * 256);
            let g = Math.floor(Math.random() * 256);
            let b = Math.floor(Math.random() * 256);
            let rgb = `rgb(${r}, ${g}, ${b})`;
            bgColor.push(rgb);
        }

        //unload preloader
        document.querySelector('#usrLoader').style.display = 'none';
        document.querySelector('#usersTab').style.opacity = '100%';

        //observe
        let obs = document.getElementById('observes').getContext('2d');
        let obsPieChart = new Chart(obs, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'Observes Chart',
                    backgroundColor: bgColor,
                    borderColor: 'gray',
                    data: dataObserve
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        //calculate the total of this data set
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                          return previousValue + currentValue;
                        });
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var percentage = ((currentValue/total) * 100).toFixed(2);
                        let arr = [currentValue];
                        arr.push(percentage + '%');
                        return arr;
                      }
                    }
                  } 
            } 
        });
        //edit
        let edi = document.getElementById('edits').getContext('2d');
        let ediPieChart = new Chart(edi, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'Edits Chart',
                    backgroundColor: bgColor,
                    borderColor: 'gray',
                    data: dataEdits
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        //calculate the total of this data set
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                          return previousValue + currentValue;
                        });
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var percentage = ((currentValue/total) * 100).toFixed(2);
                        let arr = [currentValue];
                        arr.push(percentage + '%');
                        return arr;
                      }
                    }
                  } 
            } 
        });
        //send To police
        let stp = document.getElementById('sendToPolice').getContext('2d');
        let stpPieChart = new Chart(stp, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'Send To Police Chart',
                    backgroundColor: bgColor,
                    borderColor: 'gray',
                    data: dataSendToPolice
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        //calculate the total of this data set
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                          return previousValue + currentValue;
                        });
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var percentage = ((currentValue/total) * 100).toFixed(2);
                        let arr = [currentValue];
                        arr.push(percentage + '%');
                        return arr;
                      }
                    }
                  } 
            } 
        });

        //Reports
        let rep = document.getElementById('reports').getContext('2d');
        let repPieChart = new Chart(rep, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'reports Chart',
                    backgroundColor: bgColor,
                    borderColor: 'gray',
                    data: dataReports
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        //calculate the total of this data set
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                          return previousValue + currentValue;
                        });
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var percentage = ((currentValue/total) * 100).toFixed(2);
                        let arr = [currentValue];
                        arr.push(percentage + '%');
                        return arr;
                      }
                    }
                  } 
            } 
        });

        setTimeout(function(){
          let obsImg = document.querySelector('#observes');
          obsImg = obsImg.toDataURL("image/png");

          let editsImg = document.querySelector('#edits');
          editsImg = editsImg.toDataURL("image/png");

          let sendToPoliceImg = document.querySelector('#sendToPolice');
          sendToPoliceImg = sendToPoliceImg.toDataURL("image/png");

          let reportsImg = document.querySelector('#reports');
          reportsImg = reportsImg.toDataURL("image/png");

          //send to htmlExp
          $.post("./htmlExp.php",{
            radio: 'usr',
            tbody: tbody,
            obsImg: obsImg,
            editsImg: editsImg,
            sendToPoliceImg: sendToPoliceImg,
            reportsImg: reportsImg
          },
          function(data,status){
          if(data == 'fail') {
            alert('ساخت فایل گزارش گیری با مشکل مواجه شد !');
          } else {
            javascript:void(window.open( window.location.href  + data, '_blank'));
          }
          }
          );
        },
        2000);

    });
  }

  function mapExport() {
    let query = 'map';
    let startDate = document.querySelector('#startDate').value;
    let startTime = document.querySelector('#startTime').value;
    let endDate = document.querySelector('#endDate').value;
    let endTime = document.querySelector('#endTime').value;

    //load preloader
    document.querySelector('#mapLoader').style.display = '';
    document.querySelector('#mapTab').style.opacity = '30%';

    $.post("./query.php",{
      query: query,
      startDate: startDate,
      startTime: startTime,
      endDate: endDate,
      endTime: endTime
    },
    function(data,status){
        
        let statesAndCounts = JSON.parse(data);
        let tbody = "";
        for(let i = 0; i < statesAndCounts.length; i++) {
          tbody += '<tr>';
          tbody += `<td>${statesAndCounts[i].name}</td>`;
          tbody += `<td>${statesAndCounts[i].countAllRecives}</td>`;
          tbody += `<td>${statesAndCounts[i].countAllInfractions}</td>`;
          tbody += `<td>${statesAndCounts[i].countAllObserves}</td>`;
          tbody += `<td>${statesAndCounts[i].countAllEdits}</td>`;
          tbody += '</tr>';
        }
        //map intensively
        let paths = document.getElementById('mapIR').children;
        for(let i = 0; i < statesAndCounts.length; i++) {
          for(let j = 0; j < paths.length; j++) {
            if(paths[j].getAttribute('id') == statesAndCounts[i].id) {
              paths[j].setAttribute('fill', statesAndCounts[i].color);
              break;
            }
          }
        }

      //unload preloader
      document.querySelector('#mapLoader').style.display = 'none';
      document.querySelector('#mapTab').style.opacity = '100%';

        setTimeout(function(){ 
          let svg = document.querySelector('#svgPost').innerHTML;
          $.post("./htmlExp.php",{
            radio: 'map',
            tbody: tbody,
            svg: svg
          },
          function(data,status){
          if(data == 'fail') {
            alert('ساخت فایل گزارش گیری با مشکل مواجه شد !');
          } else {
            javascript:void(window.open( window.location.href  + data, '_blank'));
          }
          }
          );

         }, 1000);



    });


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
    
    map(); usr(); cam();