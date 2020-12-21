//////\\\\\\\\\\\\\\map scripts //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
var paths = document.getElementById('mapIR').children;
for (let i = 0; i < paths.length; i++) {
    if (paths[i].getAttribute('name') != null && paths[i].getAttribute('name') != '') {
        // paths[i].setAttribute('onmouseover', 'showMap(this)');
        // paths[i].setAttribute('onmouseleave', 'defaultColor(this)');
        paths[i].removeAttribute('id');
        paths[i].setAttribute('id', paths[i].getAttribute('name'));
        paths[i].removeAttribute('name');
        paths[i].setAttribute('data-toggle', 'tooltip');
        paths[i].setAttribute('data-html', 'true');
        //data-html="true"
        // console.log(paths[i].getAttribute('name'));

    }
}

// function showMap(path) {
//     path.setAttribute('fill', 'lightgray');
// }

// function defaultColor(path) {
//     path.setAttribute('fill', 'gray');
// }

function map() {
  let query = 'map';
  let startDate = document.querySelector('#startDate').value;
  let startTime = document.querySelector('#startTime').value;
  let endDate = document.querySelector('#endDate').value;
  let endTime = document.querySelector('#endTime').value;


  let post = $.post("./model/statisticsQuery.php",{
    query: query,
    startDate: startDate,
    startTime: startTime,
    endDate: endDate,
    endTime: endTime
  },
  function(data,status){
      for (let i = 0; i < paths.length; i++) {
          paths[i].removeAttribute('data-toggle');
          paths[i].removeAttribute('title');
          paths[i].removeAttribute('data-original-title');
      }
      // console.log(data);
      let statesAndCounts = JSON.parse(data);
      console.log(statesAndCounts);
      let countRec = 0;
      let countInf = 0;
      let countObs = 0;
      let countEdi = 0;
      
      for(let i = 0; i < statesAndCounts.length; i++) {
        countRec += statesAndCounts[i].countAllRecives;
        countInf += statesAndCounts[i].countAllInfractions;
        countObs += statesAndCounts[i].countAllObserves;
        countEdi += statesAndCounts[i].countAllEdits;
      }
      // console.log('countRec   ', countRec);
      // console.log('countInf   ', countInf);
      // console.log('countObs   ', countObs);
      // console.log('countEdi   ', countEdi);

      for(let i = 0; i < statesAndCounts.length; i++) {
        for(let j = 0; j < paths.length; j++) {
            if(paths[j].getAttribute('id') == statesAndCounts[i].id) {
              paths[j].setAttribute('data-toggle', 'tooltip');
              paths[j].setAttribute('fill', statesAndCounts[i].color);
              // let content = `${statesAndCounts[i].id} </br>
              // All recives : ${statesAndCounts[i].countAllRecives} </br>
              // All Infractions : ${statesAndCounts[i].countAllInfractions} </br>
              // All Observes : ${statesAndCounts[i].countAllObserves} </br>
              // All Edits : ${statesAndCounts[i].countAllEdits} </br>
              // `;
              let content = `${statesAndCounts[i].name} </br>
              تمامی دریافت ها : ${statesAndCounts[i].countAllRecives} <br>
              تخلفات : ${statesAndCounts[i].countAllInfractions} <br>
              مشاهدات : ${statesAndCounts[i].countAllObserves} <br>
              ویرایشات : ${statesAndCounts[i].countAllEdits} <br>
              `;
              paths[j].setAttribute('data-original-title', content);
              paths[j].setAttribute('title', content);
              break;
            }
        }
      }

      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });


  });
  return post;
}



//////\\\\\\\\\\\\\\user scripts //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
var globUsr = [];

function usrCamChart(labels, data, backgroundColor, hoverBackgroundColor) {
  document.getElementById("userCanvasParent").innerHTML = '';
  let canvas = document.createElement('canvas');
  canvas.setAttribute('id', 'userCanvas');
  canvas.setAttribute('height', '100');
  document.getElementById("userCanvasParent").appendChild(canvas);
  var ctxD = document.getElementById("userCanvas").getContext('2d');
  var myLineChart = new Chart(ctxD, {
  type: 'doughnut',
  data: {
  labels: labels,
  datasets: [{
    data: data,
    backgroundColor: backgroundColor,
    hoverBackgroundColor: hoverBackgroundColor
  }]
  },
  options: {
  responsive: true,
  legend: {
          labels: {
              fontFamily: "'W-yekan', 'Helvetica', 'Arial', sans-serif",
              fontColor	:"#000"
          },
          options: {
          layout: {
              padding: {
                  left: 500,
                  right: 0,
                  top: 0,
                  bottom: 0
              }
          }
      },
      }
      }
  });
}

function usrContent() {
  let key;
  let tags = document.getElementsByClassName('usrTags');
  for(let i = 0; i < tags.length; i++) 
  {
      let clss = tags[i].className.split(' ');
      if(clss.indexOf('active') !== -1) {
          key = tags[i].getAttribute('tag');
          break;
      }
  }
  let lables = [];
  let backgroundColor = [];
  let hoverBackgroundColor = [];
  let data = [];
  for(let i = 0; i < globUsr.length; i++) {
    lables.push(globUsr[i].user);
    backgroundColor.push(globUsr[i].color);
    hoverBackgroundColor.push(globUsr[i].hoverColor);
    data.push(globUsr[i][key]);
  }
  usrCamChart(lables, data, backgroundColor, hoverBackgroundColor);
}

function usr() {
  let startDate = document.querySelector('#startDate').value;
  let startTime = document.querySelector('#startTime').value;
  let endDate = document.querySelector('#endDate').value;
  let endTime = document.querySelector('#endTime').value;


  $.post("./model/statisticsQuery.php",{
      query: 'usr',
      startDate: startDate,
      startTime: startTime,
      endDate: endDate,
      endTime: endTime
  },
  function(data){
      // let activities = JSON.parse(data);
      let activities = JSON.parse(data);
      globUsr = activities;

      let label = [];
      let dataObserve = [];
      let dataEdits = [];
      let dataSendToPolice = [];
      let dataReports = [];

      
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
          let rgba = `rgba(${r}, ${g}, ${b}, 0.5)`;
          activities[i].color = rgb;
          activities[i].hoverColor = rgba;
      }
      console.log(globUsr);
      usrContent();

  });
}


var globCam = [];

function renderCamChart(labels, data, backgroundColor, hoverBackgroundColor) {
  document.getElementById("cameraCanvasParent").innerHTML = '';
  let canvas = document.createElement('canvas');
  canvas.setAttribute('id', 'cameraCanvas');
  canvas.setAttribute('height', '100');
  document.getElementById("cameraCanvasParent").appendChild(canvas);
  var ctxD = document.getElementById("cameraCanvas").getContext('2d');
  var myLineChart = new Chart(ctxD, {
  type: 'doughnut',
  data: {
  labels: labels,
  datasets: [{
    data: data,
    backgroundColor: backgroundColor,
    hoverBackgroundColor: hoverBackgroundColor
  }]
  },
  options: {
  responsive: true,
  legend: {
          labels: {
              fontFamily: "'W-yekan', 'Helvetica', 'Arial', sans-serif",
              fontColor	:"#000"
          },
          options: {
          layout: {
              padding: {
                  left: 500,
                  right: 0,
                  top: 0,
                  bottom: 0
              }
          }
      },
      }
      }
  });
}

function camContent() {
  let key;
  let tags = document.getElementsByClassName('camTags');
  for(let i = 0; i < tags.length; i++) 
  {
      let clss = tags[i].className.split(' ');
      if(clss.indexOf('active') !== -1) {
          key = tags[i].getAttribute('tag');
          break;
      }
  }
  let lables = [];
  let backgroundColor = [];
  let hoverBackgroundColor = [];
  let data = [];
  for(let i = 0; i < globCam.length; i++) {
    lables.push(globCam[i].cam);
    backgroundColor.push(globCam[i].color);
    hoverBackgroundColor.push(globCam[i].hoverColor);
    data.push(globCam[i][key]);
  }
  renderCamChart(lables, data, backgroundColor, hoverBackgroundColor);
}

function cam() {
  let startDate = document.querySelector('#startDate').value;
  let startTime = document.querySelector('#startTime').value;
  let endDate = document.querySelector('#endDate').value;
  let endTime = document.querySelector('#endTime').value;


  $.post("./model/statisticsQuery.php",{
      query: 'cam',
      startDate: startDate,
      startTime: startTime,
      endDate: endDate,
      endTime: endTime
  },
  function(data){
      // let activities = JSON.parse(data);
      let activities = JSON.parse(data);
      globCam = activities;
      let label = [];
      let dataObserve = [];
      let dataUnseen = [];
      let dataRec = [];
      let dataEdits = [];
      let dataSendToPolice = [];
      let dataDIDNTSendToPolice = [];
      let dataReports = [];
      
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
          let rgba = `rgba(${r}, ${g}, ${b}, 0.5)`;
          activities[i].color = rgb;
          activities[i].hoverColor = rgba;
      }
      console.log(globCam);
      camContent();
  });
}
