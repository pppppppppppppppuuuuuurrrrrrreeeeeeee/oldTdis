$.get( "./model/dashboardRoot.php", function( data ) {
    let dashRoot = JSON.parse(data);
    document.querySelector('#allObserved').innerHTML = dashRoot[0];
    document.querySelector('#allEdited').innerHTML = dashRoot[1];
    document.querySelector('#allDeleted').innerHTML = dashRoot[2];
    document.querySelector('#allPoseted').innerHTML = dashRoot[3];
});

$.get( "./model/dashboardRoot.php?&users", function( data ) {
    let users = JSON.parse(data);
    let selectTag = document.querySelector('#usersAcc');
    // console.log(users);
    let option;
    for (let i = 0; i < users.length; i++) {
        option = document.createElement('option');
        option.setAttribute('id', users[i]);
        option.innerText = users[i];
        selectTag.appendChild(option);
    }
});

function query() {
    let times = document.getElementsByClassName('list-group-filters font-medium-1')[0].children;
    let date;
    for(let i = 0; i < times.length; i++) 
    {
        let classes = times[i].className.split(' ');
        if(classes.indexOf('active') !== -1) {
            date = times[i].getAttribute('time');
            break;
        }
    }
    let user = document.querySelector('#usersAcc').value;
    $.post("./model/dashboard.php", {
        time: date,
        uname: user
    },
    function(data,status){
        let dash = JSON.parse(data);
        document.querySelector("#observed").innerText = dash[0];
        document.querySelector("#edited").innerText = dash[1];
        document.querySelector("#delted").innerText = dash[2];
        document.querySelector("#posted").innerText = dash[3];

        //darsada
        if(dash[0] != 0) {
            let editPer = parseInt((dash[1]/dash[0]) * 100);
            document.querySelector("#perEdited").innerText =  editPer + '%';
            document.querySelector("#perEdited").style.width = editPer + '%';
            document.querySelector("#perEdited").setAttribute('title', editPer + '%');


            let postPer = parseInt((dash[3]/dash[0]) * 100);
            document.querySelector("#perPosted").innerText =  postPer + '%';
            document.querySelector("#perPosted").style.width = postPer + '%';
            document.querySelector("#perPosted").setAttribute('title', postPer + '%');



            let deletePer = parseInt((dash[2]/dash[0]) * 100);
            document.querySelector("#perDeleted").innerText =  deletePer + '%';
            document.querySelector("#perDeleted").style.width = deletePer + '%';
            document.querySelector("#perDeleted").setAttribute('title', deletePer + '%');

        } else {
            document.querySelector("#perEdited").innerText =  '0' + '%';
            document.querySelector("#perEdited").style.width = '0' + '%';
            document.querySelector("#perEdited").setAttribute('title', '0' + '%');


            document.querySelector("#perPosted").innerText =  '0' + '%';
            document.querySelector("#perPosted").style.width = '0' + '%';
            document.querySelector("#perPosted").setAttribute('title', '0' + '%');


            document.querySelector("#perDeleted").innerText =  '0' + '%';
            document.querySelector("#perDeleted").style.width = '0' + '%';
            document.querySelector("#perDeleted").setAttribute('title', '0' + '%');

        }
        

    });
}
