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

  //load preloader
  document.querySelector('#mapLoader').style.display = '';
  document.querySelector('#mapTab').style.opacity = '30%';

  let post = $.post("./query.php",{
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
      console.log('countRec   ', countRec);
      console.log('countInf   ', countInf);
      console.log('countObs   ', countObs);
      console.log('countEdi   ', countEdi);

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

      //unload preloader
      document.querySelector('#mapLoader').style.display = 'none';
      document.querySelector('#mapTab').style.opacity = '100%';

  });
  return post;
}



//////\\\\\\\\\\\\\\user scripts //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function usr() {
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

  });
}



function cam() {
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

      //observe
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

  });
}

