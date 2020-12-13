function deleteUser(td) {
    let result = window.confirm(`Do you want to delete user ${td.id} ?!`);
    if (result) {
        $.post("../../model/configuration.php",
        {
            id: td.id,
            key: "deleteFlag"
        },
        function(data,status){
            if(data == "true") {
                alert('user deleted successfully!');
                location.reload();
            }
            else {
                alert('there is a problem with this user');
            }
        });
    }
}

function insertInto() {
    
    let usernameInp = document.getElementById('usernameInp').value;
    let passInp = document.getElementById('passInp').value;
    let adminstratorPRV = document.getElementById('adminstratorPRV').checked;
    let userGroup = "User";
    let result = window.confirm(`Do you want to insert user: ${usernameInp}`);

    if(adminstratorPRV) 
        userGroup = "Administrator";
    if(result) {
        $.post("../../model/configuration.php",
        {
            usernameInp: usernameInp,
            passInp: passInp,
            userGroup: userGroup,
            key: "insertFlag"
        },
        function(data,status){
            if(data == "true") {
                alert('user inserted successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this user ${data}`);
            }
        });
    }

}

function insertIntoCompanyId() {
    let name = document.querySelector('#NameInpCompanyID').value;
    let num = document.querySelector('#numberInpCompanyID').value;
    let result = window.confirm(`Do you want to insert Company: ${name}`);
    if(result) {
        $.post("../../model/configuration.php",
        {
            name: name,
            num: num,
            key: "insertFlagCompany"
        },
        function(data,status){
            if(data == "true") {
                alert('Company inserted successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this Company ${data}`);
            }
        });
    }
}

function editCompany(cid, bt, btedit) {
    let inp = document.getElementById(cid);
    if (inp.readOnly == true) {
        inp.readOnly = false;
        bt.innerText = 'submit';
        document.getElementById(btedit).style.display = '';
    } else {
        inp.readOnly = true;
        bt.innerText = 'edit';

        $.post("../../model/configuration.php",
        {
            cid: cid.replace('company', ''),
            desc: inp.value,
            key: "editCompany"
        },
        function(data,status){
            if(data == "true") {
                alert('Company edited successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this company ${data}`);
            }
        });
    }
}

function editCompanyCid(cid, bt, btedit) {
    let inp = document.getElementById(cid);
    if (inp.readOnly == true) {
        inp.readOnly = false;
        bt.innerText = 'submit';
        document.getElementById(btedit).style.display = '';
    } else {
        inp.readOnly = true;
        bt.innerText = 'edit';

        $.post("../../model/configuration.php",
        {
            cid: cid.replace('companyCid', ''),
            Coded: inp.value,
            key: "editCompanyCid"
        },
        function(data,status){
            if(data == "true") {
                alert('Company edited successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this company ${data}`);
            }
        });
    }
}

function editSysCid(cid, bt, btedit) {
    let inp = document.getElementById(cid);
    if (inp.readOnly == true) {
        inp.readOnly = false;
        bt.innerText = 'submit';
        document.getElementById(btedit).style.display = '';
    } else {
        inp.readOnly = true;
        bt.innerText = 'edit';

        $.post("../../model/configuration.php",
        {
            syscid: cid.replace('sysCid', ''),
            sysCode: inp.value,
            key: "editSysCid"
        },
        function(data,status){
            if(data == "true") {
                alert('System edited successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this company ${data}`);
            }
        });
    }
}


function closeCompany(subId, close, inp) {
    document.getElementById(subId).innerText = 'edit';
    close.style.display = 'none';
    document.getElementById(inp).readOnly = true;
    document.getElementById(inp).value = document.getElementById(inp).defaultValue;
}

function closeSys(subId, close, inp) {
    document.getElementById(subId).innerText = 'edit';
    close.style.display = 'none';
    document.getElementById(inp).readOnly = true;
    document.getElementById(inp).value = document.getElementById(inp).defaultValue;
}


function closeCompanyCid(subId, close, inp) {
    document.getElementById(subId).innerText = 'edit';
    close.style.display = 'none';
    document.getElementById(inp).readOnly = true;
    document.getElementById(inp).value = document.getElementById(inp).defaultValue;
}

function closeSysCid(subId, close, inp) {
    document.getElementById(subId).innerText = 'edit';
    close.style.display = 'none';
    document.getElementById(inp).readOnly = true;
    document.getElementById(inp).value = document.getElementById(inp).defaultValue;
}


function insertIntoSysId() {
    let name = document.querySelector('#NameInpSystemID').value;
    let code = document.querySelector('#CodeInpSystemID').value;
    let result = window.confirm(`Do you want to insert System: ${name}`);
    if(result) {
        $.post("../../model/configuration.php",
        {
            nameSys: name,
            codeSys: code,
            key: "insertFlagSys"
        },
        function(data,status){
            if(data == "true") {
                alert('System inserted successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this System ${data}`);
            }
        });
    }
}

function editSys(cid, bt, btedit) {
    let inp = document.getElementById(cid);
    if (inp.readOnly == true) {
        inp.readOnly = false;
        bt.innerText = 'submit';
        document.getElementById(btedit).style.display = '';
    } else {
        inp.readOnly = true;
        bt.innerText = 'edit';

        $.post("../../model/configuration.php",
        {
            sysid: cid.replace('sys', ''),
            sysDesc: inp.value,
            key: "editSys"
        },
        function(data,status){
            if(data == "true") {
                alert('System edited successfully!');
                location.reload();
            }
            else {
                alert(`there is a problem with this System ${data}`);
            }
        });
    }
}


function insertIntoCameras() {
    let name = document.querySelector('#NameInpCamera').value;
    let id = document.querySelector('#IDInpCamera').value;
    let location = document.querySelector('#LocationInpCamera').value;
    let Latitude = document.querySelector('#LatitudeInpCamera').value;
    let longitude = document.querySelector('#LongitudeInpCamera').value;
    let police = document.querySelector('#PoliceInpCamera').value;

    let sys = document.querySelector('#SysInpCamera').value;
    let company = document.querySelector('#CompanyInpCamera').value;
    let state = document.querySelector('#StateInpCamera').value;

    $.post("../../display/model/configuration.php",
    {
        key: "insertCameraFlag",
        nameCamera: name,
        idCamera: id,
        locationCamera: location,
        LatitudeCamera: Latitude,
        longitudeCamera: longitude,
        sysCamera: sys,
        companyCamera: company,
        stateCamera: state,
        policeCamera: police
    },
    function(data,status){
        if(data == "true") {
            alert('Camera added successfully!');
            location.reload();
        }
        else {
            alert(`there is a problem with this Camera ${data}`);
            console.log(data);
        }
    });
}

