// function testform()
// {
//     const data = new FormData();
//     const form = document.getElementById("reg-form");
//     console.log(form);
//     Array.from(form).filter((item) => !!item.name).filter((item) => item.type == "text" || item.type == "password").forEach((element) => {
//         const { name, type } = element;
//         const value = element.value;
//         data.append(name, value);
//         console.log(value);
//     });
//     console.log(Array.from(data.entries()))
//     var xmlHttp = new XMLHttpRequest();
//     xmlHttp.onreadystatechange = function() 
//     {
//         if (this.readyState == 4 && this.status == 200) {
//             alert(this.responseText);
//         }
//     };
//     xmlHttp.open("POST", "./vendor/reg-vend.php", true);
//     xmlHttp.send(data);
// }

function reqRegProc()
{
    const procStatus = document.getElementById("proc-status");
    //console.log(procStatus);
    const data = new FormData();
    const form = document.getElementById("reg-form");
    //console.log(form);
    Array.from(form).filter((item) => !!item.name).filter((item) => item.type == "text" || item.type == "password").forEach((element) => {
        const { name, type } = element;
        const value = element.value;
        data.append(name, value);
        //console.log(value);
    });
    //console.log(Array.from(data.entries()))
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            procStatus.style="";
            procStatus.innerText = this.responseText == "0" ? "Недоступное имя пользователя." : "Регистрация успешна!";
            procStatus.classList.remove(this.responseText == "0" ? "success" : "failed");
            procStatus.classList.add(this.responseText == "0" ? "failed" : "success");
            // let answer = this.responseText == "0" ? false : window.location.reload();
            let answer = this.responseText == "0";
            setTimeout(() => { window.location.reload(); return answer }, 500);
            
        }
    };
    xmlHttp.open("POST", "./vendor/reg-vend.php", true);
    xmlHttp.send(data);
}

function reqLogProc()
{
    const procStatus = document.getElementById("proc-status");
    //console.log(procStatus);
    const data = new FormData();
    const form = document.getElementById("log-form");
    //console.log(form);
    Array.from(form).filter((item) => !!item.name).filter((item) => item.type == "text" || item.type == "password").forEach((element) => {
        const { name, type } = element;
        const value = element.value;
        data.append(name, value);
        //console.log(value);
    });
    //console.log(Array.from(data.entries()))
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            procStatus.style="";
            // alert(this.responseText);
            procStatus.innerText = this.responseText == "0" ? "Неверный логин или пароль." : "Успешный вход!";
            procStatus.classList.remove(this.responseText == "0" ? "success" : "failed");
            procStatus.classList.add(this.responseText == "0" ? "failed" : "success");
            // let answer = this.responseText == "0" ? false : window.location.reload();
            let answer = this.responseText == "0";
            setTimeout(() => { window.location.reload(); return answer }, 500);
        }
    };
    xmlHttp.open("POST", "./vendor/login-vend.php", true);
    xmlHttp.send(data);
}